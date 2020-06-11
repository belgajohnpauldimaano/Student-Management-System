<table class="table no-margin less-m-top">
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
                ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                ->where('student_information_id', $StudentInformation->id)
                ->where('class_subject_details.status', '!=', 0)
                ->where('class_subject_details.sem', 2)
                ->where('enrollments.status', 1)
                ->where('class_details.status', 1)                            
                ->where('class_details.school_year_id', $SchoolYear->id)
                ->select(\DB::raw("
                    enrollments.id as enrollment_id,
                    enrollments.class_details_id as cid,
                    enrollments.attendance_first,
                    enrollments.attendance_second,
                    enrollments.s2_lacking_unit,
                    enrollments.eligible_transfer,
                    class_details.grade_level,
                    class_subject_details.id as class_subject_details_id,
                    class_subject_details.class_days,
                    class_subject_details.class_time_from,
                    class_subject_details.class_time_to,
                    class_subject_details.status as grade_status,
                    CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                    subject_details.id AS subject_id,
                    subject_details.subject_code,
                    subject_details.subject,
                    rooms.room_code,
                    section_details.section
                    
                "))
                ->orderBy('class_subject_details.class_subject_order', 'ASC')
                ->get();
            
            $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
            ->where('sem', 2)->where('status', 1)
            ->get();
        ?>

        <?php $__currentLoopData = $Enrollment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            ->where('sem', 2)
                            ->first();

                        if($StudentEnrolledSubject1)
                        {
                            echo $StudentEnrolledSubject1->thi_g ? $StudentEnrolledSubject1->thi_g > 0 ? round($StudentEnrolledSubject1->thi_g) : '' : '';
                        }
                    ?>
                 </td>
                <td style="text-align: center">
                    <?php 
                         $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                        ->where('subject_id', $data->subject_id)
                        ->where('sem', 2)
                        ->first(); 

                        if($StudentEnrolledSubject1)
                        {
                            echo $StudentEnrolledSubject1->fou_g ? $StudentEnrolledSubject1->fou_g > 0 ? round($StudentEnrolledSubject1->fou_g) : '' : '';
                        }
                    ?>                    
                </td>
                <td style="text-align: center">
                    <?php 
                        $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                        ->where('subject_id', $data->subject_id)
                        ->where('sem', 2)
                        ->first(); 

                        if($StudentEnrolledSubject1)
                        {
                            if(round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0)
                            {
                                echo round($final_ave = (round($StudentEnrolledSubject1->thi_g) + round($StudentEnrolledSubject1->fou_g)) / 2);
                            }
                            else 
                            {
                                echo "";
                            }
                        }                                      
                    ?>
                </td>
                
                <?php if($StudentEnrolledSubject1): ?>
                    <?php if($StudentEnrolledSubject1->thi_g == 0 || $StudentEnrolledSubject1->fou_g == 0): ?>
                        <?php if($general_avg > 74): ?> 
                            <td></td>                            
                        <?php elseif($general_avg < 75): ?> 
                            <td style="text-align:center"><strong>Failed</strong></td>
                        <?php else: ?> 
                            <td style="text-align:center;"><strong>Passed</strong></td>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($general_avg > 74): ?> 
                            <td style="text-align:center;"><strong>Passed</strong></td>                            
                        <?php elseif($general_avg < 75): ?> 
                            <td style="text-align:center"><strong>Failed</strong></td>
                        <?php else: ?> 
                        <td style="text-align:center;"><strong>Passed</strong></td>
                        <?php endif; ?>
                    <?php endif; ?>                        
                <?php else: ?>
                    <td></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <tr class="text-center">
            <td colspan="<?php echo e($grade_level <= 10 ? '5' : '3'); ?>"><b>General Average</b></td>
            
            <td>
                <b>
                    <?php 
                        $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                        ->where('subject_id', $data->subject_id)
                        ->where('sem', 2)
                        ->first();     
                    ?>
                             
                    <?php if(round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0): ?>
                        
                        <?php
                            $totalsum = 0;
                            $count_subjects1 = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                            ->where('sem', 2)->where('status', '!=', 0)->count();
                        ?>
                        <?php $__currentLoopData = $StudentEnrolledSubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php                                                    
                            round($final_ave = (round($data->thi_g) + round($data->fou_g)) / 2);                                                                                                
                            $totalsum+= round($final_ave) / $count_subjects1 ;   
                            // echo $sum;                                                                                                         
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            echo round($totalsum);
                        ?>
                    <?php else: ?>
                        
                    <?php endif; ?>
                </b>
            </td>
            <?php 
                $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                    ->where('subject_id', $data->subject_id)
                    ->where('sem', 2)
                    ->first(); 
            ?>
            <?php if(round($StudentEnrolledSubject1->thi_g) != 0 || round($StudentEnrolledSubject1->fou_g) != 0): ?>
                <?php if(round($totalsum) > 74): ?> 
                    <td style="color:'green';"><strong>Passed</strong></td>
                    
                <?php elseif(round($totalsum) < 75): ?> 
                    
                    <td style="color:'red';"><strong>Failed</strong></td>
                <?php else: ?> 
                    <td></td>
                <?php endif; ?>
            <?php else: ?>
                <td></td>
            <?php endif; ?>                
        </tr>
    </tbody>
</table>

<table style="margin-top: 15px">
    <tfoot>
        <td style="text-align: right">
            <b>FINAL AVERAGE:</b> 
        </td>
        <td style="width: 100px; text-align: center">
            <b><?php echo e(round($general_avg, 0)); ?></b>
        </td>
        
    </tfoot>
</table>

<?php
    $student_attendance = [];
    
    if($SchoolYear->id == 9){
        $table_header = [
            ['key' => 'Nov',],
                ['key' => 'Dec',],
                ['key' => 'Jan',],
                ['key' => 'Feb',],
                ['key' => 'Mar*',],
                ['key' => 'Apr*',],
                
                ['key' => 'total',],
            ];
    }else{
        $table_header = [
            ['key' => 'Nov',],
                ['key' => 'Dec',],
                ['key' => 'Jan',],
                ['key' => 'Feb',],
                ['key' => 'Mar',],
                ['key' => 'Apr',],
                
                ['key' => 'total',],
            ];
    }

    
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
    
    $attendance_data = json_decode($Enrollment[0]->attendance_second); 

    $student_attendance = [
        // 'student_name'      => $EnrollmentMale[0]->student_name,
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
        <?php $__currentLoopData = $student_attendance['table_header']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($data['key']); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
<tr>
    <th>
        Days of School
    </th>
    <?php $__currentLoopData = $student_attendance['attendance_data']->days_of_school; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th style="width:7%"><?php echo e($data); ?>

        </th>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <th class="days_of_school_total">
        <?php echo e($student_attendance['days_of_school_total']); ?>

    </th>
</tr>
<tr>
    <th>
        Days Present
    </th>
    <?php $__currentLoopData = $student_attendance['attendance_data']->days_present; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th style="width:7%"><?php echo e($data); ?> 
        </th>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <th class="days_present_total">
        <?php echo e($student_attendance['days_present_total']); ?>

    </th>
</tr>
<tr>
    <th>
        Days Absent
    </th>
    <?php $__currentLoopData = $student_attendance['attendance_data']->days_absent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th style="width:7%"><?php echo e($data); ?>  
        </th>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <th class="days_absent_total">
        <?php echo e($student_attendance['days_absent_total']); ?>

    </th>
</tr>
<tr>
    <th>
        Times Tardy
    </th>
    <?php $__currentLoopData = $student_attendance['attendance_data']->times_tardy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th style="width:7%"><?php echo e($data); ?>  
        </th>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <th class="times_tardy_total">
        <?php echo e($student_attendance['times_tardy_total']); ?>

    </th>
</tr>
<?php 
    $SchoolYear = \App\SchoolYear::where('current', 1)
    ->where('status', 1)
    ->first();
?>
<?php if($SchoolYear->id == 9): ?>
    <tr>
        <th><i>Days of class suspensions with ADM option.</i></th>
        <th>0</th>
        <th>0</th>
        <th>0</th>
        <th>0</th>
        <th>12</th>
        <th>3</th>
        <th>15</th>
    </tr>
<?php endif; ?>
</table>

<center>
<table border="0" style="width: 80%" less-m-top2>

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
        <td colspan="3" style="border: 0">
            Eligible to transfer and admission to:
            <?php if(round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0): ?>
                <?php if(round($totalsum) > 74): ?> 
                    <strong><u>&nbsp;&nbsp;<?php echo e($Enrollment[0]->grade_level == 12 ? 'College' : $Enrollment[0]->eligible_transfer ? $Enrollment[0]->eligible_transfer : 'Grade '.($Enrollment[0]->grade_level+1)); ?>&nbsp;&nbsp;</u></strong>
                <?php elseif(round($totalsum) < 75): ?>                     
                   <strong>Failed</strong>
                <?php else: ?> 
                    <td>________________________________</td>
                <?php endif; ?>
            <?php else: ?>
                <td>________________________________</td>
            <?php endif; ?>       
            
        </td>                
    </tr>

    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Lacking units in:___<u><?php echo e($Enrollment[0] ? $Enrollment[0]->s2_lacking_unit : ''); ?></u>____</td>        
        
        
    </tr>
    
    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Date:___<u><?php echo e($DateRemarks->s_date2 ? date_format(date_create($DateRemarks->s_date2), 'F d, Y') : ''); ?></u>____</td>
        
    </tr>
    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">&nbsp;</td>   </tr>
    

    <tr style="margin-top: 0em">
            <table border="0" style="width: 100%; margin-top: 1.em" class="pb-1">
                
                    <tr>
                        <td style="border: 0; width: 50%;">
                            <center>
                                <?php if($ClassDetail->faculty_id == 46 ): ?>
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="<?php echo e($ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png')); ?>" 
                                    style="width:100px; margin-top: -5em">
                                <?php elseif( $ClassDetail->faculty_id == 79): ?>
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="<?php echo e($ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png')); ?>" 
                                    style="width:100px; margin-top: -1em">
                                <?php elseif($ClassDetail->faculty_id == 52 || $ClassDetail->faculty_id == 76 || $ClassDetail->faculty_id == 73): ?>
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="<?php echo e($ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png')); ?>" 
                                    style="width:170px; margin-top: -1em">
                                <?php elseif($ClassDetail->faculty_id == 36): ?>
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="<?php echo e($ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png')); ?>" 
                                    style="width:170px; margin-top: -2.2em">
                                <?php elseif($ClassDetail->faculty_id == 71 ): ?>
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo"  src="<?php echo e($ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png')); ?>" 
                                    style="width:100px; margin-top: -2em">
                                <?php else: ?>
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="<?php echo e($ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png')); ?>"
                                    style="width:100px">
                                <?php endif; ?>
                            </center>
                        </td>
                        <td style="border: 0; width: 50%;">
                            <center>
                                <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="<?php echo e(asset('/img/signature/principal_signature.png')); ?>"
                                style="width:170px">
                            </center>
                        </td>
                    </tr>
            </table>
            <?php if($ClassDetail->faculty_id == 46 || $ClassDetail->faculty_id == 52 ): ?>
                <table border="0" style="width: 100%; margin-top: -85px; margin-bottom: 0em">     
            <?php elseif($ClassDetail->faculty_id == 71 || $ClassDetail->faculty_id == 70 || $ClassDetail->faculty_id == 79): ?>
                <table border="0" style="width: 100%; margin-top: -90px; margin-bottom: 0em">
            <?php elseif($ClassDetail->faculty_id == 76 || $ClassDetail->faculty_id == 73 || $ClassDetail->faculty_id == 36): ?>
                <table border="0" style="width: 100%; margin-top: -87px; margin-bottom: 0em">     
            <?php else: ?>
                <table border="0" style="width: 100%; margin-top: -70px; margin-bottom: 0em">
            <?php endif; ?>                              
                <tr>
                    <td style="border: 0; width: 50%; height: 100px">
                        <span style="margin-left: 2em; text-transform: uppercase">
                            <center>
                            <?php echo e($ClassDetail->first_name); ?> <?php echo e($ClassDetail->middle_name); ?> <?php echo e($ClassDetail->last_name); ?></center>
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