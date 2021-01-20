@extends('mails.mail_layout')
@section ('content')        
    <p style="text-align: right;">Date: {{ $student ? date_format(date_create($student->updated_at), 'F d, Y h:i A') : '' }}</p>

    <p>Dear Admin,</p>
    <p>
        Student {{$student->last_name.', '.$student->first_name.' '.$student->middle_name}} account in St. John Academy Inc. is now activated. Below is your account credentials, you can now enroll online using this account to our website https://www&#46;sja-bataan&#46;com.          
    </p>
    <ul>
        <li>username: {{$student->user->username}}</li>
        <li>password: {{$student->first_name.'.'.$student->last_name}}</li>
    </ul>
    <p>Security advisory, please do not share your credentials to anyone. Thank you</p>
    
    <p>Regards,</p>
    <br>
        SJAI Admission
    <br>
@endsection