@extends('mails.mail_layout')
@section ('content')
    <p style="text-align: right;">Date: {{ $hasAppointment ? date_format(date_create($hasAppointment->created_at), 'F d, Y h:i A') : '' }}</p>
    
    <p>Dear {{$hasAppointment->student->first_name.' '.$hasAppointment->student->last_name}},</p>
    <p>We regret to inform you that your online appointment for walk in has been disapproved by SJAI. For more information,
         please contact us at FB page St. John Academy Inc or you may reach us contact number (047) 636 5560.</p>
    
    <p>Regards,</p>
    <p>SJAI</p>
@endsection