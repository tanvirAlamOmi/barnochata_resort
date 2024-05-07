<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingRequestMail;
use App\Models\DataContent\Booking\Booking;
use App\Jobs\ProcessBookingRequestMail;

class TestController extends Controller
{
    public function check_booking_request_mail($booking_no = null)
    {
        if(!empty($booking_no)){
            return $booking_no;
        }
        $booking_no = 20231008005;
        $booking = Booking::where('booking_no',$booking_no)->first();

        Mail::to($booking->email)->send(new BookingRequestMail($booking));
        ProcessBookingRequestMail::dispatch($booking);
        return view('emails.booking-request-email',compact('booking'));
    }
}
