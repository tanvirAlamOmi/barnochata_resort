@extends('emails.inc.layout')

@section('title', 'Message Recieved')

@section('email_content')

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell">
                        Hello {{ $details['name'] }}, <br>
                        We have got an email form <br>
                        email: {{ $details['contact_number'] }}, <br>
                        contact number: {{ $details['contact_number'] }}, <br>
                        subject: {{ $details['subject'] }}, <br>
                        Message: {{ $details['message'] }}, <br><br>
                        Thanks for your message. <br><br>
                        
                        We will back to you soon.
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection