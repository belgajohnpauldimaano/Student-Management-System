<?php $__env->startSection('content_title'); ?>
    Student Demographic Profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="box">
                    <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    <div class="box-body">
                        <?php if($ClassSubjectDetail): ?>                        
                            <h4><b>Year and Section: <i style="color: red">Grade:<?php echo e($ClassSubjectDetail->grade_level); ?> - <?php echo e($ClassSubjectDetail->section); ?></i></b></h4>     
                        <?php else: ?>
                            <h4><b>Year and Section: <i style="color: red">Not Available</i></b></h4>     
                        <?php endif; ?>
                        <div class="js-data-container1">
                                <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id=""><i class="fa fa-file-pdf"></i> Print</button>
                                
                                
                                        <table class="table no-margin table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px">#</th>
                                                        <th style="width: ">Student Name</th>   
                                                        <th style="width: 180px; text-align:center">Birthdate</th>
                                                        <th style="width: 90px; text-align:center">Age June</th>
                                                        <th style="width: 90px; text-align:center">Age May</th>
                                                        <th style="text-align:center" >Address</th>
                                                        
                                                        <th style="text-align:center" >Guardian</th>
                                                        
                                                        
                                                        <th style="text-align:center" >Action</th>                                 
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>      
                                                                               
                                                    <tr>
                                                        <td colspan="16">
                                                            <b>Male</b> 
                                                        </td>
                                                    </tr>
        
                                                    <?php $__currentLoopData = $EnrollmentMale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                        
                                                        <form id="js_demographic">
                                                                <?php echo e(csrf_field()); ?>

                                                            <tr>
                                                                <td><?php echo e($key + 1); ?>.</td>
                                                                <td><?php echo e($data->student_name); ?></td>
                                                                <td>
                                                                    <input type="hidden" id="stud_id" name="stud_id" value="<?php echo e($data->student_information_id); ?>" />
                                                                        
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" name="birthdate" class="datepicker form-control pull-right" id="datepicker" placeholder="DOB" value="<?php echo e($data ? date_format(date_create( $data->birthdate), 'm/d/Y') : ''); ?>">
                                                                    </div>
                                                                    <div class="help-block text-red text-center" id="js-birthdate">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="age_june" value="<?php echo e($data ? $data->age_june : ''); ?>" placeholder="Age">
                                                                    <div class="help-block text-red text-center" id="js-age_june">
                                                                    </div>                                                    
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="age_may" value="<?php echo e($data ? $data->age_may : ''); ?>" placeholder="Age">
                                                                    <div class="help-block text-red text-center" id="js-age_may">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="address" value="<?php echo e($data ? $data->c_address : ''); ?>" placeholder="Address">
                                                                    <div class="help-block text-red text-center" id="js-address">
                                                                    </div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <input type="text" class="form-control" name="guardian" value="<?php echo e($data ? $data->guardian : ''); ?>" placeholder="Guardian name">
                                                                    <div class="help-block text-red text-center" id="js-guardian">
                                                                    </div>
                                                                </td>
                                                                
                                                                
                                                                <td>
                                                                    <center>
                                                                    <button type="submit" class="btn btn-sm btn-primary save">save</button>
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
                                                    
                                                        <form id="js_demographic">
                                                                <?php echo e(csrf_field()); ?>

                                                            <tr>
                                                                <td><?php echo e($key + 1); ?>.</td>
                                                                <td><?php echo e($data->student_name); ?></td>
                                                                <td>
                                                                        <input type="hidden" id="stud_id" name="stud_id" value="<?php echo e($data->student_information_id); ?>" />
                                                                    
                                                                    
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" name="birthdate" class="datepicker form-control pull-right datails_input" id="datepicker<?php echo e($key + 1); ?>" value="<?php echo e($data ? date_format(date_create( $data->birthdate), 'm/d/Y') : ''); ?>" placeholder="DOB">
                                                                    </div>
                                                                    
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control input-sm datails_input" name="age_june" id="age_june_<?php echo e($data->id); ?>" value="<?php echo e($data ? $data->age_june : ''); ?>" placeholder="Age">
                                                                    
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control input-sm datails_input" name="age_may" value="<?php echo e($data ? $data->age_may : ''); ?>" placeholder="Age">
                                                                    
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control input-sm datails_input" name="address" value="<?php echo e($data ? $data->c_address : ''); ?>" placeholder="Address">
                                                                    
                                                                </td>
                                                                
                                                                <td>
                                                                    <input type="text" class="form-control input-sm datails_input" name="guardian" value="<?php echo e($data ? $data->guardian : ''); ?>" placeholder="Guardian name">
                                                                    
                                                                </td>
                                                                
                                                                
                                                                <td>
                                                                    <button type="submit" class="btn btn-sm btn-primary" >save</button>
                                                                </td>
                                                                
                                                            </tr>
                                                        </form>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                    
                                                        
                                                    
                                        </table>
                                
                                                       
                        </div>
                    </div>
                 
                   
            
            
            
    </div>       
                
                
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('cms/plugins/datepicker1/bootstrap-datepicker1.js')); ?>"></script>
    <script>
    
    $('.datepicker').each(function () {
           $(this).removeClass('hasDatepicker').datepicker();
    });


    // $( "#datepicker" ).datepicker();
    $('body').on('submit', '#js_demographic', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "<?php echo e(route('faculty.save_demographic')); ?>",
                    type        : 'POST',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    success     : function (res) {
                        $('.help-block').html('');
                        if (res.res_code == 1)
                        {
                            show_toast_alert({
                                heading : 'Error',
                                message : res.res_msg,
                                type    : 'error'
                            });
                        }
                        else
                        {
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });                        
                
                            // fetch_data ();
                            loader_overlay();
                            setTimeout(function() {
                                location.reload();
                                }, 15);
                        }
                    }
                });
            });
    
    </script>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>