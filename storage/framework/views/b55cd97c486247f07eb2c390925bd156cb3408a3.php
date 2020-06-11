<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            St. John's Academy Inc.<br/>
            Online Registration Confirmation
        </h3>
        <br/>
        

        <p>Dear <?php echo e($payment->student->last_name.', '.$payment->student->first_name); ?></p>
        
        <p>Good day! Your payment last <?php echo e($payment ? date_format(date_create($payment->created_at), 'F d, Y h:i A') : ''); ?> is now approved by finance. For more information, please contact us at FB page SJAI Finance Office or you may reach us contact number (047) 636 5560</p> 
        
        <br/>
        

        <br>
        <p>
            DISCLAIMER : The message (including the attachments) contains Confidential Information and is intended for the named recipient only. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, print, retain, use, copy, distribute nor disclose to anyone this message or any information contained herein. If you have received the message in error, please advise the sender immediately by reply e-mail, and destroy all copies of the original message (including the attachments).
        </p>
    </div>
    </body>
</html>