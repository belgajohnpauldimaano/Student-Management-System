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
            We regret to inform you that your online application has been disapproved by SJAI. 
            For more information, please contact us at FB page SJAI Guidance and Admission Office or you may reach us contact number (047) 636 5560.
        </p>
                
        <p>Regards,</p>
        <br>
        <p>SJAI</p>
        
    </div>
    </body>
</html>