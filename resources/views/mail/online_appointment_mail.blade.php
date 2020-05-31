<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <style>
            td{
                text-align: center;
            }
        </style>
    </head>
 
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            St. John's Academy Inc.<br/>
            Online Appointment Confirmation
        </h3>
        <br/>
        <p style="text-align: right;">Date: {{ $hasAppointment ? date_format(date_create($hasAppointment->created_at), 'F d, Y h:i A') : '' }}</p>

        
        <p>Dear: {{$hasAppointment->student->last_name.', '.$hasAppointment->student->first_name}},</p>

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
                    <td>{{$hasAppointment->appointment->time}}</td>
                    <td>{{$hasAppointment->queueing_number}}</td>
                </tr>
            </tbody>
        </table>
        <br/>
        <p>This is auto generated. Thank you!</p>
    </div>
    </body>
</html>