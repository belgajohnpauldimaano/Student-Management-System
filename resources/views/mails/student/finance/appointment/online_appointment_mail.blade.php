@extends('mails.mail_layout')
@section ('content')
        <p style="text-align: right;">Date: {{ $hasAppointment ? date_format(date_create($hasAppointment->created_at), 'F d, Y h:i A') : '' }}</p>

        
        <p>Dear {{$hasAppointment->student->last_name.', '.$hasAppointment->student->first_name}},</p>

        <p>You have set an appointment, Please see details below:</p>
        
        <table border="1" style="border-color: #666;border-collapse: collapse;width:100%; " cellpadding="5">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Queueing number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $hasAppointment ? date_format(date_create($hasAppointment->appointment->date), 'F d, Y') : '' }}</td>
                    <td>{{ $hasAppointment ? date_format(date_create($hasAppointment->appointment->date), 'h:i A') : '' }}</td>
                    <td>{{ $hasAppointment->queueing_number }}</td>
                </tr>
            </tbody>
        </table>
@endsection