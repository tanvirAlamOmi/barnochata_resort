<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\DataContent\Room\Room;
use App\Models\DataContent\Package\Package;
use App\Models\DataContent\Addons;
use App\Models\DataContent\Booking\Booking;
use App\Models\DataContent\Booking\BookingRoom;
use App\Models\DataContent\Booking\BookingAddons;
use Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingRequestMail;

class BookingHelper
{
    public function confirm_booking(Request $request)
    {
        Cart::destroy();

        if(!empty($request->rooms) && count($request->rooms) > 0)
        {
            $rooms = Room::with(['room_packages.package'])->whereIn('id',$request->rooms)->get();
            $requested_packages = $request->packages;

            foreach ($rooms as $r => $room) {
                $package = null;
                
                if(!empty($request->packages[$room->id]))
                {
                    $room_package =$room->room_packages->where('package_id',$request->packages[$room->id])->first();
                    $package = [
                        'id' => $room_package->package_id,
                        'title' => $room_package->package->title,
                        'default_guest' => $room_package->default_guest,
                        'price' => $room_package->price,
                        'extra_person_per_adult' => $room_package->extra_person_per_adult,
                        'extra_person_per_child' =>  $room_package->extra_person_per_child,
                    ];
                }
                
                Cart::add([
                    'id' => $room->id,
                    'name' => $room->title,
                    'qty' => 1,
                    'price' => $room->price,
                    'options' => [
                        'default_guest' => $room->guest_capacity,
                        'extra_person_per_adult' => $room->extra_person_per_adult,
                        'extra_person_per_child' =>  $room->extra_person_per_child,
                        'package' => $package,
                        'type' => 'room',
                    ]
                ]);
            }
        }

        if(!empty($request->selected_addons) && count($request->selected_addons) > 0)
        {
            $requested_addons = [];
            
            if(!empty($request->selected_addons) && $request->selected_addons_counter)
            {
                $requested_addons = array_combine($request->selected_addons, $request->selected_addons_counter);
            }

            foreach ($requested_addons as $addonSlug => $addonConuter) {
                $addons = Addons::whereSlug($addonSlug)->first();
                Cart::add([
                    'id' => $addons->id,
                    'name' => $addons->title,
                    'qty' => $addonConuter,
                    'price' => $addons->charge,
                    'options' => [
                        'type' => 'addons',
                    ]
                ]);
            }
        }

        return Cart::content();
    }

    public function submit_confirmation(Request $request)
    {
        $booking_request = $this->fomate_booking_request($request);

        $booking = new Booking;
        $booking->booking_no = $this->generate_booking_no();
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->contact_no = $request->contact_no;
        $booking->total_adult = $request->total_adult;
        $booking->total_child = $request->total_child;
        $booking->booking_date = Carbon::now()->toDateString();
        $booking->check_in_date = date('Y-m-d',strtotime($request->from_date));
        $booking->check_out_date = !empty($request->to_date) ? date('Y-m-d',strtotime($request->to_date)) : null;
        $booking->booking_note = $request->booking_note;
        $booking->status = 1;
        $booking->save();

        $subtotal = 0;
        $default_guest = 0;
        $allowed_adult = 0;
        $allowed_child = 0;
        $extra_adult_count = 0;
        $extra_child_count = 0;
        $extra_adult_price = 0;
        $extra_child_price = 0;
        $arrival_date = Carbon::parse($booking->check_in_date);
        $departure_date = Carbon::parse($booking->check_out_date);
        $day_count = $arrival_date->diffInDays($departure_date);

        foreach (Cart::content() as $row_id => $cart_item) {
            $item_price = $cart_item->price;
            if($cart_item->options->type == 'room')
            {
                $default_guest = $cart_item->options['default_guest'];
                $extra_adult_price = $cart_item->options['extra_person_per_adult'];
                $extra_child_price = $cart_item->options['extra_person_per_child'];
                if($cart_item->options['package'])
                {
                    $item_price = $cart_item->options['package']['price'];
                    $default_guest = $cart_item->options['package']['default_guest'];
                    $allowed_adult += $cart_item->options['package']['default_guest'];
                    $extra_adult_price = $cart_item->options['package']['extra_person_per_adult'];
                    $extra_child_price = $cart_item->options['package']['extra_person_per_child'];
                }else{
                    $allowed_adult += $default_guest;
                }

                $room = new BookingRoom;
                $room->booking_id = $booking->id;
                $room->room_id = $cart_item->id;
                $room->package_id = !empty($cart_item->options['package']) ? $cart_item->options['package']['id'] : null;
                $room->check_in_date = $booking->check_in_date;
                $room->check_out_date = $booking->check_out_date;
                $room->price = $item_price;
                $room->default_guest = $default_guest;
                $room->extra_person_per_adult = $extra_adult_price;
                $room->extra_person_per_child = $extra_child_price;
                $room->status = 0;
                $room->save();

                $subtotal += ($room->price * $day_count);
            }

            if($cart_item->options->type == 'addons')
            {
                $addons = new BookingAddons;
                $addons->booking_id = $booking->id;
                $addons->addons_id = $cart_item->id;
                $addons->addons_counter = $cart_item->qty;
                $addons->save();

                $subtotal += ($item_price * $cart_item->qty);
            }
        }

        if($booking_request->total_adult > $allowed_adult)
        {
            $extra_adult_count = $booking_request->total_adult - $allowed_adult;
            $subtotal += ($extra_adult_price * $extra_adult_count * $day_count);
        }

        if($booking_request->total_child > $allowed_child)
        {
            $extra_child_count = $booking_request->total_child - $allowed_child;
            $subtotal += ($extra_child_price * $extra_child_count * $day_count);
        }

        $booking->gross_total = $subtotal;
        $booking->save();

        Mail::to($booking->email)->send(new BookingRequestMail($booking));

        Cart::destroy();

        return $booking->booking_no;
    }

    public function get_booking($booking_no)
    {
        return !empty($booking_no) ? Booking::with(['booking_rooms_only.package','booking_rooms_only.room','booking_addons.addons','guests'])->where('booking_no',$booking_no)->first() : false ;
    }

    public function fomate_booking_request($request)
    {
        $booking_request = (object)[];
        $booking_request->from_date = $request->from_date ? $request->from_date : null;
        $booking_request->to_date = $request->to_date ? $request->to_date : null;
        $booking_request->total_adult = $request->total_adult ? $request->total_adult : null;
        $booking_request->total_child = $request->total_child ? $request->total_child : 0;
        return $booking_request;
    }

    protected function generate_booking_no()
    {
        $currentDate = Carbon::now()->toDateString();
        $counter = Booking::whereDate('booking_date', '=', $currentDate)->count() + 1;
        return str_replace('-', '', $currentDate).str_pad($counter, 3, '0', STR_PAD_LEFT);
    }
}