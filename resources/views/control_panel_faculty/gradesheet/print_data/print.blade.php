<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
        {{$quarter}} Quarter Grade sheet
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        {{--  .page-break {
            page-break-after: always;
        }
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
            left: -10em;
        }
        .text-red {
            color : #dd4b39 !important;
        }

        .text-green{
            color: green !important;
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
    </style>
</head>
<body>
    <h2 class="heading2 heading2-title">St. John's Academy Inc</h2>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    
    <p class="report-progress m0">
        {{$category == 'junior' ? 'JUNIOR HIGH-SCHOOL' : 'SENIOR HIGH-SCHOOL'}}
    </p>
    <p class="report-progress m0">S.Y. {{ $class_detail->school_year_id ? $class_detail->schoolYear->school_year : '' }}</p>
    <p class="report-progress m0">GRADE SHEET</p>
    
    <img style="margin-top: -.4em; margin-left: 6em" class="logo" width="100" src="{{ asset('img/sja-logo.png') }}" />
    <br/>
    <br/>
    
    <p class="p0 m0 student-info">Grade & Section : <b>{{ $class_detail->grade->id . '-' .$class_detail->section->section }}</b></p>
    @if($category == 'junior') 
        <p class="p0 m0 student-info">Quarter : <b><i>{{ $quarter }}</i></b></p>
    @else
        <p class="p0 m0 student-info">
            Semester &amp; Quarter : <b><i>{{ $sem }} | 
                @if($class_detail->grade->id >10)
                    @if($sem == 2)
                        {{ $quarter == '3rd' ? '1st' : '2nd'}}
                    @else
                        {{ $quarter }}
                    @endif
                @else
                    {{ $quarter }}
                @endif
            </i></b>
        </p>
    @endif
    <br/>

    @if($category == 'junior')
        @include('control_panel_faculty.gradesheet.print_data.data_junior')
    @else
        @include('control_panel_faculty.gradesheet.print_data.data_senior')
    @endif

    <table border="0" style="margin-top: 60px">
        <tr>
            <td class="text-center" width="50%" style="border: 0;"><b>Gemma R. Yao, PhD</b><br/><i>Principal</i></td>
        
            <td class="text-center" width="50%" style="border: 0;"><b>{{$class_detail->adviser->full_name }}</b><br/><i>Class Adviser</i></td>
        </tr>
    </table>

    {{-- <p style="text-align: right; font-size: 12px"><b>{{$class_detail->adviser->full_name }}</b> - <i>Class Adviser</i></p> --}}
</body>
</html>