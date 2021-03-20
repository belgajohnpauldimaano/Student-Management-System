@extends('mails.mail_layout')
@section ('content')        
    <p style="text-align: right;">Date: {{ $student ? date_format(date_create($student->updated_at), 'F d, Y h:i A') : '' }}</p>

    <p>Dear Admin,</p>
    <p>You disapproved student {{$student->last_name.', '.$student->first_name.' '.$student->middle_name}}.</p>
    <p>
        We regret to inform you that your online application has been disapproved by SJAI. 
        For more information, please contact us at FB page SJAI Guidance and Admission Office or you may reach us contact number (047) 636 5560.
    </p>
            
    <p>Regards,</p>
    <br>
    <p>SJAI</p>
@endsection