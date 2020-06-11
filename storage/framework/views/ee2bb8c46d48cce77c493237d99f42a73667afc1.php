<?php if($ClassSubjectDetail): ?>                        
    <h4><b>Year and Section: <i style="color: red">Grade:<?php echo e($ClassSubjectDetail->grade_level); ?> - <?php echo e($ClassSubjectDetail->section); ?></i></b></h4>     

    <table class="table no-margin table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 30px">#</th>
                <th style="width: ">Student Name<br/></th>   
                <th style="text-align:center">Eligible to transfer and admission to</th>
                <th style="text-align:center">Lacking units in<br/></th>
                <th style="text-align:center; width: 170px">Date<br/></th>            
                <th style="text-align:center" >Action<br/></th>                          
            </tr>
        </thead>
        <tbody>                     
            <tr>
                <td colspan="16">
                    <b>Male</b> 
                </td>
            </tr>
                <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <form id="js_lacking_units_jr">
                        <?php echo e(csrf_field()); ?>

                        <tr>
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($data->student_name); ?></td>                            
                            <td> 
                                <?php if($Semester_id == 1): ?>                                    
                                    <input type="text" class="form-control" name="eligible_transfer" value="<?php echo e($data->eligible_transfer); ?>" placeholder="none">                                     
                                <?php else: ?>
                                    <input type="text" class="form-control" name="eligible_transfer" 
                                    value="<?php echo e($ClassSubjectDetail->grade_level == 12 ? 'College' : $data->eligible_transfer ? $data->eligible_transfer : 'Grade '.($ClassSubjectDetail->grade_level + 1 )); ?>" placeholder="Grade">                                             
                                <?php endif; ?>                                 
                            </td>
                            <td>
                                <?php if($ClassSubjectDetail->grade_level < 11): ?> 
                                    <input type="text" class="form-control" name="jlacking_units" value="<?php echo e($data->j_lacking_unit); ?>" placeholder="none"> 
                                <?php elseif($ClassSubjectDetail->grade_level > 10): ?>
                                    <?php if($Semester_id == 1): ?>
                                        <input type="text" class="form-control" name="s1_lacking_units" value="<?php echo e($data->s1_lacking_unit); ?>" placeholder="none"> 
                                    <?php else: ?>
                                        <input type="text" class="form-control" name="s2_lacking_units" value="<?php echo e($data->s2_lacking_unit); ?>" placeholder="none"> 
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    
                                    <?php if($ClassSubjectDetail->grade_level < 11): ?> 
                                        <input type="text" name="date" class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="<?php echo e($DateRemarks->j_date); ?>">
                                    <?php elseif($ClassSubjectDetail->grade_level > 10): ?>
                                        <?php if($Semester_id == 1): ?>
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="<?php echo e($DateRemarks->s_date1); ?>">
                                        <?php else: ?>
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="<?php echo e($DateRemarks->s_date2); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>                                
                            </td>
                            
                            <td>
                                <center>    
                                    <input name="print_sy" id="print_sy" value="<?php echo e(encrypt($ClassSubjectDetail->id)); ?>" type="hidden" /> 
                                    <input name="stud_id" id="stud_id" value="<?php echo e($data->student_information_id); ?>" type="hidden" />
                                    <input name="s_year" id="s_year" value="<?php echo e($SchoolYear->id); ?>" type="hidden" />
                                    <input name="level" id="level" value="<?php echo e($ClassSubjectDetail->grade_level); ?>" type="hidden" />
                                    <input name="sem" id="sem" value="<?php echo e($Semester_id); ?>" type="hidden" />
                                    <input name="e_id" value="<?php echo e($data->e_id); ?>" type="hidden" />

                                    <button type="submit" class="btn btn-sm btn-primary save">save</button>
                                    <button class="btn btn-sm btn-danger printGradebtn" rel="<?php echo e(encrypt($data->student_information_id)); ?>" id="js-btn_print" data-id="<?php echo e(encrypt($data->student_information_id)); ?>">Print</button>
                                </center>
                            </td>                            
                        </tr>
                    </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
                <td colspan="16">
                    <b>Female</b> 
                </td>
            </tr>
                <?php $__currentLoopData = $EnrollmentFemale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <form id="js_lacking_units_jr">
                        <?php echo e(csrf_field()); ?>

                        <tr>
                            <td><?php echo e($key + 1); ?>.</td>
                            <td><?php echo e($data->student_name); ?></td>                            
                            <td> 
                                <?php if($Semester_id == 1): ?>                                    
                                    <input type="text" class="form-control" name="eligible_transfer" value="<?php echo e($data->eligible_transfer); ?>" placeholder="none">                                     
                                <?php else: ?>
                                    <input type="text" class="form-control" name="eligible_transfer" 
                                    value="<?php echo e($ClassSubjectDetail->grade_level == 12 ? 'College' : $data->eligible_transfer ? $data->eligible_transfer : 'Grade '.($ClassSubjectDetail->grade_level + 1 )); ?>" placeholder="Grade">                                             
                                <?php endif; ?>     
                            </td>
                            <td>
                                <?php if($ClassSubjectDetail->grade_level < 11): ?> 
                                    <input type="text" class="form-control" name="jlacking_units" value="<?php echo e($data->j_lacking_unit); ?>" placeholder="none"> 
                                <?php elseif($ClassSubjectDetail->grade_level > 10): ?>
                                    <?php if($Semester_id == 1): ?>
                                        <input type="text" class="form-control" name="s1_lacking_units" value="<?php echo e($data->s1_lacking_unit); ?>" placeholder="none"> 
                                    <?php else: ?>
                                        <input type="text" class="form-control" name="s2_lacking_units" value="<?php echo e($data->s2_lacking_unit); ?>" placeholder="none"> 
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    
                                    <?php if($ClassSubjectDetail->grade_level < 11): ?> 
                                        <input type="text" name="date" class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="<?php echo e($DateRemarks->j_date); ?>">
                                    <?php elseif($ClassSubjectDetail->grade_level > 10): ?>
                                        <?php if($Semester_id == 1): ?>
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="<?php echo e($DateRemarks->s_date1); ?>">
                                        <?php else: ?>
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="<?php echo e($DateRemarks->s_date2); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>                                
                            </td>
                            
                            <td>
                                <center>    
                                    <input name="print_sy" id="print_sy" value="<?php echo e(encrypt($ClassSubjectDetail->id)); ?>" type="hidden" /> 
                                    <input name="stud_id" id="stud_id" value="<?php echo e($data->student_information_id); ?>" type="hidden" />
                                    <input name="s_year" id="s_year" value="<?php echo e($SchoolYear->id); ?>" type="hidden" />
                                    <input name="level" id="level" value="<?php echo e($ClassSubjectDetail->grade_level); ?>" type="hidden" />
                                    <input name="sem" id="sem" value="<?php echo e($Semester_id); ?>" type="hidden" />
                                    <input name="e_id" value="<?php echo e($data->e_id); ?>" type="hidden" />

                                    <button type="submit" class="btn btn-sm btn-primary save">save</button>
                                    <button class="btn btn-sm btn-danger printGradebtn" rel="<?php echo e(encrypt($data->student_information_id)); ?>" id="js-btn_print" data-id="<?php echo e(encrypt($data->student_information_id)); ?>">Print</button>
                                </center>
                            </td>                            
                        </tr>
                    </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
        </tbody>            
    </table>
<?php endif; ?>



