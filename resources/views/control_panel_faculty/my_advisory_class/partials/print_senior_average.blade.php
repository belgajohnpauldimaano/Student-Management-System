<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fourth Quarter</title>
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
    
    <p class="report-progress m0">JUNIOR HIGH SCHOOL</p>
    <p class="report-progress m0">S.Y. {{ $ClassSubjectDetail ? $ClassSubjectDetail->school_year : '' }}</p>
    {{--  <p class="report-progress m0">( {{ $ClassSubjectDetail ?  $ClassSubjectDetail->grade_level >= 11 ? 'SENIOR HIGH SCHOOL' : 'JUNIOR HIGH SCHOOL' : ''}} )</p>  --}}
    <img style="margin-top: -.4em; margin-left: 9em" class="logo" width="100" src="{{ asset('img/sja-logo.png') }}" />
    <br/>
    <br/>
    {{--  <p class="p0 m0 student-info">Grade sheet</p>  --}}
    {{--  <p class="p0 m0 student-info">School Year : <b>{{ $ClassSubjectDetail ? $ClassSubjectDetail->school_year : '' }}</b</p>  --}}
    <p class="p0 m0 student-info">Grade & Section : <b>{{ $ClassSubjectDetail ? $ClassSubjectDetail->grade_level : '' }} - {{ $ClassSubjectDetail ? $ClassSubjectDetail->section : '' }}</b</p>
    <p class="p0 m0 student-info">Semester : <b><i>{{ $sem }}</i></b</p>
    <br/>
   
    
    <table class="table no-margin table-striped table-bordered">
                    <thead>
                        <tr>
                                <th style="width: 30px">#</th>
                                <th style="width: 200px">Student Name</th>                                       

                                @if($quarter == 'First - Second')
                                    <th style=" ; text-align: center">First Quarter</th>
                                    <th style=" ; text-align: center">Second Quarter</th>
                                @else
                                    <th style="  text-align: center">First Semester</th>
                                    <th style="  text-align: center">Second Semester</th>
                                @endif
    
                                <th style="  text-align: center">GENERAL AVERAGE</th>
                                <th style="  text-align: center">REMARKS</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if($sem == 'First')
                            
                                @if($NumberOfSubject->class_subject_order == 7)
                                    <tr>
                                        <td colspan="6">
                                            <b>Male</b>
                                        </td>
                                    </tr>
                                    @foreach($GradeSheetMale as $key => $sub)
                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ $sub->student_name }}</td>
                                        <td style="text-align: center">
                                            <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                            echo $formattedNum;
                                            ?>                                                
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                                $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                                echo $result;
                                            ?>    
                                            </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result) / 2);
                                            ?>
                                        </td>
                                        @if(round($result_final) >= 75 && round($result_final) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($result_final) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                
                                        <tr>
                                            <td colspan="6">
                                                <b>Female</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetFeMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $sub->student_name }}</td>
                                            <td style="text-align: center">
                                                <?php
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                @elseif($NumberOfSubject->class_subject_order == 8)
                                    <tr>
                                        <td colspan="6">
                                            <b>Male</b>
                                        </td>
                                    </tr>
                                    @foreach($GradeSheetMale as $key => $sub)
                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ $sub->student_name }}</td>
                                        <td style="text-align: center">
                                            <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                            echo $formattedNum;
                                            ?>                                                
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                                $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7+$sec_g->subject_8)/8), 0);
                                                echo $result;
                                            ?>    
                                            </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result) / 2);
                                            ?>
                                        </td>
                                        @if(round($result_final) >= 75 && round($result_final) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($result_final) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                
                                        <tr>
                                            <td colspan="6">
                                                <b>Female</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetFeMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $sub->student_name }}</td>
                                            <td style="text-align: center">
                                                <?php
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7+$sec_g->subject_8)/8), 0);
                                                echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <b>Male</b>
                                        </td>
                                    </tr>
                                    @foreach($GradeSheetMale as $key => $sub)
                                    <tr>
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{ $sub->student_name }}</td>
                                        <td style="text-align: center">
                                            <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9), 0);
                                            echo $formattedNum;
                                            ?>                                                
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                                $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                                echo $result;
                                            ?>    
                                            </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result) / 2);
                                            ?>
                                        </td>
                                        @if(round($result_final) >= 75 && round($result_final) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($result_final) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                
                                        <tr>
                                            <td colspan="6">
                                                <b>Female</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetFeMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $sub->student_name }}</td>
                                            <td style="text-align: center">
                                                <?php
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8+ $sub->subject_9)/9), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                @endif
                                
                            @elseif($sem == 'Second')
                                        
                                    @if($NumberOfSubject->class_subject_order == 7)
                                        <tr>
                                            <td colspan="6">
                                                <b>Male</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $sub->student_name }}</td>
                                            <td style="text-align: center">
                                                <?php
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                                    echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    
                                            <tr>
                                                <td colspan="6">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                            @foreach($GradeSheetFeMale as $key => $sub)
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{ $sub->student_name }}</td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                                        echo $result;
                                                    ?>    
                                                    </td>
                                                <td style="text-align: center">
                                                    <?php 
                                                        echo round($result_final = ($formattedNum + $result) / 2);
                                                    ?>
                                                </td>
                                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($result_final) < 75)
                                                    <td>
                                                        <center>Failed</center>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                    @elseif($NumberOfSubject->class_subject_order == 8)
                                        <tr>
                                            <td colspan="6">
                                                <b>Male</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $sub->student_name }}</td>
                                            <td style="text-align: center">
                                                <?php
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                                    echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    
                                            <tr>
                                                <td colspan="6">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                            @foreach($GradeSheetFeMale as $key => $sub)
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{ $sub->student_name }}</td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                                    echo $result;
                                                    ?>    
                                                    </td>
                                                <td style="text-align: center">
                                                    <?php 
                                                        echo round($result_final = ($formattedNum + $result) / 2);
                                                    ?>
                                                </td>
                                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($result_final) < 75)
                                                    <td>
                                                        <center>Failed</center>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <b>Male</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $sub->student_name }}</td>
                                            <td style="text-align: center">
                                                <?php
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                                    echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    
                                            <tr>
                                                <td colspan="6">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                            @foreach($GradeSheetFeMale as $key => $sub)
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{ $sub->student_name }}</td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8+ $sub->subject_9)/9), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                                        echo $result;
                                                    ?>    
                                                    </td>
                                                <td style="text-align: center">
                                                    <?php 
                                                        echo round($result_final = ($formattedNum + $result) / 2);
                                                    ?>
                                                </td>
                                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($result_final) < 75)
                                                    <td>
                                                        <center>Failed</center>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                    @endif
                            @else

                                @if($NumberOfSubject->class_subject_order == 7)
                                <tr>
                                    <td colspan="6">
                                        <b>Male</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                        
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                            
                                        ?>    
                                    
                                            <?php
                                                $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                                $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7)/7), 0);
                                                
                                            ?>    
                                    
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7)/7), 0);
                                            
                                        ?>    
                                    
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_1sem = ($formattedNum + $result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php 
                                            echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                        ?>
                                    </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
                                        <td>
                                            <center>Failed</center>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        
                                <tr>
                                    <td colspan="6">
                                        <b>Female</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                        ?>    
                                        
                                        <?php
                                            $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                            $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7)/7), 0);
                                        ?>    
                                        
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7)/7), 0);
                                        ?>    
                                        
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_1sem = ($formattedNum + $result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                            ?>
                                        </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
                                        <td>
                                            <center>Failed</center>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        @elseif($NumberOfSubject->class_subject_order == 8)
                            <tr>
                                <td colspan="6">
                                    <b>Male</b>
                                </td>
                            </tr>
                            @foreach($GradeSheetMale as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                    ?>                                                
                                
                                    <?php
                                        $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                    ?>    
                                    
                                    <?php
                                        $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                        $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8)/8), 0);
                                    ?>    
                                    
                                    <?php
                                        $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8)/8), 0);
                                    ?>    
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_1sem = ($formattedNum + $result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php 
                                            echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                        ?>
                                    </td>
                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($result_final) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        
                                <tr>
                                    <td colspan="6">
                                        <b>Female</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                        
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                       ?>    
                                        
                                        <?php
                                            $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                            $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8)/8), 0);
                                        ?>    
                                        
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8)/8), 0);
                                        ?>    
                                        
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_1sem = ($formattedNum + $result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                            ?>
                                        </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
                                        <td>
                                            <center>Failed</center>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <b>Male</b>
                                </td>
                            </tr>
                            @foreach($GradeSheetMale as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9), 0);
                                        //echo $formattedNum;
                                    ?>                                                
                                
                                    <?php
                                        $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                        //echo $result;
                                    ?>    
                                    
                                    <?php
                                        $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                        $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8 + $thi_g->subject_9)/9), 0);
                                                //echo $thi_result;
                                    ?>    
                                    
                                    <?php
                                        $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8+ $thi_g->subject_9)/9), 0);
                                            //echo $fou_result;
                                    ?>    
                                    
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_1sem = ($formattedNum + $result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php 
                                            echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                        ?>
                                    </td>
                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($result_final) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        
                                <tr>
                                    <td colspan="6">
                                        <b>Female</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8+ $sub->subject_9)/9), 0);
                                        
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);;
                                        ?>    
                                        
                                        <?php
                                            $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                            $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8 + $thi_g->subject_9)/9), 0);
                                                    
                                        ?>    
                                        
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8+ $thi_g->subject_9)/9), 0);
                                                
                                        ?>    
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_1sem = ($formattedNum + $result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                            ?>
                                        </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
                                        <td>
                                            <center>Failed</center>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        @endif
                            @endif
                    </tbody>
            </table>

    <p style="text-align: right"><b>{{$ClassSubjectDetail->first_name }} {{$ClassSubjectDetail->middle_name}} {{$ClassSubjectDetail->last_name}}</b> - <i>Class Adviser</i></p>

</body>
</html>