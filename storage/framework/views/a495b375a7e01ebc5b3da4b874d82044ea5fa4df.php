<?php if($type == 'average'): ?>
        
    <?php if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12): ?>
        <h4>Semester: <span class="text-red"><i><?php echo e($sem); ?></i></span> Quarter: <span class="text-red"><i><?php echo e($quarter); ?></i></span></h4>                        
        <h4>Grade &amp; Section: <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
        <h4>Room: <span class="text-red"><i><?php echo e($ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description); ?></i></span></h4>
        
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_button_print', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="table-responsive">
            <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_senior', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    <?php else: ?>
    
        <h4>Quarter: <span class="text-red"><span class="text-red"><i><?php echo e($quarter); ?></i></span></h4>
                    
        <h4>Grade &amp; Section: <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
        <h4>Room: <span class="text-red"><i><?php echo e($ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description); ?></i></span></h4>
        
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_button_print', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                    
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_junior', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>            
    <?php endif; ?>
             
<?php else: ?>     
          
    <?php if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12): ?>
        <h4>Semester: <span class="text-red"><i><?php echo e($sem); ?></i></span> Quarter: <span class="text-red"><i><?php echo e($quarter); ?></i></span></h4>
        <h4>Grade &amp; Section: <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
        <h4>Room: <span class="text-red"><i><?php echo e($ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description); ?></i></span></h4>
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_button_print', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_senior_gradesheet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php elseif($ClassSubjectDetail->grade_level == 7 || $ClassSubjectDetail->grade_level == 8 || $ClassSubjectDetail->grade_level == 9): ?>
        <h4>Quarter: <span class="text-red"><i><?php echo e($quarter); ?></i></span></h4>
        <h4>Grade &amp; Section: <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
        <h4>Room: <span class="text-red"><i><?php echo e($ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description); ?></i></span></h4>
    
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_button_print', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if($quarter == 'Fourth'): ?>
            <div class="table-responsive">
                                            <table class="table no-margin table-striped table-bordered table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px">#</th>
                                                        <th style="width: 200px">Student Name</th>                                       
                                                        
                                                        <th style="width: 80px; text-align: center" colspan="2">Filipino</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">English</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">Math</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">Science</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">Araling<br/> Panlipunan</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">ESP</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">TLE</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">MAPEH</th>                                                        
                                                        <th style="width: 80px; text-align: center" colspan="2">Religion</th>

                                                        

                                                        <th style="width: 80px; text-align: center" colspan="2">GENERAL AVERAGE</th>
                                                        <th style="width: 80px; text-align: center">REMARKS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                  
                                                    <tr>
                                                        <td> 
                                                            <b>Male</b>
                                                        </td>
                                                        <td></td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                    </tr>
                                                    <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($sub->student_name); ?></td>
                                                        
                                                        <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                $subj_1 = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                                if($subj_1 > 0)
                                                                {
                                                                    echo $subj_1;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                                $subj_2 = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                                if($subj_2 > 0)
                                                                {
                                                                    echo $subj_2;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                                $subj_3 = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                                    if($subj_3 > 0)
                                                                    {
                                                                        echo $subj_3;
                                                                    }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                                $subj_4 = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                                if($subj_4  > 0)
                                                                {
                                                                    echo $subj_4;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                                $subj_5 = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                                if($subj_5 > 0)
                                                                {
                                                                    echo $subj_5;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                                $subj_6 = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                                if($subj_6 > 0)
                                                                {
                                                                    echo $subj_6;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                                $subj_7 = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                                if($subj_7 > 0)
                                                                {
                                                                    echo $subj_7;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                                $subj_8 = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                                if($subj_8 > 0)
                                                                {
                                                                    echo $subj_8;
                                                                }
                                                            ?>
                                                        </td>
                                                        
                                                        <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                                $subj_9 = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                                if($subj_9 > 0)
                                                                {
                                                                    echo $subj_9;
                                                                }
                                                            
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <center>                                                
                                                                <?php
                                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                    if($formattedNum > 0 )
                                                                    {
                                                                        echo $formattedNum;
                                                                    }
                                                                    
                                                                ?>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>                                                
                                                                <?php
                                                                    $formattedNum = number_format(round($average = (round($subj_1) + round($subj_2) + round($subj_3) + round($subj_4) + round($subj_5) + round($subj_6) + round($subj_7) + round($subj_8) + round($subj_9) )/9), 0);
                                                                    if($formattedNum > 0 )
                                                                    {
                                                                        echo $formattedNum;
                                                                    }
                                                                    
                                                                ?>
                                                            </center>
                                                        </td>
            
                                                        <?php if(round($average) > 0): ?>
                                                            <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                                <td>
                                                                    <center>Passed</center>
                                                                </td>
                                                            <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                                <td>
                                                                    <center>with honors</center>
                                                                </td>
                                                            <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                                <td>
                                                                    <center>with high honors</center>
                                                                </td>
                                                            <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                                <td>
                                                                    <center>with highest honors</center>
                                                                </td>
                                                            <?php elseif(round($average) < 75): ?>
                                                                <td>
                                                                    <center>Failed</center>
                                                                </td>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <td></td>
                                                        <?php endif; ?>
                                                                
                                                        </tr>                                    
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                                                    <tr>
                                                        <td colspan="13">
                                                            <b>Female</b>
                                                        </td>
                                                    </tr>
                                                    <?php $__currentLoopData = $GradeSheetFeMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?>.</td>
                                                        <td><?php echo e($sub->student_name); ?></td>
                                                        
                                                        <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                $subj_1 = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                                if($subj_1 > 0)
                                                                {
                                                                    echo $subj_1;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                                $subj_2 = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                                if($subj_2 > 0)
                                                                {
                                                                    echo $subj_2;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                                $subj_3 = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                                    if($subj_3 > 0)
                                                                    {
                                                                        echo $subj_3;
                                                                    }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                                $subj_4 = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                                if($subj_4  > 0)
                                                                {
                                                                    echo $subj_4;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                                $subj_5 = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                                if($subj_5 > 0)
                                                                {
                                                                    echo $subj_5;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                                $subj_6 = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                                if($subj_6 > 0)
                                                                {
                                                                    echo $subj_6;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                                $subj_7 = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                                if($subj_7 > 0)
                                                                {
                                                                    echo $subj_7;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                                $subj_8 = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                                if($subj_8 > 0)
                                                                {
                                                                    echo $subj_8;
                                                                }
                                                            ?>
                                                        </td>
                                                        
                                                        <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                                $subj_9 = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                                if($subj_9 > 0)
                                                                {
                                                                    echo $subj_9;
                                                                }
                                                            
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <center>                                                
                                                                <?php
                                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                    if($formattedNum > 0 )
                                                                    {
                                                                        echo $formattedNum;
                                                                    }
                                                                    
                                                                ?>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>                                                
                                                                <?php
                                                                    $formattedNum = number_format(round($average = (round($subj_1) + round($subj_2) + round($subj_3) + round($subj_4) + round($subj_5) + round($subj_6) + round($subj_7) + round($subj_8) + round($subj_9) )/9), 0);
                                                                    if($formattedNum > 0 )
                                                                    {
                                                                        echo $formattedNum;
                                                                    }
                                                                    
                                                                ?>
                                                            </center>
                                                        </td>
            
                                                        <?php if(round($average) > 0): ?>
                                                            <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                                <td>
                                                                    <center>Passed</center>
                                                                </td>
                                                            <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                                <td>
                                                                    <center>with honors</center>
                                                                </td>
                                                            <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                                <td>
                                                                    <center>with high honors</center>
                                                                </td>
                                                            <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                                <td>
                                                                    <center>with highest honors</center>
                                                                </td>
                                                            <?php elseif(round($average) < 75): ?>
                                                                <td>
                                                                    <center>Failed</center>
                                                                </td>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <td></td>
                                                        <?php endif; ?>
                                                                
                                                        </tr>                                    
                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                                            <table class="table no-margin table-striped table-bordered table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 30px">#</th>
                                                            <th style="width: 200px">Student Name</th>                                       
                                                            
                                                            <th style="width: 80px; text-align: center">Filipino</th>
                                                            <th style="width: 80px; text-align: center">English</th>
                                                            <th style="width: 80px; text-align: center">Mathematics</th>
                                                            <th style="width: 80px; text-align: center">Science</th>
                                                            <th style="width: 80px; text-align: center">Araling<br/> Panlipunan</th>
                                                            <th style="width: 80px; text-align: center">ESP</th>
                                                            <th style="width: 80px; text-align: center">TLE</th>
                                                            <th style="width: 80px; text-align: center">MAPEH</th>                                        
                                                            <th style="width: 80px; text-align: center">Religion</th>
                                                            <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                                            <th style="width: 80px; text-align: center">REMARKS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                  
                                                        <tr>
                                                            <td colspan="13">
                                                                <b>Male</b>
                                                            </td>
                                                        </tr>
                                                        <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($key + 1); ?>.</td>
                                                            <td><?php echo e($sub->student_name); ?></td>
                                                            <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td> 
                                                            <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>                                                                                               
                                                            <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>                                                       

                                                            
                                                            <td>
                                                                <center>                                                
                                                                    <?php
                                                                        $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                        
                                                                        if($formattedNum > 0)
                                                                        {
                                                                            echo $formattedNum;
                                                                        }
                                                                        
                                                                    ?>
                                                                </center>
                                                            </td>
                                                            
                                                            <?php if(round($average) > 0): ?>
                                                                <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                                    <td>
                                                                        <center>Passed</center>
                                                                    </td>
                                                                <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                                    <td>
                                                                        <center>with honors</center>
                                                                    </td>
                                                                <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                                    <td>
                                                                        <center>with high honors</center>
                                                                    </td>
                                                                <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                                    <td>
                                                                        <center>with highest honors</center>
                                                                    </td>
                                                                <?php elseif(round($average) < 75): ?>
                                                                    <td>
                                                                        <center>Failed</center>
                                                                    </td>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <td></td>
                                                            <?php endif; ?>
                                                                    
                                                            </tr>                                    
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                                                        <tr>
                                                            <td colspan="13">
                                                                <b>Female</b>
                                                            </td>
                                                        </tr>
                                                        <?php $__currentLoopData = $GradeSheetFeMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($key + 1); ?>.</td>
                                                            <td><?php echo e($sub->student_name); ?></td>
                                                            

                                                            <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td> 
                                                            <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                            <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>                                                                                               
                                                            <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>

                                                            
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                    if($formattedNum > 0)
                                                                    {
                                                                        echo $formattedNum;
                                                                    }
                                                                    ?>                                                
                                                                </center>
                                                            </td>
                                                            
                                                            <?php if(round($average) > 0): ?>
                                                                <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                                    <td>
                                                                        <center>Passed</center>
                                                                    </td>
                                                                <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                                    <td>
                                                                        <center>with honors</center>
                                                                    </td>
                                                                <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                                    <td>
                                                                        <center>with high honors</center>
                                                                    </td>
                                                                <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                                    <td>
                                                                        <center>with highest honors</center>
                                                                    </td>
                                                                <?php elseif(round($average) < 75): ?>
                                                                    <td>
                                                                        <center>Failed</center>
                                                                    </td>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <td></td>
                                                            <?php endif; ?>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                        
                                                    </tbody>
                                            </table>
            </div>
        <?php endif; ?>
    <?php else: ?>
        
        <h4>Quarter: <span class="text-red"><i><?php echo e($quarter); ?></i></span></h4>
        <h4>Grade &amp; Section: <span class="text-red"><i><?php echo e($ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section); ?></i></span></h4>
        <h4>Room: <span class="text-red"><i><?php echo e($ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description); ?></i></span></h4>
        <?php echo $__env->make('control_panel_faculty.my_advisory_class.partials.data_button_print', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>          
        <?php if($quarter == 'Fourth'): ?>
            <div class="table-responsive">
                                    <table class="table no-margin table-striped table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px">#</th>
                                                <th style="width: 200px">Student Name</th>                                       
                                                
                                                <th style="width: 80px; text-align: center" colspan="2">Filipino</th>
                                                <th style="width: 80px; text-align: center" colspan="2">English</th>
                                                <th style="width: 80px; text-align: center" colspan="2">Math</th>
                                                <th style="width: 80px; text-align: center" colspan="2">Science</th>
                                                <th style="width: 80px; text-align: center" colspan="2">Araling<br/> Panlipunan</th>
                                                <th style="width: 80px; text-align: center" colspan="2">TLE</th>
                                                <th style="width: 80px; text-align: center" colspan="2">MAPEH</th>
                                                <th style="width: 80px; text-align: center" colspan="2">ESP</th>
                                                <th style="width: 80px; text-align: center" colspan="2">Religion</th>
                                                <th style="width: 80px; text-align: center" colspan="2">GENERAL AVERAGE</th>
                                                <th style="width: 80px; text-align: center">REMARKS</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                  
                                            <tr>
                                                <td> 
                                                    <b>Male</b>
                                                </td>
                                                <td></td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                                <td style="color: red">4TH</td>
                                                <td style="color: blue">FG</td>
                                            </tr>
                                            <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?>.</td>
                                                <td><?php echo e($sub->student_name); ?></td>
                                                <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                        $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                        $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                        $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                        $subj_1 = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                        if($subj_1 > 0)
                                                        {
                                                            echo $subj_1;
                                                        }
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                    $subj_2 = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                        if($subj_2 > 0)
                                                        {
                                                            echo $subj_2;
                                                        }
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                    $subj_3 = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                        if($subj_3 > 0)
                                                        {
                                                            echo $subj_3;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                    $subj_4 = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                        if($subj_4 > 0)
                                                        {
                                                            echo $subj_4;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                    $subj_5 = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                        if($subj_5 > 0)
                                                        {
                                                            echo $subj_5;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                    $subj_6 = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                        if($subj_6 > 0)
                                                        {
                                                            echo $subj_6;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                    $subj_7 = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                        if($subj_7 > 0)
                                                        {
                                                            echo $subj_7;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                    $subj_8 = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                        if($subj_8 > 0)
                                                        {
                                                            echo $subj_8;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                    $subj_9 = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                        if($subj_9 > 0)
                                                        {
                                                            echo $subj_9;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td>
                                                    <center>                                                
                                                        <?php
                                                            $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                            if($formattedNum > 0)
                                                            {
                                                                echo $formattedNum;
                                                            }
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>                                                
                                                        <?php
                                                            $formattedNum = number_format(round($average = (round($subj_1) + round($subj_2) + round($subj_3) + round($subj_4) + round($subj_5) + round($subj_6) + round($subj_7) + round($subj_8) + round($subj_9) )/9), 0);
                                                            if($formattedNum > 0)
                                                            {
                                                                echo $formattedNum;
                                                            }
                                                        ?>
                                                    </center>
                                                </td>

                                                <?php if(round($average) > 0 ): ?>
                                                    <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                        <td>
                                                            <center>Passed</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                        <td>
                                                            <center>with honors</center>
                                                        </td>
                                                    <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                        <td>
                                                            <center>with high honors</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                        <td>
                                                            <center>with highest honors</center>
                                                        </td>
                                                    <?php elseif(round($average) < 75): ?>
                                                        <td>
                                                            <center>Failed</center>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <td></td>
                                                <?php endif; ?>
                                                        
                                                </tr>                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <tr>
                                                <td colspan="13">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                            <?php $__currentLoopData = $GradeSheetFeMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?>.</td>
                                                <td><?php echo e($sub->student_name); ?></td>
                                                <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                        $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                        $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                        $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                        $subj_1 = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                        if($subj_1 > 0)
                                                        {
                                                            echo $subj_1;
                                                        }
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                    $subj_2 = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                        if($subj_2 > 0)
                                                        {
                                                            echo $subj_2;
                                                        }
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                    $subj_3 = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                        if($subj_3 > 0)
                                                        {
                                                            echo $subj_3;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                    $subj_4 = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                        if($subj_4 > 0)
                                                        {
                                                            echo $subj_4;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                    $subj_5 = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                        if($subj_5 > 0)
                                                        {
                                                            echo $subj_5;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                    $subj_6 = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                        if($subj_6 > 0)
                                                        {
                                                            echo $subj_6;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                    $subj_7 = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                        if($subj_7 > 0)
                                                        {
                                                            echo $subj_7;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                    $subj_8 = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                        if($subj_8 > 0)
                                                        {
                                                            echo $subj_8;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                    $subj_9 = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                        if($subj_9 > 0)
                                                        {
                                                            echo $subj_9;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                                <td>
                                                    <center>                                                
                                                        <?php
                                                            $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                            if($formattedNum > 0)
                                                            {
                                                                echo $formattedNum;
                                                            }
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>                                                
                                                        <?php
                                                            $formattedNum = number_format(round($average = (round($subj_1) + round($subj_2) + round($subj_3) + round($subj_4) + round($subj_5) + round($subj_6) + round($subj_7) + round($subj_8) + round($subj_9) )/9), 0);
                                                            if($formattedNum > 0)
                                                            {
                                                                echo $formattedNum;
                                                            }
                                                        ?>
                                                    </center>
                                                </td>

                                                <?php if(round($average) > 0 ): ?>
                                                    <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                        <td>
                                                            <center>Passed</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                        <td>
                                                            <center>with honors</center>
                                                        </td>
                                                    <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                        <td>
                                                            <center>with high honors</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                        <td>
                                                            <center>with highest honors</center>
                                                        </td>
                                                    <?php elseif(round($average) < 75): ?>
                                                        <td>
                                                            <center>Failed</center>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <td></td>
                                                <?php endif; ?>
                                                        
                                                </tr>                                    
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            
                                        </tbody>
                                    </table>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                                    <table class="table no-margin table-striped table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px">#</th>
                                                <th style="width: 200px">Student Name</th>                                       
                                                
                                                <th style="width: 80px; text-align: center">Filipino</th>
                                                <th style="width: 80px; text-align: center">English</th>
                                                <th style="width: 80px; text-align: center">Math</th>
                                                <th style="width: 80px; text-align: center">Science</th>
                                                <th style="width: 80px; text-align: center">Araling<br/> Panlipunan</th>
                                                <th style="width: 80px; text-align: center">TLE</th>
                                                <th style="width: 80px; text-align: center">MAPEH</th>
                                                <th style="width: 80px; text-align: center">ESP</th>
                                                <th style="width: 80px; text-align: center">Religion</th>
                                                <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                                <th style="width: 80px; text-align: center">REMARKS</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                  
                                            <tr>
                                                <td colspan="13">
                                                    <b>Male</b>
                                                </td>
                                            </tr>
                                            <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?>.</td>
                                                <td><?php echo e($sub->student_name); ?></td>
                                                <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td>                                        
                                                <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>
                                                <td>
                                                    <center>                                                
                                                        <?php
                                                            $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                            
                                                            if($formattedNum > 0)
                                                            {
                                                                echo $formattedNum;
                                                            }
                                                                                                                        
                                                        ?>
                                                    </center>
                                                </td>

                                                <?php if(round($average) > 0): ?>
                                                    <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                        <td>
                                                            <center>Passed</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                        <td>
                                                            <center>with honors</center>
                                                        </td>
                                                    <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                        <td>
                                                            <center>with high honors</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                        <td>
                                                            <center>with highest honors</center>
                                                        </td>
                                                    <?php elseif(round($average) < 75): ?>
                                                        <td>
                                                            <center>Failed</center>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <td></td>
                                                <?php endif; ?>
                                                        
                                                </tr>                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <tr>
                                                <td colspan="13">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                            <?php $__currentLoopData = $GradeSheetFeMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?>.</td>
                                                <td><?php echo e($sub->student_name); ?></td>
                                                <td><center><?php echo e($sub ? round($sub->filipino) > 0 ? round($sub->filipino) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->english) > 0 ? round($sub->english) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->math) > 0 ? round($sub->math) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->science) > 0 ? round($sub->science) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->ap) > 0 ? round($sub->ap) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->ict) > 0 ? round($sub->ict) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->mapeh) > 0 ? round($sub->mapeh) : '' : ''); ?></center></td>
                                                <td><center><?php echo e($sub ? round($sub->esp) > 0 ? round($sub->esp) : '' : ''); ?></center></td>                                        
                                                <td><center><?php echo e($sub ? round($sub->religion) > 0 ? round($sub->religion) : '' : ''); ?></center></td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                            if($formattedNum > 0)
                                                            {
                                                                echo $formattedNum;
                                                            }
                                                        ?>                                                
                                                    </center>
                                                </td>
                                                
                                            
                                                <?php if(round($average) > 0): ?>
                                                    <?php if(round($average) >= 75 && round($average) <= 89): ?>
                                                        <td>
                                                            <center>Passed</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 90 && round($average) <= 94): ?>
                                                        <td>
                                                            <center>with honors</center>
                                                        </td>
                                                    <?php elseif(round($average)>= 95 && round($average) <= 97): ?>
                                                        <td>
                                                            <center>with high honors</center>
                                                        </td>
                                                    <?php elseif(round($average) >= 98 && round($average) <= 100): ?>
                                                        <td>
                                                            <center>with highest honors</center>
                                                        </td>
                                                    <?php elseif(round($average) < 75): ?>
                                                        <td>
                                                            <center>Failed</center>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <td></td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            
                                        </tbody>
                                    </table>
            </div>
        <?php endif; ?>
    <?php endif; ?>
 <?php endif; ?>