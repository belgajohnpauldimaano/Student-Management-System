                        <div class="pull-right">
                            <?php echo e($ClassSubjectDetail ? $ClassSubjectDetail->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject</th>
                                    <th>Schedule</th>
                                    <th>Faculty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12): ?>
                                    <?php if($ClassSubjectDetail): ?>
                                            <?php $__currentLoopData = $ClassSubjectDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $days = $data ? $data->class_schedule ? explode(';', rtrim($data->class_schedule,";")) : [] : [];
                                                    $daysObj = [];
                                                    $daysDisplay = '';
                                                    if ($days) 
                                                    {
                                                        foreach($days as $day)
                                                        {
                                                            $day_sched = explode('@', $day);
                                                            $d = $day_sched[0];
                                                            $day = '';
                                                            if ($day_sched[0] == 1) {
                                                                $day = 'M';
                                                                $daysObj[$d]['day'] = 'M';
                                                            } else if ($day_sched[0] == 2) {
                                                                $day = 'T';
                                                                $daysObj[$d]['day'] = 'T';
                                                            } else if ($day_sched[0] == 3) {
                                                                $day = 'W';
                                                                $daysObj[$d]['day'] = 'W';
                                                            } else if ($day_sched[0] == 4) {
                                                                $day = 'TH';
                                                                $daysObj[$d]['day'] = 'TH';
                                                            } else if ($day_sched[0] == 5) {
                                                                $day = 'F';
                                                                $daysObj[$d]['day'] = 'F';
                                                            }
                                                            $t = explode('-', $day_sched[1]);
                                                            /*$daysObj[$d]['from'] = $t[0];
                                                            $daysObj[$d]['to'] = $t[1];*/

                                                            $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                                        }
                                                    }

                                                ?>
                                                <tr>
                                                    <td><?php echo e($data->subject_code); ?> <?php echo e($data->id); ?></td>
                                                    <td><?php echo e($data->subject); ?></td>
                                                    
                                                    <td> <?php echo e(rtrim($daysDisplay, '/')); ?> </td>
                                                    <td><?php echo e($data->faculty_name); ?></td>
                                                    <td>
                                                        <div class="input-group-btn pull-left text-left">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                                <span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                
                                                                <li><a href="#" class="js-btn_update" data-id="<?php echo e($data->id); ?>">Edit</a></li>
                                                                
                                                                <li><a href="#" class="js-btn_deactivate" data-id="<?php echo e($data->id); ?>">Deactivate</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                <?php else: ?>

                                    <?php if($ClassSubjectDetail1): ?>
                                        <?php $__currentLoopData = $ClassSubjectDetail1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $days = $data ? $data->class_schedule ? explode(';', rtrim($data->class_schedule,";")) : [] : [];
                                                $daysObj = [];
                                                $daysDisplay = '';
                                                if ($days) 
                                                {
                                                    foreach($days as $day)
                                                    {
                                                        $day_sched = explode('@', $day);
                                                        $d = $day_sched[0];
                                                        $day = '';
                                                        if ($day_sched[0] == 1) {
                                                            $day = 'M';
                                                            $daysObj[$d]['day'] = 'M';
                                                        } else if ($day_sched[0] == 2) {
                                                            $day = 'T';
                                                            $daysObj[$d]['day'] = 'T';
                                                        } else if ($day_sched[0] == 3) {
                                                            $day = 'W';
                                                            $daysObj[$d]['day'] = 'W';
                                                        } else if ($day_sched[0] == 4) {
                                                            $day = 'TH';
                                                            $daysObj[$d]['day'] = 'TH';
                                                        } else if ($day_sched[0] == 5) {
                                                            $day = 'F';
                                                            $daysObj[$d]['day'] = 'F';
                                                        }
                                                        $t = explode('-', $day_sched[1]);
                                                        /*$daysObj[$d]['from'] = $t[0];
                                                        $daysObj[$d]['to'] = $t[1];*/

                                                        $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                                    }
                                                }

                                            ?>
                                            <tr>
                                                <td><?php echo e($data->subject_code); ?> <?php echo e($data->id); ?></td>
                                                <td><?php echo e($data->subject); ?></td>
                                                
                                                <td> <?php echo e(rtrim($daysDisplay, '/')); ?> </td>
                                                <td><?php echo e($data->faculty_name); ?></td>
                                                <td>
                                                    <div class="input-group-btn pull-left text-left">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                            <span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" class="js-btn_update" data-id="<?php echo e($data->id); ?>">Edit</a></li>
                                                            
                                                            <li><a href="#" class="js-btn_deactivate" data-id="<?php echo e($data->id); ?>">Deactivate</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                <?php endif; ?>

                                
                            </tbody>
                        </table>