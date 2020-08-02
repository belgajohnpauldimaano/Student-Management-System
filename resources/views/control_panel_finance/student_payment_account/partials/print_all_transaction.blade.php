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
            font-size : 12px;
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
            font-size : 13px;
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
            font-family: " Old English Text MT", Times, serif;
            /* font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif */
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
    <h3 class="heading2 ">Payment Transaction History</h3>
    <img style="margin-right: 3em; margin-top: {{  asset('img/sja-logo.png') }}" width="115" />
    <div>

    <table class="table-student-info" style="margin-top: 25px; margin-bottom: 10px; font-size:15px ">
        <tr>
            <td>Student name: <strong>{{$Modal_data->student->last_name.', '.$Modal_data->student->first_name.' '.$Modal_data->student->middle_name}}</strong></td>
            <td>Status: <strong>{{ $Modal_data->status ? $Modal_data->status == 0 ? 'Paid' : 'Not yet paid' : 'Paid'}}</strong></td>
        </tr>
        <tr>
            <td>School Year: <strong>{{ $Modal_data->schoolyear->school_year }}</strong></td>
            <td>Grade level: <strong>{{$Modal_data->payment_cat->stud_category->student_category.'-'.$Modal_data->payment_cat->grade_level_id}}</strong></td>
        </tr>
    </table>  
                        
    <div class="box">
       
        <div class="box-body no-padding">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr  style="text-align: center !important">
                        <td colspan="2">
                            <b>Student Account</b>
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 50%">Description</th>
                        <th>Amount</th>
                        {{-- <th style="width: 40px">Label</th> --}}
                    </tr>
                    <tr>
                        <td>Tuition Fee</td>
                        <td style="text-align: right">
                            ₱ {{ number_format($Modal_data->payment_cat->tuition->tuition_amt, 2)}}
                        </td>                                
                    </tr>
                    <tr>
                        <td>Misc Fee</td>
                        <td style="text-align: right">
                            ₱ {{ number_format($Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                        </td>                                
                    </tr>
                    @foreach ($OtherFee as $item)
                    <tr>
                        <td>Other Fee - {{ $item ? $item->other_name : 'NA'}}</td>
                        <td style="text-align: right">
                            ₱ {{ number_format($item->item_price, 2)}}
                        </td>
                    </tr>
                    @endforeach
                    {{-- <tr>
                        <td>Other Fee - {{ $other_fee ? $other_fee->other_name : 'NA'}}</td>
                        <td style="text-align: right">
                            ₱ {{ number_format($other, 2)}}
                        </td>
                    </tr> --}}
                    @foreach ($Discount_amt as $item)
                    <tr>
                        <td>Discount Fee ({{$item->discount_type}})</td>
                        <td style="text-align: right">
                            ₱ {{ number_format($item->discount_amt,2) }}
                        </td>
                    </tr>
                    @endforeach
                    
                    <tr>
                        <td>Total Fees</td>
                        <td style="text-align: right"> <b> ₱
                            @if($Discount)
                                 {{ number_format($total, 2)}}
                            @else
                                {{ number_format($total, 2)}}
                            @endif     
                        </b>                                           
                        </td>                                
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
     
    {{-- TRANSACTION HISTORY --}}
    <h4>Transaction History</h4>
    <div class="box">
        @foreach ($Mo_history as $data)                        
            <div class="box-header ">                

                <table class="table-student-info" style="margin-top: 15px; margin-bottom: 10px; font-size:15px ">
                    <tr>
                        <td>Date and Time: <strong>{{ $Modal_data ? date_format(date_create($Modal_data->created_at), 'F d, Y h:i A') : '' }}</strong></td>
                        <td>Status: <strong>{{ $data->approval ? $data->approval == 'Approved' ? 'Approved' : 'Not yet Approved' : 'Not yet Approved'}}</strong></td>
                    </tr>
                   
                    <tr>
                        <td>Email address: <strong>{{$data->email}}</strong></td>
                        <td>Payment option: <strong>{{$data->payment_option}}</strong></td>
                    </tr>
                </table>   
            </div>
                
            <div class="box-body no-padding">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 50%">Description</th>
                            <th>Amount</th>
                            {{-- <th style="width: 40px">Label</th> --}}
                        </tr>
                        <tr>
                            <td>Payment Option</td>
                            <td>
                                {{ $data->payment_option}}
                            </td>                                
                        </tr>
                            <td>Paid Fee</td>
                            <td>
                                ₱ {{ number_format($data->payment, 2)}}
                            </td>                                
                        </tr>
                        <tr>
                            <td>Balance Fee</td>
                            <td>
                                ₱ {{ $data->approval == 'Approved' ? number_format($data->balance, 2) : $data->tuition_amt + $data->misc_amt}}
                            </td>                                
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach

        <div style="margin-top: 50px">
            <p>Prepared By:</p><br/>
            <p>
                {{ $fullname }}<br/>
                <span style="text-align: center"><i>Finance Officer</i></span>
            </p>
        </div>
       
    </div>
                                         
</body>