                        <?php
                                $days = $ClassSubjectDetail ? $ClassSubjectDetail->class_schedule ? explode(';', rtrim($ClassSubjectDetail->class_schedule,";")) : [] : [];
                                $daysObj = [];
                                $daysDisplay = '';
                                if ($days) 
                                {
                                    foreach($days as $day)
                                    {
                                        $day_sched = explode('@', $day);
                                        $day = '';
                                        if ($day_sched[0] == 1) {
                                            $day = 'M';
                                        } else if ($day_sched[0] == 2) {
                                            $day = 'T';
                                        } else if ($day_sched[0] == 3) {
                                            $day = 'W';
                                        } else if ($day_sched[0] == 4) {
                                            $day = 'TH';
                                        } else if ($day_sched[0] == 5) {
                                            $day = 'F';
                                        }
                                        $t = explode('-', $day_sched[1]);
                                        $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                    }
                                }

                        ?>

                        <h4>Subject : <span class="text-red"><i><?php echo e($ClassSubjectDetail->id); ?> <?php echo e($ClassSubjectDetail->subject); ?></i></span> 
                        
                        Schedule : <span class="text-red"><i><?php echo e(rtrim($daysDisplay, '/')); ?></i></span>
                        </h4>
                        <h4>Grade & Section : <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
                        <h4>Semester: <span class="text-red"><i><?php echo e($ClassSubjectDetail ? $ClassSubjectDetail->sem == 1 ? 'First' : 'Second' : ''); ?></i></span></h4>
                        
                        <div class="pull-right">
                            
                        </div>
                       
                        <?php if($ClassSubjectDetail->grade_level==11 || $ClassSubjectDetail->grade_level==12): ?>
                            
                            <?php if($ClassSubjectDetail->sem==1): ?>
                                    <button class="btn btn-flat btn-danger pull-right" id="js-btn_print_sem1" data-id="<?php echo e($ClassSubjectDetail->id); ?>"><i class="fa fa-file-pdf"></i> Print</button>
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                               
                                                <th >First Quarter</th>
                                                <th >Second Quarter</th>
                                                
                                            
                                                <th style="text-align:center">Final Grading</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                                <?php if($EnrollmentMale): ?>
                                                    <?php if($ClassSubjectDetail->grading_status == 2): ?>
                                                        <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                                <td><?php echo e($key + 1); ?>.</td>
                                                                <td><?php echo e($data->student_name); ?></td>
                                                                <td>
                                                                    <center><?php echo e($data->fir_g); ?></center>
                                                                </td>
                                                                <td>
                                                                    <center><?php echo e($data->sec_g); ?></center>
                                                                </td>
                                                                
                                                                <td>
                                                                    <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <strong>
                                                                                <center>
                                                                                    <?php
                                                                                        $g_ctr = 0;
                                                                                        $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                        $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                        $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                        $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                                    ?>
                                                                                    <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                                </center>
                                                                        </strong>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                            <tr>
                                                                <td colspan="7">
                                                                    <b>Male</b>
                                                                </td>
                                                            </tr>
                                                        <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                                <td><?php echo e($key + 1); ?>.</td>
                                                                <td><?php echo e($data->student_name); ?></td>
                                                                
                                                                <td>
                                                                    <div class="input-group" data-grading="<?php echo e(base64_encode('first')); ?>">
                                                                        <input style ="text-align: center" type="number" <?php echo e($data->fir_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control grade-input-<?php echo e($data->student_enrolled_subject_id); ?>" value="<?php echo e($data->fir_g <= 0.00 ? "" : round($data->fir_g)); ?>" id="first_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                        
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group" data-grading="<?php echo e(base64_encode('second')); ?>">
                                                                        <input style ="text-align: center" type="number" <?php echo e($data->sec_g_status ? "readonly='readonly'" : ''); ?>  class="input-sm txt-grade_input form-control" value="<?php echo e($data->fir_g <= 0.00 ? "" : round($data->sec_g)); ?>" id="second_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                        
                                                                    </div>
                                                                </td>
                                                               
                                                                <td>
                                                                    <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <strong>

                                                                            <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                            </center>
                                                                        </strong>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td colspan="7">
                                                        <b>Female</b>
                                                    </td>
                                                </tr>
                                                <?php if($EnrollmentFemale): ?>
                                                    <?php if($ClassSubjectDetail->grading_status == 2): ?>
                                                        <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                                <td><?php echo e($key + 1); ?>.</td>
                                                                <td><?php echo e($data->student_name); ?></td>
                                                                <td>
                                                                    <center><?php echo e($data->fir_g); ?></center>
                                                                </td>
                                                                <td>
                                                                    <center><?php echo e($data->sec_g); ?></center>
                                                                </td>
                                                                
                                                                <td>
                                                                    <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <strong>
                                                                                <center>
                                                                                    <?php
                                                                                        $g_ctr = 0;
                                                                                        $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                        $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                        $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                        $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                                    ?>
                                                                                    <?php echo e(($g_ctr ? (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                                </center>
                                                                        </strong>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                                <td><?php echo e($key + 1); ?>.</td>
                                                                <td><?php echo e($data->student_name); ?></td>
                                                                
                                                                <td>
                                                                    <div class="input-group" data-grading="<?php echo e(base64_encode('first')); ?>">
                                                                        <input style ="text-align: center" type="number" <?php echo e($data->fir_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control grade-input-<?php echo e($data->student_enrolled_subject_id); ?>" value="<?php echo e($data->fir_g <= 0.00 ? "" : round($data->fir_g)); ?>" id="first_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                        
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group" data-grading="<?php echo e(base64_encode('second')); ?>">
                                                                        <input style ="text-align: center" type="number" <?php echo e($data->sec_g_status ? "readonly='readonly'" : ''); ?>  class="input-sm txt-grade_input form-control" value="<?php echo e($data->sec_g <= 0.00 ? "" : round($data->sec_g)); ?>" id="second_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                        
                                                                    </div>
                                                                </td>
                                                               
                                                                <td>
                                                                    <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                        <strong>
                                                                            <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                            </center>
                                                                        </strong>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            

                                        </tbody>
                                    </table>
                            <?php else: ?>
                            <button class="btn btn-flat btn-danger pull-right" id="js-btn_print_sem2" data-id="<?php echo e($ClassSubjectDetail->id); ?>"><i class="fa fa-file-pdf"></i> Print</button>
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        
                                        
                                    
                                        
                                        <th>First Quarter</th>
                                        <th>Second Quarter</th>
                                    
                                        <th style="text-align:center">Final Grading</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php if($EnrollmentMale): ?>
                                            <?php if($ClassSubjectDetail->grading_status == 2): ?>
                                                <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        
                                                        <td>
                                                            <center><?php echo e($data->thi_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->fou_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <b>Male</b>
                                                        </td>
                                                    </tr>
                                                <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        
                                                       
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('third')); ?>">
                                                                <input style ="text-align: center" type="number" <?php echo e($data->thi_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->thi_g <= 0.00 ? "" : round($data->thi_g)); ?>" id="third_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('fourth')); ?>">
                                                            <input style ="text-align: center" type="number" <?php echo e($data->fou_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->fou_g <= 0.00 ? "" : round($data->fou_g)); ?>" id="fourth_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">    
                                                            
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                    <center>
                                                                    <?php
                                                                        $g_ctr = 0;
                                                                        $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                        $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                        $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                        $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                    ?>
                                                                    <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                    </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <tr>
                                                <td colspan="7">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                        <?php if($EnrollmentFemale): ?>
                                            <?php if($ClassSubjectDetail->grading_status == 2): ?>
                                                <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        
                                                        <td>
                                                            <center><?php echo e($data->thi_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->fou_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        
                                                     
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('third')); ?>">
                                                                <input style ="text-align: center" type="number" <?php echo e($data->thi_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->thi_g <= 0.00 ? "" : round($data->thi_g)); ?>" id="third_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('fourth')); ?>">                                                            
                                                            <input style ="text-align: center" type="number" <?php echo e($data->fou_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->fou_g <= 0.00 ? "" : round($data->fou_g)); ?>" id="fourth_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">    
                                                            
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    

                                </tbody>
                            </table>
                            <?php endif; ?>

                            

                        <?php else: ?>

                            <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="<?php echo e($ClassSubjectDetail->id); ?>"><i class="fa fa-file-pdf"></i> Print</button>
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        
                                        
                                    
                                        <th>First Grading</th>
                                        <th>Second Grading</th>
                                        <th>Third Grading</th>
                                        <th>Fourth Grading</th>
                                    
                                        <th style="text-align:center">Final Grading</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php if($EnrollmentMale): ?>
                                            <?php if($ClassSubjectDetail->grading_status == 2): ?>
                                                <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        <td>
                                                            <center><?php echo e($data->fir_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->sec_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->thi_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->fou_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <b>Male</b>
                                                        </td>
                                                    </tr>
                                                <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                            <td><?php echo e($key + 1); ?>.</td>
                                                            <td><?php echo e($data->student_name); ?></td>
                                                            
                                                            <td>
                                                                <div class="input-group" data-grading="<?php echo e(base64_encode('first')); ?>">
                                                                    <input style ="text-align: center" type="number" <?php echo e($data->fir_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control grade-input-<?php echo e($data->student_enrolled_subject_id); ?>" value="<?php echo e($data->fir_g <= 0.00 ? "" : round($data->fir_g)); ?>" id="first_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                    <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group" data-grading="<?php echo e(base64_encode('second')); ?>">
                                                                    <input style ="text-align: center" type="number" <?php echo e($data->sec_g_status ? "readonly='readonly'" : ''); ?>  class="input-sm txt-grade_input form-control" value="<?php echo e($data->sec_g <= 0.00 ? "" : round($data->sec_g)); ?>" id="second_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                    <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group" data-grading="<?php echo e(base64_encode('third')); ?>">
                                                                    <input style ="text-align: center" type="number" <?php echo e($data->thi_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->thi_g <= 0.00 ? "" : round($data->thi_g)); ?>" id="third_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                    <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group" data-grading="<?php echo e(base64_encode('fourth')); ?>">
                                                                <input style ="text-align: center" type="number" <?php echo e($data->fou_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->fou_g <= 0.00 ? "" : round($data->fou_g)); ?>" id="fourth_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">    
                                                                
                                                                </div>
                                                            </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="7">
                                                <b>Female</b>
                                            </td>
                                        </tr>
                                        <?php if($EnrollmentFemale): ?>
                                            <?php if($ClassSubjectDetail->grading_status == 2): ?>
                                                <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        <td>
                                                            <center><?php echo e($data->fir_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->sec_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->thi_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo e($data->fou_g); ?></center>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-student_enrolled_subject_id="<?php echo e(base64_encode($data->student_enrolled_subject_id)); ?>" data-student_id="<?php echo e(base64_encode($data->id)); ?>" data-enrollment_id="<?php echo e(base64_encode($data->enrollment_id)); ?>">
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($data->student_name); ?></td>
                                                        
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('first')); ?>">
                                                                <input style ="text-align: center" type="number" <?php echo e($data->fir_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control grade-input-<?php echo e($data->student_enrolled_subject_id); ?>" value="<?php echo e($data->fir_g <= 0.00 ? "" : round($data->fir_g)); ?>" id="first_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('second')); ?>">
                                                                <input style ="text-align: center" type="number" <?php echo e($data->sec_g_status ? "readonly='readonly'" : ''); ?>  class="input-sm txt-grade_input form-control" value="<?php echo e($data->sec_g <= 0.00 ? "" : round($data->sec_g)); ?>" id="second_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('third')); ?>">
                                                                <input style ="text-align: center" type="number" <?php echo e($data->thi_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->thi_g <= 0.00 ? "" : round($data->thi_g)); ?>" id="third_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group" data-grading="<?php echo e(base64_encode('fourth')); ?>">
                                                            <input style ="text-align: center" type="number" <?php echo e($data->fou_g_status ? "readonly='readonly'" : ''); ?> class="input-sm txt-grade_input form-control" value="<?php echo e($data->fou_g <= 0.00 ? "" : round($data->fou_g)); ?>" id="fourth_grading_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="<?php echo e($ClassSubjectDetail->id); ?>">    
                                                            
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-red final-ratings_<?php echo e($data->student_enrolled_subject_id); ?>">
                                                                <strong>
                                                                        <center>
                                                                            <?php
                                                                                $g_ctr = 0;
                                                                                $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                                $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                            ?>
                                                                            <?php echo e(($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)); ?>

                                                                        </center>
                                                                </strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    

                                </tbody>
                            </table>
                        <?php endif; ?>