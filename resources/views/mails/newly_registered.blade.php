@extends('mails.mail_layout')
@section ('content')        
    <p style="text-align: right;">Date: {{ $NewStudent ? date_format(date_create($NewStudent->student->updated_at), 'F d, Y h:i A') : '' }}</p>

    <p>Dear {{$NewStudent->student->last_name.', '.$NewStudent->student->first_name.' '.$NewStudent->student->middle_name}},</p>
    <p>
        You are registered! Please wait the confirmation of the Admission Office via email. Thank you
    </p>
    
    <p>Regards,</p>
    <br>
        SJAI Admission
@endsection