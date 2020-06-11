


<h4 style="margin-top: 20px">
    <b>Second Semester</b>
</h4>

<div class="table-responsive">
    <table class="table no-margin table-bordered">
        <thead>
            <tr>
                <th style="text-align: center">Subject</th>
                <th style="text-align: center">First Quarter</th>
                <th style="text-align: center">Second Quarter</th>
                <th style="text-align: center">Weighted Average</th>
                <th style="text-align: center">Remarks</th>                                
                <th style="text-align: center">Faculty</th>
            </tr>
        </thead>
        <tbody>            
            <?php $__currentLoopData = $Enrollment_secondsem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php
                            $subject = \App\ClassSubjectDetail::where('id', $data->class_subject_details_id)                                        
                                ->orderBY('class_subject_order', 'ASC')->get();
                            echo \App\SubjectDetail::where('id', $subject[0]->subject_id)->first()->subject;                     
                        ?>
                    </td>
                    
                    <td style="text-align: center">
                        <?php 
                            $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                            ->where('subject_id', $data->subject_id)
                            ->where('class_subject_details_id', $data->class_subject_details_id)
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
                                if(round($StudentEnrolledSubject1->thi_g) != 0 || round($StudentEnrolledSubject1->fou_g) != 0)
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
                        <?php if(round($StudentEnrolledSubject1->thi_g) != 0 || round($StudentEnrolledSubject1->fou_g) != 0): ?> 
                        <td style="color:<?php echo e(round($final_ave) >= 75 ? 'green' : 'red'); ?>;">
                            <center>
                                <strong>
                                    <?php echo e(round($final_ave) >= 75 ? 'Passed' : 'Failed'); ?>

                                </strong>
                            </center>
                        </td> 
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                    <?php else: ?>    
                        <td></td>   
                    <?php endif; ?>   
                    <td>
                        <?php                                                   
                            $faculty = \App\ClassSubjectDetail::where('id', $data->class_subject_details_id)->first();
                            $faculty_name = \App\FacultyInformation::where('id', $faculty->faculty_id)->first();
                            echo $faculty_name->last_name.', '.$faculty_name->first_name.' '.$faculty_name->middle_name;                                             
                        ?>                
                    </td> 
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


    <?php echo $__env->make('control_panel_student.grade_sheet.partials.grade_panel.senior.second_sem.attendance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>