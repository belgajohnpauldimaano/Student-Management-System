<table class="table no-margin">
    <thead>
        <tr>
            <th>Subject</th>
            <th style="width: 100px">First Quarter</th>
            <th style="width: 100px">Second Quarter</th>
            <th style="width: 100px">Final Grade</th>
            <th style="width: 100px">Remarks</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            
            $SchoolYear = \App\SchoolYear::where('current', 1)->where('status', 1)->first();
            
            $Enrollment = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            // ->join('student_enrolled_subjects', 'student_enrolled_subjects.enrollments_id', '=', 'enrollments.id')
            ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
            ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
            ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')                                
            ->select(\DB::raw("
                enrollments.id as enrollment_id,
                enrollments.class_details_id as cid,
                enrollments.attendance_first,
                enrollments.attendance_second,
                enrollments.j_lacking_unit,
                enrollments.s1_lacking_unit,
                class_details.grade_level,
                class_subject_details.id as class_subject_details_id,
                class_subject_details.class_days,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.status as grade_status,
                class_subject_details.class_subject_order,
                class_subject_details.class_details_id,
                CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                subject_details.id AS subject_id,
                subject_details.subject_code,
                subject_details.subject,
                rooms.room_code,
                section_details.section
                
            "))
            ->where('enrollments.student_information_id', $StudentInformation->id)
            ->where('class_subject_details.status', '!=', 0)
            ->where('enrollments.status', 1)
            ->where('class_details.status', 1)
            ->where('class_subject_details.sem', 1)
            ->where('class_details.school_year_id', $SchoolYear->id)
            ->orderBy('class_subject_details.class_subject_order', 'ASC')
            ->get();
            
            $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
            ->where('sem', 1)
            ->get();
        ?>
        @foreach($Enrollment as $key => $data)
        <tr>
            <td>
                <?php                                     

                    $subject = \App\ClassSubjectDetail::where('id', $data->class_subject_details_id)                                        
                        ->orderBY('class_subject_order', 'ASC')->get();

                    echo \App\SubjectDetail::where('id', $subject[0]->subject_id)->first()->subject; 
                    //echo $ClassSubjectDetail->subject;   
                ?>
            </td>
            
            <td style="text-align: center">
                <?php 
                     $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                    ->where('subject_id', $data->subject_id)
                    ->where('class_subject_details_id', $data->class_subject_details_id)
                    ->where('sem', 1)
                    ->first(); 
                    
                    if($StudentEnrolledSubject1)
                    {
                        echo $StudentEnrolledSubject1->fir_g ? $StudentEnrolledSubject1->fir_g > 0 ? round($StudentEnrolledSubject1->fir_g) : '' : '';
                    }
                    
                    
                ?>
                {{-- {{ $data->fir_g ? $data->fir_g > 0  ? round($data->fir_g) : '' : '' }} --}}
             </td>
            <td style="text-align: center">
                <?php 
                     $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                    ->where('subject_id', $data->subject_id)
                    ->where('sem', 1)
                    ->first(); 

                    if($StudentEnrolledSubject1)
                    {
                        echo $StudentEnrolledSubject1->sec_g ? $StudentEnrolledSubject1->sec_g > 0 ? round($StudentEnrolledSubject1->sec_g) : '' : '';
                    }
                ?>
                {{-- {{ $data->sec_g ? $data->sec_g > 0  ? round($data->sec_g) : '' : '' }} --}}
            </td>
            <td style="text-align: center">
                <?php 
                    $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                    ->where('subject_id', $data->subject_id)
                    ->where('sem', 1)
                    ->first(); 

                    if($StudentEnrolledSubject1)
                    {
                        if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0)
                        {
                            echo round($final_ave = (round($StudentEnrolledSubject1->fir_g) + round($StudentEnrolledSubject1->sec_g)) / 2);
                            // echo $final_ave = (round($data->fir_g) + round($data->sec_g)) / 2;
                        }
                        else 
                        {
                            echo "";
                        }    
                    }                                    
                ?>
            </td>
            @if($StudentEnrolledSubject1)                                
                @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0) 
                    @if($final_ave && $final_ave > 74) 
                        <td style="color:'green'; text-align: center"><strong>Passed</strong></td>
                    @elseif($final_ave && $final_ave < 75) 
                        <td style="color:'red'; text-align: center"><strong>Failed</strong></td>
                    @endif
                @else
                    <td></td>
                @endif
            @else    
                <td></td>   
            @endif                        
            
        </tr>
        @endforeach
        
        <tr class="text-center">
                <td colspan="{{$grade_level <= 10 ? '5' : '3'}}"><b>General Average</b></td>
                {{--  <td colspan="{{$ClassDetail ? $ClassDetail->section_grade_level <= 10 ? '8' : '2' : '4'}}"><b>General Average</b></td>  --}}
                <td>
                    <b>
                        <?php 
                            $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                            ->where('subject_id', $data->subject_id)
                            ->where('sem', 1)
                            ->first();     
                        ?>

                        @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0)
                            
                            <?php
                             $totalsum = 0;
                             $count_subjects1 = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                                ->where('sem', 1)->where('status', '!=', 0)->count();
                            // echo $count_subjects1;

                            $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                                ->where('sem', 1)
                                ->get();
                            ?>
                            @foreach($StudentEnrolledSubject as $key => $data)
                            <?php                                                    
                                round($final_ave = (round($data->fir_g) + round($data->sec_g)) / 2);
                                $totalsum += round($final_ave) / 9 ;   
                            ?>
                            @endforeach
                            <?php
                             echo round($totalsum);
                            ?>   
                        @else
                            
                        @endif
                    </b>
                </td>
                @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0)
                    @if(round($totalsum) > 74) 
                        <td style="color:'green';"><strong>Passed</strong></td>
                        
                    @elseif(round($totalsum) < 75) 
                        
                        <td style="color:'red';"><strong>Failed</strong></td>
                    @else 
                        <td></td>
                    @endif
                @else
                    <td></td>
                @endif
                
        </tr>
    </tbody>
