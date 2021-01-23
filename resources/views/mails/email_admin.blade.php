@extends('mails.mail_layout')
@section ('content')
    <p style="text-align: right;">Date: {{ $email ? date_format(date_create($email->created_at), 'F d, Y h:i A') : '' }}</p>
    <p>Dear Admin,</p>    
    <p>You have received an email from {{$email->name}}.</p>    
    <p>
        Email from: {{$email->email}}<br/>
        Subject: {{$email->subject}}<br/>
        Message: {{$email->message}}
    </p>        
@endsection