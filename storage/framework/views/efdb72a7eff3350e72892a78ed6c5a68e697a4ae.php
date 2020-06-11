<?php
        $student_attendance = [];
        $table_header = [
            ['key' => 'Nov',],
                ['key' => 'Dec',],
                ['key' => 'Jan',],
                ['key' => 'Feb',],
                ['key' => 'Mar',],
                ['key' => 'Apr',],
                
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
            
            $attendance_data = json_decode($Enrollment_secondsem[0]->attendance_second);

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
    <p class="report-progress-left m0"  style="margin-top: 2em; margin-left: 5px"><b>ATTENDANCE RECORD</b></p>
    
    <table style="width:100%; margin-bottom: 1em " class="table no-margin table-bordered table-striped">
        <tr>
            <th>
                <?php $__currentLoopData = $student_attendance['table_header']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th style="text-align:center"><?php echo e($data['key']); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </th>
                
        </tr>
        <tr>
            <th>
                Days of School
            </th>
            <?php $__currentLoopData = $student_attendance['attendance_data']->days_of_school; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th style="width:7%;text-align:center">
                    <?php echo e($data); ?>

                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="days_of_school_total" style="text-align:center">
                <?php echo e($student_attendance['days_of_school_total']); ?>

            </th>
        </tr>
        <tr>
            <th>
                Days Present
            </th>
            <?php $__currentLoopData = $student_attendance['attendance_data']->days_present; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th style="width:7%;text-align:center">
                    <?php echo e($data); ?> 
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="days_present_total" style="text-align:center">
                <?php echo e($student_attendance['days_present_total']); ?>

            </th>
        </tr>
        <tr>
            <th>
                Days Absent
            </th>
            <?php $__currentLoopData = $student_attendance['attendance_data']->days_absent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th style="width:7%;text-align:center">
                    <?php echo e($data); ?>  
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="days_absent_total" style="text-align:center">
                <?php echo e($student_attendance['days_absent_total']); ?>

            </th>
        </tr>
        <tr>
            <th>
                Times Tardy
            </th>
            <?php $__currentLoopData = $student_attendance['attendance_data']->times_tardy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th style="width:7%;text-align:center">
                    <?php echo e($data); ?>  
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th class="times_tardy_total" style="text-align:center">
                <?php echo e($student_attendance['times_tardy_total']); ?>

            </th>
        </tr>
    </table>