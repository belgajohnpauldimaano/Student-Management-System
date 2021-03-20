@extends('mails.mail_layout')
@section ('content')        
    <p style="text-align: right;">Date: {{ $payload ? date_format(date_create($payload->student->updated_at), 'F d, Y h:i A') : '' }}</p>

    <p>Dear {{$payload->student->last_name.', '.$payload->student->first_name.' '.$payload->student->middle_name}},</p>
    <p>
        You are registered! Please wait the confirmation of the Admission Office via email. Thank you
    </p>
    
    <p>Regards,</p>
    <br>
        SJAI Admission
@endsection