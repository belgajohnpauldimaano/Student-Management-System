@extends('mails.mail_layout')
@section ('content')
    <p>Dear {{$payment->student->last_name.', '.$payment->student->first_name}}</p>
    <p>Good day! Your payment last {{ $payment ? date_format(date_create($payment->created_at), 'F d, Y h:i A') : '' }} is now approved by finance. For more information, please contact us at FB page SJAI Finance Office or you may reach us contact number (047) 636 5560</p> 
@endsection