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
        <p style="text-align: right;">Date: <?php echo e($hasAppointment ? date_format(date_create($hasAppointment->created_at), 'F d, Y h:i A') : ''); ?></p>
        
        <p>Dear <?php echo e($hasAppointment->student->first_name.' '.$hasAppointment->student->last_name); ?>,</p>

        <p>We regret to inform you that your online appointment for walk in has been disapproved by SJAI. For more information,
             please contact us at FB page St. John Academy Inc or you may reach us contact number (047) 636 5560.</p>
        
        <p>Regards,</p>
        <p>SJAI</p>

        <br>
        <p>DISCLAIMER : The message (including the attachments) contains Confidential Information and is intended for the named recipient only. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, print, retain, use, copy, distribute nor disclose to anyone this message or any information contained herein. If you have received the message in error, please advise the sender immediately by reply e-mail, and destroy all copies of the original message (including the attachments).</p>
    </div>
    </body>
</html>