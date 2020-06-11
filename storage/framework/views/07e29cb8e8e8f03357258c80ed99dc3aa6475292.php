<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_title'); ?>
    Student Enrollment Module
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--  -->
    
    
        
        <?php if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12): ?>
            <h4>Enroll Student</h4>
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Search</h3>
                    <form id="js-form_search">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_student_id" placeholder="Student ID">
                            </div>
                        </div>
                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_fn" placeholder="First name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_mn" placeholder="Middle name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_ln" placeholder="Last name">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <button type="submit" class="btn btn-block  btn-flat btn-success"><div class="fa fa-search"></div> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">
                    <div class="js-data-container">                
                        <?php echo $__env->make('control_panel_registrar.student_enrollment.partials.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
                
            </div>

            <h3>Enrolled Students</h3>
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Search</h3>
                    <form id="js-form_search_enrolled">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_student_id" placeholder="Student ID">
                            </div>
                        </div>
                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_fn" placeholder="First name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_mn" placeholder="Middle name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_ln" placeholder="Last name">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <button type="submit" class="btn btn-block  btn-flat btn-success"><i class="fa fa-search"></i> Search</button>
                            </div>
                            <div class="col-sm-12 col-md-1">
                                <button type="button" class="btn btn-block  btn-flat btn-primary" id="js-btn_print"><i class="fa fa-file-pdf"></i> Print</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="overlay hidden" id="js-loader-overlay-enrolled"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">
                    <div class="js-data-container-enrolled">                        
                        <?php echo $__env->make('control_panel_registrar.student_enrollment.partials.data_list_enrolled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                        
                    </div>
                </div>
                
            </div>
        <?php else: ?>
            <h4>Enroll Student</h4>
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Search</h3>
                    <form id="js-form_search">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_student_id" placeholder="Student ID">
                            </div>
                        </div>
                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_fn" placeholder="First name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_mn" placeholder="Middle name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_ln" placeholder="Last name">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <button type="submit" class="btn btn-block  btn-flat btn-success"><div class="fa fa-search"></div> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">
                    <div class="js-data-container">                
                        <?php echo $__env->make('control_panel_registrar.student_enrollment.partials.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
                
            </div>

            <h3>Enrolled Students</h3>
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Search</h3>
                    <form id="js-form_search_enrolled">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_student_id" placeholder="Student ID">
                            </div>
                        </div>
                        <div class="row">
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_fn" placeholder="First name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_mn" placeholder="Middle name">
                            </div>
                            <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="">
                                <input type="text" class="form-control" name="search_ln" placeholder="Last name">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <button type="submit" class="btn btn-block  btn-flat btn-success"><i class="fa fa-search"></i> Search</button>
                            </div>
                            <div class="col-sm-12 col-md-1">
                                <button type="button" class="btn btn-block  btn-flat btn-primary" id="js-btn_print"><i class="fa fa-file-pdf"></i> Print</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="overlay hidden" id="js-loader-overlay-enrolled"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">
                    <div class="js-data-container-enrolled">                        
                        <?php echo $__env->make('control_panel_registrar.student_enrollment.partials.data_list_enrolled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                        
                    </div>
                </div>
                
            </div>
        <?php endif; ?>
        
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('cms/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "<?php echo e(route('registrar.student_enrollment', $id)); ?>",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                }
            });
        }
        function fetch_data_enrolled () {
            $('#js-loader-overlay-enrolled').removeClass('hidden')
            var formData = new FormData($('#js-form_search_enrolled')[0]);
            formData.append('page', page);
            $.ajax({
                url : "<?php echo e(route('registrar.student_enrollment.fetch_enrolled_student', $id)); ?>",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    $('#js-loader-overlay-enrolled').addClass('hidden')
                    $('.js-data-container-enrolled').html(res);
                }
            });
        }
        
        $(function () {
            $('body').on('click', '#js-button-add, .js-btn_update', function (e) {
                e.preventDefault();
                
                var class_subject_details_id = $(this).data('id');
                $.ajax({
                    url : "<?php echo e(route('registrar.student_enrollment.modal_data', $id)); ?>",
                    type : 'POST',
                    data : { _token : '<?php echo e(csrf_token()); ?>', class_subject_details_id : class_subject_details_id},
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                            //Timepicker
                            $('.timepicker').timepicker({
                            showInputs: false
                            })
                        })
                    }
                });
            });
            

            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                fetch_data();
            });
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data();
            });
            
            $('body').on('submit', '#js-form_search_enrolled', function (e) {
                e.preventDefault();
                fetch_data_enrolled();
            });
            $('body').on('click', '.js-data-container-enrolled .pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data_enrolled();
            });
            
            $('body').on('click', '.js-btn_enroll_student', function (e) {
                e.preventDefault();
                var student_id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to enroll?', function(){  
                    $.ajax({
                        url         : "<?php echo e(route('registrar.student_enrollment.enroll_student', $id)); ?>",
                        type        : 'POST',
                        data        : { _token : '<?php echo e(csrf_token()); ?>', student_id : student_id, class_detail_id : '<?php echo e($ClassDetail->id); ?>' },
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
                                $('.js-modal_holder .modal').modal('hide');
                                fetch_data();
                                fetch_data_enrolled();
                            }
                        }
                    });
                }, function(){  

                });
            });
            
            $('body').on('click', '.js-btn_cancel_enroll_student', function (e) {
                e.preventDefault();
                var enrollment_id = $(this).data('id');
                var student_id = $(this).data('student_id');
               
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to cancel or remove this student on this section?', function(){  
                    $.ajax({
                        url         : "<?php echo e(route('registrar.student_enrollment.cancel_enroll_student', $id)); ?>",
                        type        : 'POST',
                        data        : { _token : '<?php echo e(csrf_token()); ?>', enrollment_id : enrollment_id, class_detail_id : '<?php echo e($ClassDetail->id); ?>', student_id : student_id },
                        success     : function (res) {
                            $('.help-block').html('');
                            if (res.res_code == 1)
                            {
                                show_toast_alert({
                                    heading : 'Error',
                                    message : res.res_msg,
                                    type    : 'error'
                                });

                                location.reload();  
                            }
                            else
                            {
                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                $('.js-modal_holder .modal').modal('hide');
                                fetch_data();
                                fetch_data_enrolled();
                                location.reload();  
                            }
                        }
                    });
                }, function(){  

                });
            });
            
            $('body').on('click', '.js-btn_re_enroll_all_student', function (e) {
                 e.preventDefault();
                var enrollment_ids = `<?php echo e($Enrollment_ids ? $Enrollment_ids : ''); ?>`;
                $.ajax({
                        url         : "<?php echo e(route('registrar.student_enrollment.re_enroll_student_all', $id)); ?>",
                        type        : 'POST',
                        data        : { _token : '<?php echo e(csrf_token()); ?>', enrollment_ids : enrollment_ids, class_detail_id : '<?php echo e($ClassDetail->id); ?>' },
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
                            }
                        }
                    });
            });
            
            $('body').on('click', '.js-btn_re_enroll_student', function (e) {
                e.preventDefault();
                var enrollment_id = $(this).data('id');
                $.ajax({
                        url         : "<?php echo e(route('registrar.student_enrollment.re_enroll_student', $id)); ?>",
                        type        : 'POST',
                        data        : { _token : '<?php echo e(csrf_token()); ?>', enrollment_id : enrollment_id, class_detail_id : '<?php echo e($ClassDetail->id); ?>' },
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
                            }
                        }
                    });
            });

           

            $('.js-btn_re_enroll_student').click(function(){
                var checkstr =  confirm('are you sure you want to re-enroll?');
                if(checkstr == true){
                // do your code
                }else{
                return false;
                }
            });
            
            $('body').on('click', '.js-btn_deactivate', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to deactivate?', function(){  
                    $.ajax({
                        url         : "<?php echo e(route('registrar.class_details.deactivate_data', $id)); ?>",
                        type        : 'POST',
                        data        : { _token : '<?php echo e(csrf_token()); ?>', id : id },
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
                                $('.js-modal_holder .modal').modal('hide');
                                fetch_data();
                                fetch_data_enrolled();
                            }
                        }
                    });
                }, function(){  

                });
            });
            
            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                window.open("<?php echo e(route('registrar.student_enrollment.print_enrolled_students',$id)); ?>", '', 'height=800,width=800')
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>