@extends('mails.mail_layout')
@section ('content')        
   <p style="text-align: right;">Date: {{ $updated_at ? date_format(date_create($updated_at), 'F d, Y h:i A') : '' }}</p>

   <p>Dear {{$full_name}},</p>
   <p>
       Your account in St. John Academy Inc. is now activated. Below is your account credentials, 
       you can now enroll online using this account to our website https://www&#46;sja-bataan&#46;com.
   </p>
   <ul>
       <li>username: {{$username}}</li>
       <li>password: {{$password}}</li>
   </ul>
   <p>Security advisory, please do not share your credentials to anyone. Thank you</p>
   
   <p>Regards,</p>
   <br>
    SJAI Admission
@endsection