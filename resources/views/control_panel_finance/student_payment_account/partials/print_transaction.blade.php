<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Payment Invoice</title>
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
            font-size : 10px;
        }  --}}
        * {
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
            font-family: "Old English Text MT", Times, serif;
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
            top: 10px;
            left: 10px;
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
    </style>
</head>
<body>
    <h2 class="heading2 heading2-title">St. John's Academy Inc.</h2>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    <h3 class="heading2 ">Payment Invoice</h3>
    <img style="margin-right: 3em; margin-top: {{  asset('img/sja-logo.png') }}" width="115" />
    <div>

    <table class="table-student-info" style="margin-top: 25px; margin-bottom: 10px">
        <tr>
            <td>Student name: <strong>{{ $Transaction->student_name }}</strong></td>
            <td style="text-align: right">Student level: {{ $Transaction->payment_cat->grade_level_id }}</td>
        </tr>
        <tr>
            <td>School Year: <strong>{{ $Transaction->school_year }}</strong></td>
            <td style="text-align: right">Date: {{  now()->toDateTimeString('Y-m-d') }}</td>
        </tr>
    </table>       
                
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>OR Number</th>
                        <th>Tuition Fee</th>
                        <th>Misc Fee</th>
                        <th>Other Fee</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>        
                    
                    <td>{{  date_format(date_create($Transaction->updated_at), 'F d, Y h:i A') }}</td>
                    <td>{{ $Transaction->or_no }}</td>
                    <td>{{number_format($Transaction->payment_cat->tuition->tuition_amt, 2)}}</td>
                    <td>{{number_format($Transaction->payment_cat->misc_fee->misc_amt, 2)}}</td>
                    <td>{{number_format($Transaction->payment_cat->other_fee->other_fee_amt, 2)}}</td>
                    <td>{{ number_format($Transaction->payment , 2)}}</td>                        
                   
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <td colspan="4" style="text-align:right">Total:</td>
                        <td style="text-align:right">{{number_format($dataSum,2)}}</td>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
   
<br>
    {{-- {{ $PaymentCategory }} --}}
    <br>
    {{-- {{ $Transaction_disc }} --}}
</body>
</html>