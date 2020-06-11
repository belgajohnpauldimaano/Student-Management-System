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
                        <h4>Subject : <span class="text-red"><i><?php echo e($ClassSubjectDetail->subject); ?></i></span> 
                        
                        Schedule : <span class="text-red"><i><?php echo e(rtrim($daysDisplay, '/')); ?></i></span>  
                        </h4>
                        <h4>Grade & Section : <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
                        <div class="pull-right">
                            <?php echo e($EnrollmentMale ? $EnrollmentMale->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Student Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Male</td>
                                </tr>
                                <?php if($EnrollmentMale): ?>
                                    <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($data->username); ?></td>
                                            <td><?php echo e($data->student_name); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <tr>
                                        <td>Female</td>
                                    </tr>
                                    <?php if($EnrollmentFemale): ?>
                                        <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($data->username); ?></td>
                                                <td><?php echo e($data->student_name); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                            </tbody>
                        </table>