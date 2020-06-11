<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
 
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            Saint John's Academy Inc.
        </h3>
        <br/>
        
        <p style="text-align: right;">Date: <?php echo e($student ? date_format(date_create($student->updated_at), 'F d, Y h:i A') : ''); ?></p>

        <p>Dear <?php echo e($student->last_name.', '.$student->first_name.' '.$student->middle_name); ?></p>
        <p>
            Your account in St. John Academy Inc is now activated. Below is your account credentials, you can now enroll online using this account to our website https://www&#46;sja-bataan&#46;com.          
        </p>
        <ul>
            <li>username: <?php echo e($student->user->username); ?></li>
            <li>password: <?php echo e($student->first_name.'.'.$student->last_name); ?></li>
        </ul>
        <p>Security advisory, please do not share your credentials to anyone. Thank you</p>
        
        <p>Regards,</p>
        <br>
        SJAI Registrar
        
    </div>
    </body>
</html>