</table>
<?php
$student_attendance = [];
$table_header = 
[
    ['key' => 'Jun',],
    ['key' => 'Jul',],
    ['key' => 'Aug',],
    ['key' => 'Sep',],
    ['key' => 'Oct',],
    ['key' => 'total',],
];

$attendance_data = json_decode(json_encode([
    'days_of_school' => [
        0, 0, 0, 0, 0, 
    ],
    'days_present' => [
        0, 0, 0, 0, 0,
    ],
    'days_absent' => [
        0, 0, 0, 0, 0,
    ],
    'times_tardy' => [
        0, 0, 0, 0, 0,
    ]
]));


$attendance_data = json_decode($Enrollment[0]->attendance_first);

$student_attendance = [
    
    'attendance_data'   => $attendance_data,
    'table_header'      => $table_header,
    'days_of_school_total' => array_sum($attendance_data->days_of_school),
    'days_present_total' => array_sum($attendance_data->days_present),
    'days_absent_total' => array_sum($attendance_data->days_absent),
    'times_tardy_total' => array_sum($attendance_data->times_tardy),
];
?>
<p class="report-progress-left m0"  style="margin-top: .5em"><b>ATTENDANCE RECORD</b></p>
<table style="width:100%; margin-bottom: 1em">
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
        Days Absent
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
        Times Tardy
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

