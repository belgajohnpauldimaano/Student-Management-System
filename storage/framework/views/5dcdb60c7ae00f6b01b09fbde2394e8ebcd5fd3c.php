<h4>
    <span class="logo-mini"><img src="<?php echo e(asset('/img/sja-logo.png')); ?>" style="height: 60px;"></span> 
    <b> Grade-level/Section : <i style="color:red"><?php echo e($ClassDetail->grade_level.' '.$ClassDetail->section); ?></i></b>
</h4>
<hr/> 
<div class="table-responsive">
    <table class="table no-margin table-bordered">
        <thead>
            <tr>
                <th style="text-align: center">Subject</th>
                <th style="text-align: center">First Grading</th>
                <th style="text-align: center">Second Grading</th>
                <th style="text-align: center">Third Grading</th>
                <th style="text-align: center">Fourth Grading</th>
                <th style="text-align: center">Weighted Average</th>
                <th style="text-align: center">Remarks</th>                                
                <th style="text-align: center">Faculty</th>
            </tr>
        </thead>
        <tbody>            
            <?php if($GradeSheetData): ?>
                <?php
                    $showGenAvg = 0;
                ?>
                <?php $__currentLoopData = $GradeSheetData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <center>
                            <td><?php echo e($data->subject); ?></td>
                            <?php if($data->grade_status === -1): ?>
                                <td colspan="<?php echo e($ClassDetail ? $ClassDetail->section_grade_level <= 10 ? '6' : '4' : '6'); ?>" class="text-center text-red">Grade not yet finalized</td>
                            <?php else: ?> 
                                    <td><center><?php echo e($data->fir_g ? $data->fir_g > 0  ? round($data->fir_g) : '' : ''); ?></center></td>
                                    <td><center><?php echo e($data->sec_g ? $data->sec_g > 0  ? round($data->sec_g) : '' : ''); ?></center></td>
                                    <td><center><?php echo e($data->thi_g ? $data->thi_g > 0  ? round($data->thi_g) : '' : ''); ?></center></td>
                                    <td><center><?php echo e($data->fou_g ? $data->fou_g > 0  ? round($data->fou_g) : '' : ''); ?></center></td>

                                    <?php if($data->fir_g == 0 && $data->sec_g  == 0 && $data->thi_g  == 0 && $data->fou_g == 0): ?>
                                    <td>
                                        <?php if($data->fir_g == 0 && $data->sec_g  == 0 && $data->thi_g  == 0 && $data->fou_g == 0): ?>
                                        <center><?php echo e($final_a ? round($final_a) : ''); ?></center>
                                        <?php endif; ?>
                                    </td>
                                        <?php if($data->fir_g == 0 && $data->sec_g  == 0 && $data->thi_g  == 0 && $data->fou_g == 0): ?>
                                            <td></td>
                                            <td></td> 
                                        <?php else: ?>
                                            <td>
                                                <center>
                                                    <?php echo round($final_ave = (round($data->fir_g) + round($data->sec_g) + round($data->thi_g) + round($data->fou_g)) / 4) ?>
                                                </center>
                                            </td> 
                                            <td style="color:<?php echo e(round($final_ave) >= 75 ? 'green' : 'red'); ?>;">
                                                <center>
                                                    <strong>
                                                        <?php echo e(round($final_ave) >= 75 ? 'Passed' : 'Failed'); ?>

                                                    </strong>
                                                </center>
                                            </td>                                                
                                        <?php endif; ?>                                                     
                                        
                                    <?php else: ?>                                                        
                                        <?php if($data->fir_g == 0 || $data->sec_g  == 0 || $data->thi_g  == 0 || $data->fou_g == 0): ?>
                                            <td></td>
                                            <td></td> 
                                        <?php else: ?>
                                            <td>
                                                <center>
                                                    <?php echo round($final_ave = (round($data->fir_g) + round($data->sec_g) + round($data->thi_g) + round($data->fou_g)) / 4) ?>
                                                </center>
                                            </td> 
                                            <td style="color:<?php echo e(round($final_ave) >= 75 ? 'green' : 'red'); ?>;">
                                                <center>
                                                    <strong>
                                                        <?php echo e(round($final_ave) >= 75 ? 'Passed' : 'Failed'); ?>

                                                    </strong>
                                                </center>
                                            </td>                                                
                                        <?php endif; ?>           
                                    <?php endif; ?>              
                                    
                                    <td>
                                        <?php                                                   
                                            $faculty = \App\ClassSubjectDetail::where('id', $data->class_subject_details_id)->first();
                                            $faculty_name = \App\FacultyInformation::where('id', $faculty->faculty_id)->first();
                                            echo $faculty_name->last_name.', '.$faculty_name->first_name.' '.$faculty_name->middle_name;                                             
                                        ?>
                                        
                                    </td>
                                    
                            <?php endif; ?>                        
                        </center>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo $__env->make('control_panel_student.grade_sheet.partials.grade_panel.junior.data_junior', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>