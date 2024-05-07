@extends('emails.inc.layout')

@section('title', 'Request Accepted')

@section('email_content')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell">
                        Hello {{ $booking->name }}, <br>
                        
                        {!! $booking->response_message !!} <br><br>

                        Your Booking Number is: <b>{{ $booking->booking_no }}</b> <br><br>

                        Please, <a href="{{ route('payment') }}" target="_blank">visit here to process your payment.</a> 

                        Best Regards, <br>
                        Manager, {{ config('app.name') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection