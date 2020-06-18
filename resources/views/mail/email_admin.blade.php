<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            St. John's Academy Inc.<br/>
            Online Inquiry
        </h3>
        <br/>
        <p style="text-align: right;">Date: {{ $email ? date_format(date_create($email->created_at), 'F d, Y h:i A') : '' }}</p>

        <p>Dear Admin,</p>
        
        <p>You have received an email from {{$email->name}}.</p>
        
        <p>Email from: {{$email->email}}<br/>
        Subject: {{$email->subject}}<br/>
        Message: {{$email->message}}</p>        
           
        
    </div>
    </body>
</html>