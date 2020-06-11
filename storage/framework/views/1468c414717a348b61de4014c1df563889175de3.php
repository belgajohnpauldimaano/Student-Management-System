                       

                          
                           
                           <?php if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12): ?>                   
                                <div class="pull-right">
                                    <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_all_student" aria-expanded="true">
                                        Re-Enroll All (2nd Semester)
                                    </button>
                                    <?php echo e($Enrollment ? $Enrollment->links() : ''); ?>

                                </div>

                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($Enrollment): ?>
                                            <?php $__currentLoopData = $Enrollment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td> <?php echo e($key + 1); ?>.</td>
                                                    <td><?php echo e($data->username); ?></td>
                                                    <td><?php echo e($data->fullname); ?></td>
                                                    <td>
                                                        <div class="input-group-btn pull-left text-left">
                                                            <?php if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12): ?>
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_cancel_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Cancel Enroll
                                                                </button>
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Re-Enroll
                                                                </button>
                                                            <?php else: ?>
                                                            
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_cancel_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Cancel Enroll
                                                                </button>
    
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Re-Enroll
                                                                </button>
                                                            <?php endif; ?>
                                                                <!--  -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                            <?php else: ?>
                                <div class="pull-right">
                                    <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_all_student" aria-expanded="true">
                                        Re-Enroll All
                                    </button>
                                    <?php echo e($Enrollment ? $Enrollment->links() : ''); ?>

                                </div> 

                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($Enrollment): ?>
                                            <?php $__currentLoopData = $Enrollment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?>.</td>
                                                    <td><?php echo e($data->username); ?></td>
                                                    <td><?php echo e($data->fullname); ?></td>
                                                    <td>
                                                        <div class="input-group-btn pull-left text-left">
                                                            <?php if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12): ?>
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_cancel_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Cancel Enroll
                                                                </button>
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Re-Enroll
                                                                </button>
                                                            <?php else: ?>                                                            
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_cancel_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Cancel Enroll
                                                                </button>
    
                                                                <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_student" data-student_id="<?php echo e($data->student_information_id); ?>" data-id="<?php echo e($data->enrollment_id); ?>" aria-expanded="true">
                                                                    Re-Enroll
                                                                </button>
                                                            <?php endif; ?>
                                                                <!--  -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                            <?php endif; ?>
                             

                            
               