<div class="table-responsive">
    <table style="margin-top: -.8em" class="table no-margin">
        <thead>
            <tr>
                <th style="width: 30px">#</th>
                <th style="width: 200px">Student Name</th>
                <?php 
                    $AdvisorySubject2 = \App\ClassSubjectDetail::
                        where('class_details_id', $ClassSubjectDetail->id)
                        ->where('sem', 1)                                              
                        ->orderBY('class_subject_order','ASC')
                        ->get();
                    $AdvisorySubject = \App\ClassSubjectDetail::
                        where('class_details_id', $ClassSubjectDetail->id)
                        ->where('sem', 2)                                              
                        ->orderBY('class_subject_order','ASC')
                        ->get();
                ?>

                <?php if($sem=='First'): ?>
                    <?php if($quarter=="First"): ?>
                        <?php $__currentLoopData = $AdvisorySubject2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                     
                            <th style="width: 30px; text-align: center">
                                
                                <?php 
                                    $subject_details = \App\SubjectDetail::
                                    where('id', $sub->subject_id)
                                    ->where('status',1)                                            
                                    ->get();
                                    
                                    echo $subject_details[0]->subject_code;
                                ?>
                            </th>                                                                  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                        <th style="width: 80px">GENERAL AVERAGE</th>
                    <?php else: ?>
                        <?php $__currentLoopData = $AdvisorySubject2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                     
                            <th style="width: 30px; text-align: center" colspan="3">
                                
                                <?php 
                                    $subject_details = \App\SubjectDetail::
                                    where('id', $sub->subject_id)  
                                    ->where('status',1)                                               
                                    ->get();  
                                    
                                    echo $subject_details[0]->subject_code;
                                ?>
                            </th>                                                                  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                        <th style="width: 80px" colspan="2">GENERAL AVERAGE</th>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($quarter=="First"): ?>
                        <?php $__currentLoopData = $AdvisorySubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                     
                            <th style="width: 30px; text-align: center">
                                
                                <?php 
                                    $subject_details = \App\SubjectDetail::
                                    where('id', $sub->subject_id)                                                
                                    ->get();
                                    
                                    echo $subject_details[0]->subject_code;
                                ?>
                            </th>                                                                  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                        <th style="width: 80px">GENERAL AVERAGE</th>
                    <?php else: ?>
                        <?php $__currentLoopData = $AdvisorySubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                     
                            <th style="width: 30px; text-align: center" colspan="3">
                                
                                <?php 
                                    $subject_details = \App\SubjectDetail::
                                    where('id', $sub->subject_id)                                                
                                    ->get();  
                                    
                                    echo $subject_details[0]->subject_code;
                                ?>
                            </th>                                                                  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                        <th style="width: 80px" colspan="2">GENERAL AVERAGE</th>
                    <?php endif; ?>
                <?php endif; ?>
                        
                
                <th style="width: 80px">REMARKS</th>
            </tr>
        </thead>
            <tbody>                                  
                <tr>
                    <?php if($quarter=="Second"): ?>
                        <td>
                            <b>Male</b>
                        </td>
                        <td></td>
                        <?php if($NumberOfSubject->class_subject_order == 7): ?>
                                <td style="color: red">1st</td>
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                
                        <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                
                        <?php else: ?>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                                <td style="color: red">1st</td>                                             
                                <td style="color: red">2nd</td>
                                <td style="color: blue">FG</td>
                        <?php endif; ?>
                        <td></td>
                        <td></td>
                        <td></td>   
                    <?php else: ?>
                        <td colspan="13">
                            <b>Male</b>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php if($sem=="First"): ?>
                    <?php if($quarter=="Second"): ?>
                        <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                                
                            <?php if($NumberOfSubject->class_subject_order == 7): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject1 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject2 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject3 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject4 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                            ?>
                                    </td>
                                    
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject5 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject6 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject7 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                        ?>
                                    </td>
                                                                                

                                    <td>
                                        <center>                                                
                                                <?php
                                                    $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7, 2);
                                                    echo $formattedNum;
                                                ?>
                                        </center>
                                    </td>
                                    

                                    <td>
                                        <center>                                                
                                            <?php
                                                $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7), 0);
                                                echo $formattedNum;
                                            ?>
                                        </center>
                                    </td>

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
                                

                            <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject1 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject2 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject3 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject4 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                        ?>
                                    </td>
                                    
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject5 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject6 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject7 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject8 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                            ?>
                                    </td>
                                

                                    <td>
                                        <center>                                                
                                                <?php
                                                    $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8, 2);
                                                    echo $formattedNum;
                                                ?>
                                        </center>
                                    </td>
                                    

                                    <td>
                                        <center>                                                
                                            <?php
                                                $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8), 0);
                                                echo $formattedNum;
                                            ?>
                                        </center>
                                    </td>

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
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject1 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                    ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                                <td style="text-align:center">
                                    <?php 
                                        echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                    ?>
                                </td>
                                <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject2 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                    ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                                <td style="text-align:center">
                                    <?php 
                                        echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                    ?>
                                </td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject3 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                        ?>
                                </td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject4 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                        ?>
                                </td>
                                
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject5 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                        ?>
                                </td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject6 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                        ?>
                                </td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject7 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                        ?>
                                </td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject8 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                        ?>
                                </td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject9 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                        ?>
                                </td>
                                <td><center><?php echo e(round($sub->subject_9)); ?></center></td>
                                <td style="text-align:center">
                                        <?php 
                                            echo $fg9 = round(($sub->subject_9 + $subject9) / 2);
                                        ?>
                                </td>

                                <td>
                                        <center>                                                
                                                <?php
                                                    $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9, 2);
                                                    echo $formattedNum;
                                                ?>
                                        </center>
                                </td>
                                

                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                            
                            <?php if($NumberOfSubject->class_subject_order == 7): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject1 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject2 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject3 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject4 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                            ?>
                                    </td>
                                    
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject5 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject6 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject7 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                            ?>
                                    </td>
                                                                                

                                    <td>
                                            <center>                                                
                                                    <?php
                                                        $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7, 2);
                                                        echo $formattedNum;
                                                    ?>
                                            </center>
                                    </td>
                                    

                                    <td>
                                        <center>                                                
                                            <?php
                                                $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7), 0);
                                                echo $formattedNum;
                                            ?>
                                        </center>
                                    </td>

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
                                        
                                                                    
                                

                            <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject1 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject2 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject3 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject4 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                            ?>
                                    </td>
                                    
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject5 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject6 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject7 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject8 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                            ?>
                                    </td>
                                

                                    <td>
                                            <center>                                                
                                                    <?php
                                                        $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8, 2);
                                                        echo $formattedNum;
                                                    ?>
                                            </center>
                                    </td>
                                    

                                    <td>
                                        <center>                                                
                                            <?php
                                                $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8), 0);
                                                echo $formattedNum;
                                            ?>
                                        </center>
                                    </td>

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
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject1 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                        <?php                                                    
                                            echo $subject2 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                                    <td style="text-align:center">
                                        <?php 
                                            echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                        ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject3 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject4 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                            ?>
                                    </td>
                                    
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject5 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject6 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject7 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject8 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php                                                    
                                                echo $subject9 = round(\App\Grade_sheet_firstsem::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                            ?>
                                    </td>
                                    <td><center><?php echo e(round($sub->subject_9)); ?></center></td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo $fg9 = round(($sub->subject_9 + $subject9) / 2);
                                            ?>
                                    </td>

                                    <td>
                                            <center>                                                
                                                    <?php
                                                        $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9, 2);
                                                        echo $formattedNum;
                                                    ?>
                                            </center>
                                    </td>
                                    

                                    <td>
                                        <center>                                                
                                            <?php
                                                $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9), 0);
                                                echo $formattedNum;
                                            ?>
                                        </center>
                                    </td>

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
                                        
                                                                
                                
                            <?php endif; ?>
                            
                        </tr>             
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    
                    <?php else: ?>

                        <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                                
                            <?php if($NumberOfSubject->class_subject_order == 7): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td><center><?php echo e($sub ? round($sub->subject_1) > 0 ? round($sub->subject_1) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_2) > 0 ? round($sub->subject_2) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_3) > 0 ? round($sub->subject_3) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_4) > 0 ? round($sub->subject_4) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_5) > 0 ? round($sub->subject_5) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_6) > 0 ? round($sub->subject_6) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_7) > 0 ? round($sub->subject_7) : '' : ''); ?></center></td>
                                
                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                                        
                                                                    
                                

                            <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td><center><?php echo e($sub ? round($sub->subject_1) > 0 ? round($sub->subject_1) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_2) > 0 ? round($sub->subject_2) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_3) > 0 ? round($sub->subject_3) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_4) > 0 ? round($sub->subject_4) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_5) > 0 ? round($sub->subject_5) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_6) > 0 ? round($sub->subject_6) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_7) > 0 ? round($sub->subject_7) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_8) > 0 ? round($sub->subject_8) : '' : ''); ?></center></td>
                                
                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td><center><?php echo e($sub ? round($sub->subject_1) > 0 ? round($sub->subject_1) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_2) > 0 ? round($sub->subject_2) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_3) > 0 ? round($sub->subject_3) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_4) > 0 ? round($sub->subject_4) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_5) > 0 ? round($sub->subject_5) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_6) > 0 ? round($sub->subject_6) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_7) > 0 ? round($sub->subject_7) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_8) > 0 ? round($sub->subject_8) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_9) > 0 ? round($sub->subject_9) : '' : ''); ?></center></td>

                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                            
                            <?php if($NumberOfSubject->class_subject_order == 7): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td><center><?php echo e($sub ? round($sub->subject_1) > 0 ? round($sub->subject_1) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_2) > 0 ? round($sub->subject_2) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_3) > 0 ? round($sub->subject_3) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_4) > 0 ? round($sub->subject_4) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_5) > 0 ? round($sub->subject_5) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_6) > 0 ? round($sub->subject_6) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_7) > 0 ? round($sub->subject_7) : '' : ''); ?></center></td>
                                
                                
                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                                        
                                                                    
                                

                            <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td><center><?php echo e($sub ? round($sub->subject_1) > 0 ? round($sub->subject_1) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_2) > 0 ? round($sub->subject_2) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_3) > 0 ? round($sub->subject_3) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_4) > 0 ? round($sub->subject_4) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_5) > 0 ? round($sub->subject_5) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_6) > 0 ? round($sub->subject_6) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_7) > 0 ? round($sub->subject_7) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_8) > 0 ? round($sub->subject_8) : '' : ''); ?></center></td>
                                
                                
                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                                <td><?php echo e($key + 1); ?>.</td>
                                <td><?php echo e($sub->student_name); ?></td>
                                <td><center><?php echo e($sub ? round($sub->subject_1) > 0 ? round($sub->subject_1) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_2) > 0 ? round($sub->subject_2) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_3) > 0 ? round($sub->subject_3) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_4) > 0 ? round($sub->subject_4) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_5) > 0 ? round($sub->subject_5) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_6) > 0 ? round($sub->subject_6) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_7) > 0 ? round($sub->subject_7) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_8) > 0 ? round($sub->subject_8) : '' : ''); ?></center></td>
                                <td><center><?php echo e($sub ? round($sub->subject_9) > 0 ? round($sub->subject_9) : '' : ''); ?></center></td>

                                <td>
                                    <center>                                                
                                        <?php
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                            echo $formattedNum;
                                        ?>
                                    </center>
                                </td>

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
                                        
                                                                
                                
                            <?php endif; ?>
                            
                        </tr>             
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    <?php endif; ?>
            
                <?php else: ?>
                <?php if($quarter=="Second"): ?>
                <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                        
                    <?php if($NumberOfSubject->class_subject_order == 7): ?>
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($sub->student_name); ?></td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                <?php                                                    
                                    echo $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                    ?>
                            </td>
                            
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                    ?>
                            </td>
                                                                        

                            <td>
                                    <center>                                                
                                            <?php
                                                $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7, 2);
                                                echo $formattedNum;
                                            ?>
                                    </center>
                            </td>
                            

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                                
                                                            
                        

                    <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($sub->student_name); ?></td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                <?php                                                    
                                    echo $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                    ?>
                            </td>
                            
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                    ?>
                            </td>
                        

                            <td>
                                    <center>                                                
                                            <?php
                                                $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8, 2);
                                                echo $formattedNum;
                                            ?>
                                    </center>
                            </td>
                            

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($sub->student_name); ?></td>
                        <td style="text-align:center">
                            <?php                                                    
                                echo $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                            ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                        <td style="text-align:center">
                            <?php 
                                echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                            ?>
                        </td>
                        <td style="text-align:center">
                            <?php                                                    
                                echo $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                            ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                        <td style="text-align:center">
                            <?php 
                                echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                            ?>
                        </td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                ?>
                        </td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                ?>
                        </td>
                        
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                ?>
                        </td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                ?>
                        </td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                ?>
                        </td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                ?>
                        </td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject9 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                ?>
                        </td>
                        <td><center><?php echo e(round($sub->subject_9)); ?></center></td>
                        <td style="text-align:center">
                                <?php 
                                    echo $fg9 = round(($sub->subject_9 + $subject9) / 2);
                                ?>
                        </td>

                        <td>
                                <center>                                                
                                        <?php
                                            $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9, 2);
                                            echo $formattedNum;
                                        ?>
                                </center>
                        </td>
                        

                        <td>
                            <center>                                                
                                <?php
                                    $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9), 0);
                                    echo $formattedNum;
                                ?>
                            </center>
                        </td>

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
                    
                    <?php if($NumberOfSubject->class_subject_order == 7): ?>
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($sub->student_name); ?></td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                <?php                                                    
                                    echo $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                    ?>
                            </td>
                            
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                    ?>
                            </td>
                                                                        

                            <td>
                                    <center>                                                
                                            <?php
                                                $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7, 2);
                                                echo $formattedNum;
                                            ?>
                                    </center>
                            </td>
                            

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7)/7), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                                
                                                            
                        

                    <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($sub->student_name); ?></td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                <?php                                                    
                                    echo $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                    ?>
                            </td>
                            
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                    ?>
                            </td>
                        

                            <td>
                                    <center>                                                
                                            <?php
                                                $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8, 2);
                                                echo $formattedNum;
                                            ?>
                                    </center>
                            </td>
                            

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8)/8), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($sub->student_name); ?></td>
                        <td style="text-align:center">
                                <?php                                                    
                                    echo $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg1 = round(($sub->subject_1 + $subject1) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                <?php                                                    
                                    echo $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>                                            
                            <td style="text-align:center">
                                <?php 
                                    echo $fg2 = round(($sub->subject_2 + $subject2) / 2);
                                ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg3 = round(($sub->subject_3 + $subject3) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg4 = round(($sub->subject_4 + $subject4) / 2);
                                    ?>
                            </td>
                            
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg5 = round(($sub->subject_5 + $subject5) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg6 = round(($sub->subject_6 + $subject6) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg7 = round(($sub->subject_7 + $subject7) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg8 = round(($sub->subject_8 + $subject8) / 2);
                                    ?>
                            </td>
                            <td style="text-align:center">
                                    <?php                                                    
                                        echo $subject9 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                    ?>
                            </td>
                            <td><center><?php echo e(round($sub->subject_9)); ?></center></td>
                            <td style="text-align:center">
                                    <?php 
                                        echo $fg9 = round(($sub->subject_9 + $subject9) / 2);
                                    ?>
                            </td>

                            <td>
                                    <center>                                                
                                            <?php
                                                $formattedNum = number_format($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9, 2);
                                                echo $formattedNum;
                                            ?>
                                    </center>
                            </td>
                            

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($fg1 + $fg2 + $fg3 + $fg4 + $fg5 + $fg6 + $fg7 + $fg8 +$fg9)/9), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                                
                                                        
                        
                    <?php endif; ?>
                    
                    </tr>             
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                
                <?php else: ?>

                    <?php $__currentLoopData = $GradeSheetMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                            
                        <?php if($NumberOfSubject->class_subject_order == 7): ?>
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($sub->student_name); ?></td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            
                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                                    
                                                                
                            

                        <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($sub->student_name); ?></td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            
                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($sub->student_name); ?></td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_9)); ?></center></td>

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                        
                        <?php if($NumberOfSubject->class_subject_order == 7): ?>
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($sub->student_name); ?></td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            
                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                                    
                                                                
                            

                        <?php elseif($NumberOfSubject->class_subject_order == 8): ?>
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($sub->student_name); ?></td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            
                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($sub->student_name); ?></td>
                            <td><center><?php echo e(round($sub->subject_1)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_2)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_3)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_4)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_5)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_6)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_7)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_8)); ?></center></td>
                            <td><center><?php echo e(round($sub->subject_9)); ?></center></td>

                            <td>
                                <center>                                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                        echo $formattedNum;
                                    ?>
                                </center>
                            </td>

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
                                    
                                                            
                            
                        <?php endif; ?>
                        
                    </tr>             
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <?php endif; ?>
                <?php endif; ?>
    </table>
</div>