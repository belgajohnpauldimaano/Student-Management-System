<div class="box-body">
    <div class="js-data-container">
        <div class="table-responsive">
            <table class="table no-margin table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Schedule</th>
                        <th>Subject</th>
                        <th>Room</th>
                        <th>Grade & Section</th>
                        <th>Faculty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($Enrollment): ?>
                        <?php if($findSchoolYear ==''): ?>
                            <td colspan="5" style="text-align: center; font-weight: 600">You are not yet Enrolled this school year</td>
                        <?php endif; ?>
                        <?php $__currentLoopData = $Enrollment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                                $days = $data ? $data->class_schedule ? explode(';', rtrim($data->class_schedule,";")) : [] : [];
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
                            <tr>
                                <td><?php echo e(rtrim($daysDisplay, '/')); ?></td>
                                <td><?php echo e($data->subject_code . ' ' . $data->subject); ?></td>
                                <td><?php echo e('Room' . $data->room_code); ?></td>
                                <td><?php echo e($data->grade_level . ' ' . $data->section); ?></td>
                                <td><?php echo e($data->faculty_name); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>