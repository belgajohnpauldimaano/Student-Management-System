<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('content_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        th, td {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            font-size : 11px;
        }
        .text-red {
            color : #dd4b39 !important;
        }
        small {
            font-size : 11px !important;
        } 
        @font-face {
            font-family: Arial, Times, serif ;
        }
        *   {
                font-family: Arial, Times, serif;
            }
        .page-break {
            page-break-after: always;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            font-size : 11px;
        }
        .text-red {
            color : #dd4b39 !important;
        }
        small {
            font-size : 10px;
        }
        .text-center {
            text-align: center;
        }
        .heading1 {
            text-align: center;
            padding: 0;
            margin:0;
            font-size: 11px;
        }
        .heading2 {
            text-align: center;
            padding: 0;
            margin:0;
        }
        .heading2-title {
            font-family: "Old English Text MT", Times, serif !important;
        }

        @font-face {
            font-family: 'old-english';
            src: url('/fonts/OLD.ttf') format("truetype");
            font-weight: 400; 
            font-style: normal; 
        }
        .heading2-subtitle {
            font-size: 12px;
        }
        .p0 {
            padding: 0;
        }
        .m0 {
            margin: 0;
        }

        .student-info {
            font-size: 12px;
        }

        .logo {
            position: absolute;
            top: 1em;
            left: 1em;
            padding-left: 2em
        }

        .s_photo {
            position: absolute;
            top: 1.5em;
            right: 1em;
            padding-right: 4em
        }
        .report-progress {
            text-align: center;
            font-size: 12px;
            font-weight: 700;
        }
        .table-student-info {
            width: 100%;
        }
        
        .table-student-info th, .table-student-info td {
            border: none;
            padding: 0 2px 2px 2px;
        }
        .text-red{
            color: red;
        }
        .table-student-info {
            width: 100%;
        }            
        .table-student-info th, .table-student-info td {
            border: none;
            padding: 0 2px 2px 2px;
        }
        .b-top{
                border-bottom: 3px solid #dd4b39;
                margin-top: 0;
                width: 64%;
                margin: auto;
            }
        p{
            font-size: 14px
        }
        .box-field{
            border: 1px solid black ;
            padding: 2px;
            width: 99% !important;
            display: inline-block;  
        }
        .w-100{
            width: 99.5% !important;
        }
        .m2{
            margin: 5px 0 0 0 ;
        }
        .m3{
            margin: 10px 0 0 0 ;
        }
        .underline-field{
            border-bottom: 1px solid black ;
            padding: 2px;
            width: 99% !important;
            display: inline-block;  
        }

        .logo {
                position: absolute;
            }
            .sja-logo {
                top: 10px;
                right: 10px;
            }
            .deped-bataan-logo {
                top: 10px;
                left: 10px;
            }
            .report-progress {
                text-align: center;
                font-size: 12px;
                font-weight: 700;
            }
            .report-progress-left {
                text-align: left;
                font-size: 12px;
                font-weight: 700;
            }
            .grade7{
                border-bottom: 6px solid green;
                margin-top: 0in;
            }
            .stem{
                border-bottom: 6px solid green;
                margin-top: -10px;
            }
            .grade8{
                border-bottom: 6px solid yellow;
                margin-top: 0in;
            }
            .abm{
                border-bottom: 6px solid yellow;
                margin-top: -10px;
            }
            .grade9{
                border-bottom: 6px solid #bb0a1e;
                margin-top: 0in;
            }
            .grade10{
                border-bottom: 6px solid blue;
                margin-top: 0in;
            }
            .humss{
                border-bottom: 6px solid blue;
                margin-top: -10px;
            }
            .less-m-top{
                margin-top: -12px;
            }
            .less-m-top2{
                margin-top: -5px;
            }
        
    </style>
</head>
<body>
    @yield('content')
</body>
</html>