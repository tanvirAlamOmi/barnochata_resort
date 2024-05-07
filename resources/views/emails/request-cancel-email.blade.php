@extends('emails.inc.layout')

@section('title', 'Request Cancelled')

@section('email_content')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell">
                        Hello {{ $booking->name }}, <br>
                        
                        {!! $booking->response_message !!} <br><br>

                        Best Regards, <br>
                        Manager, {{ config('app.name') }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection