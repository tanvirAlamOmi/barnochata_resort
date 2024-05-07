@extends('emails.inc.layout')

@section('title', 'Alter Offer Request')

@section('email_content')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell">
                        Hello {{ $booking->name }}, <br>
                        
                        {!! $booking->response_message !!} <br><br>

                        <a href="{{ route('book-now') }}" target="_blank">Visit here</a> to check the other offers. <br><br>

                        Best Regards, <br>
                        Manager, {{ config('app.name') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection