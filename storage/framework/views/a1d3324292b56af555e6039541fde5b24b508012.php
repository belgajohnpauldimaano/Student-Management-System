
        
        <?php if($Semester): ?>
        
        <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id=""><i class="fa fa-file-pdf"></i> Print</button>
        
            <?php if($Semester->grade_level == '11' || $Semester->grade_level == '12'): ?>

                <table class="table no-margin table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 30px">#</th>
                                <th colspan="13" style="text-align:left">Student Name</th>        
                                                            
                                
                            </tr>
                        </thead>
                        <tbody>      
                                                    
                            <tr>
                                <td colspan="16">
                                    <b>Male</b> 
                                </td>
                            </tr>

                            <?php $__currentLoopData = $Senior_firstsem_m; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td>
                                    <b style="font-size: 15px">
                                        <?php echo e($data1->student_name); ?>

                                    </b>

                                    <br/>
                                    <br/>
                                    
                                    
                                    <?php if($data1->attendance_first==""): ?>

                                    <?php else: ?>
                                    <form id = "js-attendance_senior_firstsem">
                                        
                                            <?php echo e(csrf_field()); ?>

                                            
                                            
                                            <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo e($data1->e_id); ?>" />
                                            <input type="hidden" id="class_id" name="class_id" value="<?php echo e(encrypt($data1->c_id)); ?>" />
                                            <table id="mytable" class="table">
                                                <tr>
                                                                                                    
                                                    <?php
                                                    $student_attendance = [];
                                                    $table_header = [
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
                                                        
                                                        
                                                        $attendance_data = json_decode($data1->attendance_first);

                                                        
                                                    //    $attendance_data;

                                                    //     if ($EnrollmentMale[0]->attendance) {
                                                    //         $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                                                    //     }    

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
                                                        
                                                        
                                                    

                                                        <th>
                                                                <i style="font-size: 16px; color: red">First Semester</i>
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
                                                            <th style="width:">
                                                                <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school<?php echo e($key); ?>" name="days_of_school[]"  value="<?php echo e($data); ?>" />
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
                                                            <th style="width:15%">
                                                                <input type="text" class="form-control days_present" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_present[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_absent" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_absent[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present<?php echo e($key); ?>" name="times_tardy[]" value="<?php echo e($data); ?>" />    
                                                            </th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="times_tardy_total">
                                                            <?php echo e($student_attendance['times_tardy_total']); ?>

                                                        </th>
                                                    </tr>
                                                </table>
                            
                                            
                                                
                                                <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
                                                
                                        </form>
                                    
                                    
                                        <form id = "js-attendance_senior_secondsem">
                                                
                                                    <?php echo e(csrf_field()); ?>

                                                    
                                                    
                                                    <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo e($data1->e_id); ?>" />
                                                    <input type="hidden" id="class_id" name="class_id" value="<?php echo e(encrypt($data1->c_id)); ?>" />
                                                    <table id="mytable" class="table">
                                                        <tr>
                                                                                                            
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
                                                                
                                                                
                                                                $attendance_data = json_decode($data1->attendance_second);
            
                                                                
                                                            //    $attendance_data;
            
                                                            //     if ($EnrollmentMale[0]->attendance) {
                                                            //         $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                                                            //     }    
            
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
                                                                
                                                                
                                                            
            
                                                                <th style="width: 19%">
                                                                    <i style="font-size: 16px; color: red">Second Semester</i>
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
                                                                    <th style="width:">
                                                                        <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school<?php echo e($key); ?>" name="days_of_school[]"  value="<?php echo e($data); ?>" />
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
                                                                    <th style="width:12.5%">
                                                                        <input type="text" class="form-control days_present" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_present[]" value="<?php echo e($data); ?>" />    
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
                                                                    <th style="width:7%">
                                                                        <input type="text" class="form-control days_absent" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_absent[]" value="<?php echo e($data); ?>" />    
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
                                                                    <th style="width:7%">
                                                                        <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present<?php echo e($key); ?>" name="times_tardy[]" value="<?php echo e($data); ?>" />    
                                                                    </th>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <th class="times_tardy_total">
                                                                    <?php echo e($student_attendance['times_tardy_total']); ?>

                                                                </th>
                                                            </tr>
                                                        </table>
                                    
                                                    
                                                        
                                                        <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
                                                        
                                                </form>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td colspan="16">
                                    <b>Female</b>
                                </td>
                            </tr>

                            <?php $__currentLoopData = $Senior_firstsem_f; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td>
                                    <b style="font-size: 15px">
                                        <?php echo e($data1->student_name); ?>

                                    </b>

                                    <br/>
                                    <br/>
                                    
                                    
                                    <?php if($data1->attendance_first==""): ?>

                                    <?php else: ?>
                                    <form id = "js-attendance_senior_firstsem">
                                        <?php echo e(csrf_field()); ?>

                                            
                                            
                                            <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo e($data1->e_id); ?>" />
                                            <input type="hidden" id="class_id" name="class_id" value="<?php echo e(encrypt($data1->c_id)); ?>" />
                                            <table class="table">
                                                <tr>
                                                                                                    
                                                        <?php
                                                        $student_attendance = [];
                                                        $table_header = [
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
                                                            
                                                            
                                                            $attendance_data = json_decode($data1->attendance_first);
                                                        //    $attendance_data;
        
                                                        //     if ($EnrollmentMale[0]->attendance) {
                                                        //         $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                                                        //     }    
        
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
                                                        
                                                        
                                                    

                                                        <th>
                                                                <i style="font-size: 16px; color: red">First Semester</i>
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
                                                            <th style="width:15.%">
                                                                <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school<?php echo e($key); ?>" name="days_of_school[]"  value="<?php echo e($data); ?>" />
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
                                                            <th style="width:15%">
                                                                <input type="text" class="form-control days_present" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_present[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_absent" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_absent[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present<?php echo e($key); ?>" name="times_tardy[]" value="<?php echo e($data); ?>" />    
                                                            </th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="times_tardy_total">
                                                            <?php echo e($student_attendance['times_tardy_total']); ?>

                                                        </th>
                                                    </tr>
                                                </table>
                            
                                            
                                                
                                                <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
                                                
                                        </form>

                                        <form id = "js-attendance_senior_secondsem">
                                                
                                                    <?php echo e(csrf_field()); ?>

                                                    
                                                    
                                                    <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo e($data1->e_id); ?>" />
                                                    <input type="hidden" id="class_id" name="class_id" value="<?php echo e(encrypt($data1->c_id)); ?>" />
                                                    <table id="mytable" class="table">
                                                        <tr>
                                                                                                            
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
                                                                
                                                                
                                                                $attendance_data = json_decode($data1->attendance_second);
            
                                                                
                                                            //    $attendance_data;
            
                                                            //     if ($EnrollmentMale[0]->attendance) {
                                                            //         $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                                                            //     }    
            
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
                                                                
                                                                
                                                            
            
                                                                <th style="width: 19%">
                                                                    <i style="font-size: 16px; color: red">Second Semester</i>
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
                                                                    <th style="width:">
                                                                        <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school<?php echo e($key); ?>" name="days_of_school[]"  value="<?php echo e($data); ?>" />
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
                                                                    <th style="width:12.5%">
                                                                        <input type="text" class="form-control days_present" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_present[]" value="<?php echo e($data); ?>" />    
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
                                                                    <th style="width:7%">
                                                                        <input type="text" class="form-control days_absent" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_absent[]" value="<?php echo e($data); ?>" />    
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
                                                                    <th style="width:7%">
                                                                        <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present<?php echo e($key); ?>" name="times_tardy[]" value="<?php echo e($data); ?>" />    
                                                                    </th>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <th class="times_tardy_total">
                                                                    <?php echo e($student_attendance['times_tardy_total']); ?>

                                                                </th>
                                                            </tr>
                                                        </table>
                                    
                                                    
                                                        
                                                        <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
                                                        
                                                </form>
                                    <?php endif; ?>
                                
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                </table>
                

            <?php else: ?>        
            
                <table class="table no-margin table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 30px">#</th>
                                <th colspan="13" style="text-align:left">Student Name</th>        
                                                            
                                
                            </tr>
                        </thead>
                        <tbody>      
                                                    
                            <tr>
                                <td colspan="16">
                                    <b>Male</b> 
                                </td>
                            </tr>


                            <?php $__currentLoopData = $attendance_male; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td>
                                    <b style="font-size: 15px">
                                        <?php echo e($data1->student_name); ?>

                                    </b>

                                    <br/>
                                    <br/>
                                    
                                    
                                    <?php if($data1->attendance==""): ?>

                                    <?php else: ?>
                                    <form id = "js-attendance">
                                        
                                            <?php echo e(csrf_field()); ?>

                                            
                                            
                                            <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo e($data1->e_id); ?>" />
                                            <input type="hidden" id="class_id" name="class_id" value="<?php echo e(encrypt($data1->c_id)); ?>" />
                                            <table id="mytable" class="table">
                                                <tr>
                                                                                                    
                                                    <?php
                                                    $student_attendance = [];
                                                    $table_header = [
                                                            ['key' => 'Jun',],
                                                            ['key' => 'Jul',],
                                                            ['key' => 'Aug',],
                                                            ['key' => 'Sep',],
                                                            ['key' => 'Oct',],
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
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ],
                                                            'days_present' => [
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ],
                                                            'days_absent' => [
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ],
                                                            'times_tardy' => [
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ]
                                                        ]));
                                                        
                                                        
                                                        $attendance_data = json_decode($data1->attendance);
                                                    //    $attendance_data;

                                                    //     if ($EnrollmentMale[0]->attendance) {
                                                    //         $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                                                    //     }    

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
                                                        
                                                        
                                                    

                                                        <th>
                                                            TITLE
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school<?php echo e($key); ?>" name="days_of_school[]"  value="<?php echo e($data); ?>" />
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_present" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_present[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_absent" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_absent[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present<?php echo e($key); ?>" name="times_tardy[]" value="<?php echo e($data); ?>" />    
                                                            </th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="times_tardy_total">
                                                            <?php echo e($student_attendance['times_tardy_total']); ?>

                                                        </th>
                                                    </tr>
                                                </table>
                            
                                            
                                                
                                                <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
                                                
                                        </form>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td colspan="16">
                                    <b>Female</b>
                                </td>
                            </tr>

                            <?php $__currentLoopData = $attendance_female; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td>
                                    <b style="font-size: 15px">
                                        <?php echo e($data1->student_name); ?>

                                    </b>

                                    <br/>
                                    <br/>
                                    
                                    
                                    <?php if($data1->attendance==""): ?>

                                    <?php else: ?>
                                    <form id = "js-attendance">
                                        <?php echo e(csrf_field()); ?>

                                            
                                            
                                            <input type="hidden" id="enroll_id" name="enroll_id" value="<?php echo e($data1->e_id); ?>" />
                                            <input type="hidden" id="class_id" name="class_id" value="<?php echo e(encrypt($data1->c_id)); ?>" />
                                            <table class="table">
                                                <tr>
                                                                                                    
                                                    <?php
                                                    $student_attendance = [];
                                                    $table_header = [
                                                            ['key' => 'Jun',],
                                                            ['key' => 'Jul',],
                                                            ['key' => 'Aug',],
                                                            ['key' => 'Sep',],
                                                            ['key' => 'Oct',],
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
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ],
                                                            'days_present' => [
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ],
                                                            'days_absent' => [
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ],
                                                            'times_tardy' => [
                                                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                            ]
                                                        ]));

                                                        if ($data1->attendance) {
                                                            $attendance_data = json_decode($data1->attendance);
                                                        }
                                                        
                                                        
                                                        
                                                    //    $attendance_data;

                                                    //     if ($EnrollmentMale[0]->attendance) {
                                                    //         $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                                                    //     }    

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
                                                        
                                                        
                                                    

                                                        <th>
                                                            TITLE
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school<?php echo e($key); ?>" name="days_of_school[]"  value="<?php echo e($data); ?>" />
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_present" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_present[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control days_absent" min="0" max="30" id="days_present<?php echo e($key); ?>" name="days_absent[]" value="<?php echo e($data); ?>" />    
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
                                                            <th style="width:7%">
                                                                <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present<?php echo e($key); ?>" name="times_tardy[]" value="<?php echo e($data); ?>" />    
                                                            </th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <th class="times_tardy_total">
                                                            <?php echo e($student_attendance['times_tardy_total']); ?>

                                                        </th>
                                                    </tr>
                                                </table>
                            
                                            
                                                
                                                <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
                                                
                                        </form>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                                
                            
                </table>
            <?php endif; ?>
            
        <?php else: ?>
            <h3 style=" text-align: center"><i style="color:red;">Sorry, Not Available.</i></h3>
        <?php endif; ?>

