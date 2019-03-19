<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Semester: <span class="text-red"><i>{{ $sem }}</i></span> / Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        
        .page-break {
            page-break-after: always;
        }
        td {
            border: 1px solid #000;
            padding: 2px;
        }
        th {
            border: 1px solid #000;
            padding: 2px;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            font-size : 11px;
            border: 1px solid black;
            
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
    {{--  <p class="heading1">Republic of the Philippines
    <p class="heading1">Department of Education</p>
    <p class="heading1">Region III</p>
    <p class="heading1">Division of Bataan</p>
    <br/>  --}}
    <h2 class="heading2 heading2-title">Saint John Academy</h2>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    
    <p class="report-progress m0">SENIOR HIGH SCHOOL</p>
    <p class="report-progress m0">S.Y. {{ $ClassSubjectDetail ? $ClassSubjectDetail->school_year : '' }}</p>
    {{--  <p class="report-progress m0">( {{ $ClassSubjectDetail ?  $ClassSubjectDetail->grade_level >= 11 ? 'SENIOR HIGH SCHOOL' : 'JUNIOR HIGH SCHOOL' : ''}} )</p>  --}}
    <img style="margin-top: -.4em; margin-left: 9em" class="logo" width="100" src="{{ asset('img/sja-logo.png') }}" />
    <br/>
    <br/>
    {{--  <p class="p0 m0 student-info">Grade sheet</p>  --}}
    {{--  <p class="p0 m0 student-info">School Year : <b>{{ $ClassSubjectDetail ? $ClassSubjectDetail->school_year : '' }}</b</p>  --}}
    <p class="p0 m0 student-info">Grade & Section : <b>{{ $ClassSubjectDetail ? $ClassSubjectDetail->grade_level : '' }} - {{ $ClassSubjectDetail ? $ClassSubjectDetail->section : '' }}</b</p>
    <p class="p0 m0 student-info">Semester: <span class="text-red"><i>{{ $sem }}</i></span> Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></p>
        
    <br/>
   
    <center>
    <table style="margin-top: -.8em" class="table no-margin">
        <thead>        
                <tr>
                    <th style="width: 8px">#</th>
                    <th style="width: 150px">Student Name</th>                                       
                    @foreach ($AdvisorySubject as $key => $sub)                                     
                        <th style="text-align: center;padding: 0%"> {{ $sub->subject_code }} </th>                                                                  
                    @endforeach 
                    <th style=" text-align:center; font-size: 10px; padding: 0%">GENERAL<br/> AVERAGE</th>
                    <th style=" text-align:center; font-size: 10px; padding: 0%">REMARKS</th>
                </tr>
            
        </thead>
        <tbody>     
            @if($NumberOfSubject->class_subject_order == 7)
                <tr>
                    <td colspan="11">
                        <b>Male</b>
                    </td>
                </tr>            
            @elseif($NumberOfSubject->class_subject_order == 8)
                <tr>
                    <td colspan="12">
                        <b>Male</b>
                    </td>
                </tr>
            @elseif($NumberOfSubject->class_subject_order == 9)
                <tr>
                    <td colspan="13">
                        <b>Male</b>
                    </td>
                </tr>
            @endif
            
            @foreach($GradeSheetMale as $key => $sub)
            <tr>
                @if($NumberOfSubject->class_subject_order == 7)
                    <td>{{ $key + 1 }}.</td>
                    <td>{{$sub->student_name}}</td>
                    <td><center>{{ $sub->subject_1 }}</center></td>
                    <td><center>{{ $sub->subject_2 }}</center></td>
                    <td><center>{{$sub->subject_3}}</center></td>
                    <td><center>{{$sub->subject_4}}</center></td>
                    <td><center>{{$sub->subject_5}}</center></td>
                    <td><center>{{$sub->subject_6}}</center></td>
                    <td><center>{{$sub->subject_7}}</center></td>
                    {{-- <td><center>{{$sub->subject_8}}</center></td>
                    <td><center>{{$sub->subject_9}}</center></td> --}}
                @elseif($NumberOfSubject->class_subject_order == 8)
                    <td>{{ $key + 1 }}.</td>
                    <td>{{$sub->student_name}}</td>
                    <td><center>{{ $sub->subject_1 }}</center></td>
                    <td><center>{{ $sub->subject_2 }}</center></td>
                    <td><center>{{$sub->subject_3}}</center></td>
                    <td><center>{{$sub->subject_4}}</center></td>
                    <td><center>{{$sub->subject_5}}</center></td>
                    <td><center>{{$sub->subject_6}}</center></td>
                    <td><center>{{$sub->subject_7}}</center></td>
                    <td><center>{{$sub->subject_8}}</center></td>
                    {{-- <td><center>{{$sub->subject_9}}</center></td> --}}
                @else
                    <td>{{ $key + 1 }}.</td>
                    <td>{{$sub->student_name}}</td>
                    <td><center>{{ $sub->subject_1 }}</center></td>
                    <td><center>{{ $sub->subject_2 }}</center></td>
                    <td><center>{{$sub->subject_3}}</center></td>
                    <td><center>{{$sub->subject_4}}</center></td>
                    <td><center>{{$sub->subject_5}}</center></td>
                    <td><center>{{$sub->subject_6}}</center></td>
                    <td><center>{{$sub->subject_7}}</center></td>
                    <td><center>{{$sub->subject_8}}</center></td>
                    <td><center>{{$sub->subject_9}}</center></td>
                @endif

                @if($NumberOfSubject->class_subject_order == 7)
                <td>
                        <center>                                                
                            <?php
                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                echo $formattedNum;
                            ?>
                        </center>
                </td>        
                @elseif($NumberOfSubject->class_subject_order == 8)
                <td>
                        <center>                                                
                            <?php
                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                echo $formattedNum;
                            ?>
                        </center>
                </td>
                @elseif($NumberOfSubject->class_subject_order == 9)
                <td>
                        <center>                                                
                            <?php
                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                echo $formattedNum;
                            ?>
                        </center>
                </td>
                @endif

                @if(round($average) >= 75 && round($average) <= 89)
                    <td>
                    <center>Passed</center>
                    </td>
                @elseif(round($average) >= 90 && round($average) <= 94)
                    <td>
                        <center>with honors</center>
                    </td>
                @elseif(round($average)>= 95 && round($average) <= 97)
                    <td>
                        <center>with high honors</center>
                    </td>
                @elseif(round($average) >= 98 && round($average) <= 100)
                    <td>
                        <center>with highest honors</center>
                    </td>
                @elseif(round($average) < 75)
                    <td>
                        <center>Failed</center>
                    </td>
                @endif
                        
                </tr>                                    
                @endforeach

            @if($NumberOfSubject->class_subject_order == 7)
                <tr>
                    <td colspan="11">
                        <b>Female</b>
                    </td>
                </tr>            
            @elseif($NumberOfSubject->class_subject_order == 8)
                <tr>
                    <td colspan="12">
                        <b>Female</b>
                    </td>
                </tr>
            @elseif($NumberOfSubject->class_subject_order == 9)
                <tr>
                    <td colspan="13">
                        <b>Female</b>
                    </td>
                </tr>
            @endif

            @foreach($GradeSheetFeMale as $key => $sub)
            <tr>
                @if($NumberOfSubject->class_subject_order == 7)
                    <td>{{ $key + 1 }}.</td>
                    <td>{{$sub->student_name}}</td>
                    <td><center>{{ $sub->subject_1 }}</center></td>
                    <td><center>{{ $sub->subject_2 }}</center></td>
                    <td><center>{{$sub->subject_3}}</center></td>
                    <td><center>{{$sub->subject_4}}</center></td>
                    <td><center>{{$sub->subject_5}}</center></td>
                    <td><center>{{$sub->subject_6}}</center></td>
                    <td><center>{{$sub->subject_7}}</center></td>
                    {{-- <td><center>{{$sub->subject_8}}</center></td>
                    <td><center>{{$sub->subject_9}}</center></td> --}}
                @elseif($NumberOfSubject->class_subject_order == 8)
                    <td>{{ $key + 1 }}.</td>
                    <td>{{$sub->student_name}}</td>
                    <td><center>{{ $sub->subject_1 }}</center></td>
                    <td><center>{{ $sub->subject_2 }}</center></td>
                    <td><center>{{$sub->subject_3}}</center></td>
                    <td><center>{{$sub->subject_4}}</center></td>
                    <td><center>{{$sub->subject_5}}</center></td>
                    <td><center>{{$sub->subject_6}}</center></td>
                    <td><center>{{$sub->subject_7}}</center></td>
                    <td><center>{{$sub->subject_8}}</center></td>
                    {{-- <td><center>{{$sub->subject_9}}</center></td> --}}
                @else
                    <td>{{ $key + 1 }}.</td>
                    <td>{{$sub->student_name}}</td>
                    <td><center>{{ $sub->subject_1 }}</center></td>
                    <td><center>{{ $sub->subject_2 }}</center></td>
                    <td><center>{{$sub->subject_3}}</center></td>
                    <td><center>{{$sub->subject_4}}</center></td>
                    <td><center>{{$sub->subject_5}}</center></td>
                    <td><center>{{$sub->subject_6}}</center></td>
                    <td><center>{{$sub->subject_7}}</center></td>
                    <td><center>{{$sub->subject_8}}</center></td>
                    <td><center>{{$sub->subject_9}}</center></td>
                @endif

                
                
                @if($NumberOfSubject->class_subject_order == 7)
                <td>
                        <center>                                                
                            <?php
                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                echo $formattedNum;
                            ?>
                        </center>
                </td>        
                @elseif($NumberOfSubject->class_subject_order == 8)
                <td>
                        <center>                                                
                            <?php
                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                echo $formattedNum;
                            ?>
                        </center>
                </td>
                @elseif($NumberOfSubject->class_subject_order == 9)
                <td>
                        <center>                                                
                            <?php
                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                echo $formattedNum;
                            ?>
                        </center>
                </td>
                @endif
               
                @if(round($average) >= 75 && round($average) <= 89)
                    <td>
                    <center>Passed</center>
                    </td>
                @elseif(round($average) >= 90 && round($average) <= 94)
                    <td>
                        <center>with honors</center>
                    </td>
                @elseif(round($average)>= 95 && round($average) <= 97)
                    <td>
                        <center>with high honors</center>
                    </td>
                @elseif(round($average) >= 98 && round($average) <= 100)
                    <td>
                        <center>with highest honors</center>
                    </td>
                @elseif(round($average) < 75)
                    <td>
                        <center>Failed</center>
                    </td>
                @endif
            </tr>
            @endforeach
            
            
        </tbody>
    </table>
</center>
    <p style="text-align: right"><b>{{$ClassSubjectDetail->first_name }} {{$ClassSubjectDetail->middle_name}} {{$ClassSubjectDetail->last_name}}</b> - <i>Class Adviser</i></p>

</body>
</html>