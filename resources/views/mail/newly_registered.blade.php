<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
 
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            St. John's Academy Inc.
        </h3>
        <br/>
        
        <p style="text-align: right;">Date: {{ $NewStudent ? date_format(date_create($NewStudent->student->updated_at), 'F d, Y h:i A') : '' }}</p>

        <p>Dear {{$NewStudent->student->last_name.', '.$NewStudent->student->first_name.' '.$NewStudent->student->middle_name}},</p>
        <p>
            You are registered! Please wait the confirmation of the Admission Office via email. Thank you
        </p>
        
        <p>Regards,</p>
        <br>
            SJAI Admission
        <br>
        <p>
            DISCLAIMER : The message (including the attachments) contains Confidential Information and is intended for the named recipient only. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, print, retain, use, copy, distribute nor disclose to anyone this message or any information contained herein. If you have received the message in error, please advise the sender immediately by reply e-mail, and destroy all copies of the original message (including the attachments).
        </p>
        
    </div>
    </body>
</html>