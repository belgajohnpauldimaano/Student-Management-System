<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Student Gradesheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
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

        .table-student-info {
            width: 600px;
        }
        
        .table-student-info th, .table-student-info td {
            border: none;
            padding: 0 2px 2px 2px;
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
    </style>
</head>
<body>
    <p class="heading1">Republic of the Philippines
    <p class="heading1">Department of Education</p>
    <p class="heading1">Region III</p>
    <p class="heading1">Division of Bataan</p>
    <br/>
    <h2 class="heading2 heading2-title">Saint John Academy</h2>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    <br/>
    <p class="report-progress m0">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</p>
    <p class="report-progress m0">( {{ $ClassDetail ?  $ClassDetail->section_grade_level >= 11 ? 'SENIOR HIGH SCHOOL' : 'JUNIOR HIGH SCHOOL' : ''}} )</p>
    <img class="logo sja-logo" width="100" src="{{ asset('img/sja-logo.png') }}" />
    <img class="logo deped-bataan-logo" width="100" src="{{ asset('img/deped-bataan-logo.png') }}" />
    <br/>
    <table class="table-student-info">
        <tr>
            <td>
                <p class="p0 m0 student-info"><b>Name</b> : {{ ucfirst($StudentInformation->last_name). ', ' .ucfirst($StudentInformation->first_name). ' ' . ucfirst($StudentInformation->middle_name) }}</p>
            </td>
            <td>
                <p class="p0 m0 student-info"><b>LRN</b> : {{ $StudentInformation->user->username }}</p>
            </td>
        </tr>
        
        <tr>
            <td>
                <p class="p0 m0 student-info"><b>Birthdate</b> : {{ $StudentInformation->birthdate ? date_format(date_create($StudentInformation->birthdate), 'M d, Y') : '' }}</p>
            </td>
            <td>
                <p class="p0 m0 student-info"><b>Age</b> : 
                 {{ $StudentInformation->birthdate ? date_diff(date_create($StudentInformation->birthdate), date_create(date("Y-m-d H:i:s")))->format('%y years old') : '' }}</p>
            </td>
        </tr>
        
        <tr>
            <td>
                <p class="p0 m0 student-info"><b>Grade & Section </b>: {{ $ClassDetail ? $ClassDetail->section_grade_level : '' }} - {{ $ClassDetail ? $ClassDetail->section : '' }}</p>
            </td>
            <td>
                <p class="p0 m0 student-info"><b>Sex</b> : {{ $StudentInformation->gender == 1 ? "Male" : "Female" }}</p>
            </td>
        </tr>
        
        <tr>
            <td>
                <p class="p0 m0 student-info"><b>School</b> Year : {{ $ClassDetail ? $ClassDetail->school_year : '' }}</p>
            </td>
            <td>
                <p class="p0 m0 student-info"><b>Curriculum</b> : K to 12 BASIC EDUCATION CURRICULUM</p>
            </td>
        </tr>
    </table>
    
    
    
    
    <br/>
    {{--  <h4>Subject : <span class="text-red"><i>{{ $ClassSubjectDetail->subject }}</i></span> Time : <span class="text-red"><i>{{ strftime('%r',strtotime($ClassSubjectDetail->class_time_from)) . ' - ' . strftime('%r',strtotime($ClassSubjectDetail->class_time_to)) }}</i></span> Days : <span class="text-red"><i>{{ $ClassSubjectDetail->class_days }}</i></span></h4>  --}}
    {{--  <h4>Grade & Section : <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>  --}}
    
                <table class="table no-margin">
                    <thead>
                        @if ($grade_level >= 11) 
                            <tr>
                                <th>Subject</th>
                                <th colspan="4">First Semester</th>
                                {{--  <th colspan="4">Second Semester</th>  --}}
                            </tr>
                            <tr>
                                <th></th>
                                <th>First Quarter</th>
                                <th>Second Quarter</th>
                                <th>Final Grade</th>
                                <th>Remarks</th>

                                {{--  <th>First Quarter</th>
                                <th>Second Quarter</th>
                                <th>Final Grade</th>
                                <th>Remarks</th>  --}}
                                {{--  <th>Final Average</th>
                                <th>Final Remarks</th>
                                <th>Faculty</th>  --}}
                            </tr>
                        @elseif($grade_level <= 10)
                            <tr>
                                <th>Subject</th>
                                <th>First Grading</th>
                                <th>Second Grading</th>
                                <th>Third Grading</th>
                                <th>Fourth Grading</th>
                                <th>Final Grading</th>
                                <th>Remarks</th>
                                {{--  <th>Faculty</th>  --}}
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if ($GradeSheetData)
                            <?php
                                $showGenAvg = 0;
                            ?>
                            @foreach ($GradeSheetData as $key => $data)
                                <tr>
                                    <td>{{ $data->subject }}</td>

                                    @if ($data->grade_status === -1)
                                        <td colspan="{{$ClassDetail ? $ClassDetail->section_grade_level <= 10 ? '6' : '4' : '6'}}" class="text-center text-red">Grade not yet finalized</td>
                                    @else 
                                        @if ($grade_level > 10)
                                            <?php
                                                $fQrtFinal = 0;
                                                $fQrtTotal = 0;
                                                $fQrtCtr = 0;
                                                if ($data->fir_g && $data->fir_g > 0) 
                                                {
                                                    $fQrtTotal += round($data->fir_g);
                                                    $fQrtCtr++;
                                                }

                                                if ($data->sec_g && $data->sec_g > 0) 
                                                {
                                                    $fQrtTotal += round($data->sec_g);
                                                    $fQrtCtr++;
                                                }

                                                if ($fQrtCtr > 1) 
                                                {
                                                    $fQrtFinal = round($fQrtTotal) / ($fQrtCtr);
                                                }
                                            ?>
                                            <td class="text-center">{{ $data->fir_g ? $data->fir_g > 0  ? round($data->fir_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $data->sec_g ? $data->sec_g > 0  ? round($data->sec_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $fQrtFinal ? round($fQrtFinal)   : '' }}</td>
                                            <td class="text-center">{{ $fQrtFinal ? $fQrtFinal > 74  ? 'Passed' : 'Failed' : '' }}</td>

                                            
                                            <?php
                                                /*$sQrtFinal = 0;
                                                $sQrtTotal = 0;
                                                $sQrtCtr = 0;
                                                if ($data->thi_g && $data->thi_g > 0) 
                                                {
                                                    $sQrtFinal += $data->thi_g;
                                                    $sQrtCtr++;
                                                }

                                                if ($data->fou_g && $data->fou_g > 0) 
                                                {
                                                    $sQrtTotal += $data->fou_g;
                                                    $sQrtCtr++;
                                                }

                                                if ($sQrtCtr > 1) 
                                                {
                                                    $sQrtTotal = $sQrtTotal / $sQrtCtr;
                                                }**/
                                            ?>
                                            {{--  <td>{{ $data->thi_g ? $data->thi_g > 0  ? round($data->thi_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $data->fou_g ? $data->fou_g > 0  ? round($data->fou_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $sQrtFinal ? $sQrtFinal   : '' }}</td>
                                            <td class="text-center">{{ $sQrtFinal ? $sQrtFinal > 74  ? 'Passed' : 'Failed' : '' }}</td>  --}}
                                            <?php
                                                /*$finalAvgCtr = 0;
                                                $finalAvg = 0;
                                                if ($fQrtFinal) 
                                                {
                                                    $finalAvg += $fQrtFinal;
                                                    $finalAvgCtr++;
                                                }
                                                
                                                if ($sQrtFinal) 
                                                {
                                                    $finalAvg += $sQrtFinal;
                                                    $finalAvgCtr++;
                                                }

                                                if ($finalAvgCtr > 1) 
                                                {
                                                    $showGenAvg = 1;
                                                    $finalAvg = 90;
                                                }*/
                                            ?>
                                            {{--  <td>{{ $finalAvg ? $finalAvg   : '' }}</td>  --}}
                                            {{--  <td style="color:{{ $finalAvg >= 75 ? 'green' : 'red' }};"><strong>{{ $finalAvg ? $finalAvg > 74  ? 'Passed' : 'Failed' : '' }}</strong></td>  --}}
                                        @else
                                            <td class="text-center">{{ $data->fir_g ? $data->fir_g > 0  ? round($data->fir_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $data->sec_g ? $data->sec_g > 0  ? round($data->sec_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $data->thi_g ? $data->thi_g > 0  ? round($data->thi_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $data->fou_g ? $data->fou_g > 0  ? round($data->fou_g) : '' : '' }}</td>
                                            <td class="text-center">{{ $data->fou_g ? $data->fou_g > 0  ? round($data->final_g) : '' : '' }}</td>
                                            @if ($data->fou_g > 0)
                                                <td>{{ round($data->final_g) }}</td>
                                                <td style="color:{{ $data->final_g >= 75 ? 'green' : 'red' }};"><strong>{{ $data->final_g >= 75 ? 'Passed' : 'Failed' }}</strong></td>
                                            @else
                                                <td></td>
                                            @endif  
                                        @endif
                                    @endif
                                    {{--  <td>{{ $data->class_time_from . ' -  ' . $data->class_time_to }}</td>
                                    <td>{{ $data->class_days }}</td>
                                    <td>{{ 'Room' . $data->room_code }}</td>  --}}
                                    {{--  <td>{{ $data->grade_level . ' - ' . $data->section }}</td>  --}}
                                    {{--  <td>{{ $data->faculty_name }}</td>  --}}
                                </tr>
                            @endforeach
                                <tr class="text-center">
                                    <td colspan="{{$grade_level <= 10 ? '5' : '3'}}"><b>General Average</b></td>
                                    {{--  <td colspan="{{$ClassDetail ? $ClassDetail->section_grade_level <= 10 ? '8' : '2' : '4'}}"><b>General Average</b></td>  --}}
                                    <td><b>{{$general_avg && $general_avg >= 0 ? round($general_avg) : '' }}</b></td>
                                    @if($general_avg && $general_avg > 75) 
                                        <td style="color:'green';"><strong>Passed</strong></td>
                                    @elseif($general_avg && $general_avg < 75) 
                                        <td style="color:'red';"><strong>Failed</strong></td>
                                    @else 
                                        <td></td>
                                    @endif
                                </tr>
                        @else
                            
                    @endif
                </tbody>
            </table>
            <br />
        <table style="width:60%">
            <tr>
                <th>
                    
                </th>
                    @foreach ($student_attendance['table_header'] as $data)
                            <th>{{ $data['key'] }}</th>
                    @endforeach
            </tr>
            <tr>
                <th>
                    Days of School
                </th>
                @foreach ($student_attendance['attendance_data']->days_of_school as $key => $data)
                    <th style="width:7%">{{ $data }}
                    </th>
                @endforeach
                <th class="days_of_school_total">
                    {{ $student_attendance['days_of_school_total'] }}
                </th>
            </tr>
            <tr>
                <th>
                    Days Present
                </th>
                @foreach ($student_attendance['attendance_data']->days_present as $key => $data)
                    <th style="width:7%">{{ $data }} 
                    </th>
                @endforeach
                <th class="days_present_total">
                    {{ $student_attendance['days_present_total'] }}
                </th>
            </tr>
            <tr>
                <th>
                    Days Present
                </th>
                @foreach ($student_attendance['attendance_data']->days_absent as $key => $data)
                    <th style="width:7%">{{ $data }}  
                    </th>
                @endforeach
                <th class="days_absent_total">
                    {{ $student_attendance['days_absent_total'] }}
                </th>
            </tr>
            <tr>
                <th>
                    Days Present
                </th>
                @foreach ($student_attendance['attendance_data']->times_tardy as $key => $data)
                    <th style="width:7%">{{ $data }}  
                    </th>
                @endforeach
                <th class="times_tardy_total">
                    {{ $student_attendance['times_tardy_total'] }}
                </th>
            </tr>
        </table>
    </body>
</html>