<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Student Attendance</title>
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
            border: 0px;
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
    </style>
</head>
<body>
        <h3 style="text-align: center;margin-bottom: 0px">Saint John Academy</h3>
        @if($Semester->grade_level == '11' || $Semester->grade_level == '12')
            <h4 style="text-align: center; margin-top: 0px; margin-bottom: 0em">SENIOR HIGH SCHOOL</h4>
        @else
            <h4 style="text-align: center; margin-top: 0px; margin-bottom: 0em">JUNIOR HIGH SCHOOL</h4>
        @endif
        <h4 style="text-align: center; margin-top: 0px">Class Attendance</h4>
        <h5 class="text-center">
            S.Y. - {{$school_year->school_year}}<br/>
            @if($Semester->grade_level > 10)
                @if($Semester->sem == 1)
                    First Semester
                @endif

                @if($Semester->sem == 2)
                    Second Semester
                @endif
            @endif
        </h5>
        <img style="margin-left: 10em; margin-top: 0em"  class="logo sja-logo" width="85" src="{{ asset('img/sja-logo.png') }}" />

        <table>
            <thead>
                <tr>
                    <th style="width: 30px">#</th>
                    <th colspan="13" style="text-align:left">Student Name</th>
                </tr>
            </thead>
            <tbody>      
                                                            
            <tr>
                <td colspan="16">
                    <b>Male</b> 
                </td>
            </tr>

            @forelse ($attendance_male as $key => $data) 
            <tr>
                <td>{{ $key + 1 }}.</td>
                <td>
                    <b style="padding-top: 5px">
                        {{ $data['student_name'] }}
                    </b><br/>
                    
                        <table class="table" style="margin-top: 5px">
                            <tr>
                                <th>
                                    Title
                                </th>
                                    @foreach ($data['table_header'] as $item)
                                            <th>{{ $item['key'] }}</th> 
                                    @endforeach
                            </tr>
                            <tr>
                                <th>
                                    Days of School
                                </th>
                                @foreach ($data['attendance_data']->days_of_school as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}
                                    </th>                                                                        
                                @endforeach
                                <th class="days_of_school_total">
                                    {{ $data['days_of_school_total'] }}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Days Present
                                </th>
                                @foreach ($data['attendance_data']->days_present as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}    
                                    </th>
                                @endforeach
                                <th class="days_present_total">
                                    {{ $data['days_present_total'] }}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Days Absent
                                </th>
                                @foreach ($data['attendance_data']->days_absent as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}   
                                    </th>
                                @endforeach
                                <th class="days_absent_total">
                                    {{ $data['days_absent_total'] }}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Times Tardy
                                </th>
                                @foreach ($data['attendance_data']->times_tardy as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}    
                                    </th>
                                @endforeach
                                <th class="times_tardy_total">
                                    {{ $data['times_tardy_total'] }}
                                </th>
                            </tr>
                        </table>
                </td>
            </tr>
            @empty
            <tr>
                <th colspan="16" class="text-center">
                    No Available Data
                </th>
            </tr>
            @endforelse

            <tr>
                <td colspan="16">
                    <b>Female</b> 
                </td>
            </tr>

            @forelse ($attendance_female as $key => $data) 
            <tr>
                <td>{{ $key + 1 }}.</td>
                <td>
                    <b style="padding-top: 5px">
                        {{ $data['student_name'] }}
                    </b><br/>
                    
                        <table class="table" style="margin-top: 5px">
                            <tr>
                                <th>
                                    Title
                                </th>
                                    @foreach ($data['table_header'] as $item)
                                            <th>{{ $item['key'] }}</th> 
                                    @endforeach
                            </tr>
                            <tr>
                                <th>
                                    Days of School
                                </th>
                                @foreach ($data['attendance_data']->days_of_school as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}
                                    </th>                                                                        
                                @endforeach
                                <th class="days_of_school_total">
                                    {{ $data['days_of_school_total'] }}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Days Present
                                </th>
                                @foreach ($data['attendance_data']->days_present as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}    
                                    </th>
                                @endforeach
                                <th class="days_present_total">
                                    {{ $data['days_present_total'] }}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Days Absent
                                </th>
                                @foreach ($data['attendance_data']->days_absent as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}   
                                    </th>
                                @endforeach
                                <th class="days_absent_total">
                                    {{ $data['days_absent_total'] }}
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Times Tardy
                                </th>
                                @foreach ($data['attendance_data']->times_tardy as $key => $item)
                                    <th style="">
                                        {{ $item ? $item : '' }}    
                                    </th>
                                @endforeach
                                <th class="times_tardy_total">
                                    {{ $data['times_tardy_total'] }}
                                </th>
                            </tr>
                        </table>
                </td>
            </tr>
            @empty
            <tr>
                <th colspan="16" class="text-center">
                    No Available Data
                </th>
            </tr>
            @endforelse
            
        </table>

        {{-- <p style="text-align: right; font-size: 11px"><b>{{ $FacultyInformation->first_name.' '.$FacultyInformation->middle_name.' '.$FacultyInformation->last_name }}</b> <i>Class Adviser</i></p> --}}
        
</body>
</html>