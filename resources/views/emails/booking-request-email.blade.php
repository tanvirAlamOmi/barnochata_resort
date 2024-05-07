@extends('emails.inc.layout')

@section('title', 'Booking Request')

@section('email_content')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell">
                        Hello {{ $booking->name }}, <br>
                        Thank you for the kind request of booking. We have got your booking request information like below: <br> <br>

                        <table>
                            <tr>
                                <td>
                                    <div>Request Date Time: {{ date('d-m-Y h:i', strtotime($booking->created_at)) }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mb-1"><b>Name</b>: {{ $booking->name }}</div>
                                    <div class="mb-1"><b>Email</b>: {{ $booking->email }}</div>
                                    <div class="mb-1"><b>Contact No</b>: {{ $booking->contact_no }}</div>
                                    <div class="mb-1"><b>Arrival Date</b>: {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</div>
                                    <div class="mb-1"><b>Departure Date</b>: {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</div>
                                    <div class="mb-1"><b>Adult</b>: {{ $booking->total_adult }} @if($booking->total_child > 0), <b>Child</b>: {{ $booking->total_child }}@endif</div>
                                </td>
                            </tr>
                            @if(!empty($booking->booking_note))
                            <tr>
                                <td>
                                    <b>Note</b>: {{ $booking->booking_note }}
                                </td>
                            </tr>
                            @endif
                        </table>
                        <br>
                        You will be notified soon about your booking request via email or over phone call. Have a nice day. <br> <br>
                        Best Regards, <br>
                        Manager, {{ config('app.name') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection