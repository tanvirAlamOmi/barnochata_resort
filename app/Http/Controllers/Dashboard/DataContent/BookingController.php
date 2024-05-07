<?php

namespace App\Http\Controllers\Dashboard\DataContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataContent\Booking\Booking;
use App\Models\DataContent\Booking\BookingRoom;
use App\Models\DataContent\Booking\BookingAddons;
use App\Models\DataContent\Package\PackageRoom;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestAcceptMail;
use App\Mail\RequestAlterMail;
use App\Mail\RequestCancelMail;

class BookingController extends Controller
{
    public function bookings()
    {
        $bookings = Booking::orderBy('id','DESC')->paginate(20);
        return view('dashboard.data-contents.bookings.booking-list', compact('bookings'));
    }

    public function show($booking_no)
    {
        $booking = Booking::with(['booking_rooms_only.package','booking_rooms_only.room','booking_addons.addons','guests'])->where('booking_no',$booking_no)->first();

        return view('dashboard.data-contents.bookings.booking-details', compact('booking'));
    }

    public function booking_response(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'response_message' => 'required',
            'booking_no' => 'required'
        ]);

        $booking = Booking::where('booking_no', $request->booking_no)->first();
        $booking->status = getStatusCode($request->status);
        $booking->response_message = nl2br($request->response_message);
        $booking->update();

        if($request->status == 'ACCEPTED')
        {
            Mail::to($booking->email)->send(new RequestAcceptMail($booking));
        }elseif($request->status == 'ALTER')
        {
            Mail::to($booking->email)->send(new RequestAlterMail($booking));
        }elseif($request->status == 'CANCELLED')
        {
            Mail::to($booking->email)->send(new RequestCancelMail($booking));
        }

        return redirect()->route('bookings')->with('message_success','Booking request has been responded with email successfully!');

    }

    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'booking_id' => 'required'
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->status = getStatusCode($request->status);
        $booking->update();

        return back()->with('message_success','Status has been changed successfully!');

    }
}