<center>
<table border="0" style="width: 80%">

    <tr style="margin-top: .5em">
        <td style="border: 0">Description</td>
        <td style="border: 0">Grading Scale</td>
        <td style="border: 0">Remarks</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">With Highest Honors</td>
        <td style="border: 0">98-100</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">With High Honors</td>
        <td style="border: 0">95-97</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">With Honors</td>
        <td style="border: 0">90-94</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">Passed</td>
        <td style="border: 0">75-79</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">Failed</td>
        <td style="border: 0">Below 75</td>
        <td style="border: 0">Failed</td>                
    </tr>
    <tr style="margin-top: .5em">
        <td style="border: 0"></td>
        <td style="border: 0"></td>
        <td style="border: 0"></td>   
    </tr>

    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Eligible to transfer and admission to:
        
            @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0)
                @if(round($totalsum) > 74)                     
                        <strong><u>&nbsp;&nbsp;Grade {{ $ClassDetail->section_grade_level + 1}}</u></strong>                                                    
                @elseif(round($totalsum) < 75)                     
                   <strong>Failed</strong>
                @else 
                ________________________________
                @endif
            @else
            ________________________________
            @endif        
       
        </td>                
    </tr>

    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Lacking units in:___<u>{{ $Enrollment[0]->s1_lacking_unit ? date_format(date_create($Enrollment[0]->s1_lacking_unit), 'F d, Y') : '' }}</u>____</td>
        {{-- <td colspan="3" style="border: 0">Lacking units in:__________________</td>                 --}}
    </tr>
    
    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Date:___<u>{{ $DateRemarks->s_date1 }}</u>____</td>      
        {{-- <td colspan="3" style="border: 0">Date:__________________</td>                 --}}
    </tr>
    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">&nbsp;</td>   </tr>
    {{-- <tr> <td colspan="3" style="border: 0">&nbsp;</td>   </tr> --}}

    <tr style="margin-top: 0em">
            <table border="0" style="width: 100%; margin-top: -1em" class="pb-1">
                
                    <tr>
                        <td style="border: 0; width: 50%;">
                            <center>
                                @if($ClassDetail->faculty_id == 46 )
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}" 
                                    style="width:100px; margin-top: -5em">
                                @elseif($ClassDetail->faculty_id == 71 || $ClassDetail->faculty_id == 79)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}" 
                                    style="width:100px; margin-top: -1em">
                                @elseif($ClassDetail->faculty_id == 52 || $ClassDetail->faculty_id == 76 || $ClassDetail->faculty_id == 73)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}" 
                                    style="width:170px; margin-top: -1em">
                                @elseif($ClassDetail->faculty_id == 36)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}" 
                                    style="width:170px; margin-top: -1.5em">
                                @else
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}"
                                    style="width:100px">
                                @endif
                            </center>
                        </td>
                        <td style="border: 0; width: 50%;">
                            <center>
                                <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ asset('/img/signature/principal_signature.png') }}"
                                style="width:170px">
                            </center>
                        </td>
                    </tr>
            </table>
            @if($ClassDetail->faculty_id == 46 || $ClassDetail->faculty_id == 52 )
                <table border="0" style="width: 100%; margin-top: -85px; margin-bottom: 0em">     
            @elseif($ClassDetail->faculty_id == 71 || $ClassDetail->faculty_id == 70 || $ClassDetail->faculty_id == 79)
                <table border="0" style="width: 100%; margin-top: -90px; margin-bottom: 0em">
            @elseif($ClassDetail->faculty_id == 76 || $ClassDetail->faculty_id == 73 || $ClassDetail->faculty_id == 36)
                <table border="0" style="width: 100%; margin-top: -87px; margin-bottom: 0em">     
            @else
                <table border="0" style="width: 100%; margin-top: -70px; margin-bottom: 0em">
            @endif                              
                <tr>
                    <td style="border: 0; width: 50%; height: 100px">
                        <span style="margin-left: 2em; text-transform: uppercase">
                            <center>
                            {{ $ClassDetail->first_name }} {{ $ClassDetail->middle_name }} {{ $ClassDetail->last_name }}</center>
                            </br>
                            <center style="margin-top: -1em">Adviser</center>
                        </span>
                    </td>
                    <td style="border: 0; width: 50%; height: 100px">
                            <span style="margin-left: 23em;">
                                <center>Gemma R. Yao, Ph.D.</center>
                                </br>
                                <center style="margin-top: -1em">PRINCIPAL</center>
                            </span>
                        </td>
                </tr>
            </table>
        
    </tr>
    

</table>

<div class="page-break"></div>
</center>