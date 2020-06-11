<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_title'); ?>
    Encode Class Attendance
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="box">
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
                <div class="js-data-container">
                         <?php echo $__env->make('control_panel_faculty.student_attendance.partials.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                </div>      
        </div>
    </div>       
                
                
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('cms/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
    <script>

    
        function fetch_data () {
            var formData = new FormData($('#js-data-container1')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "<?php echo e(route('faculty.class-attendance.index')); ?>",
                type : 'GET',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                }
            });
        }
           
            $('body').on('submit', '#js-attendance', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "<?php echo e(route('faculty.save_class_attendance')); ?>",
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
                            setTimeout(function() {
                                location.reload();
                                }, 15);
                        }
                    }
                });
            });

            

            $('body').on('submit', '#js-attendance_senior_firstsem', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "<?php echo e(route('faculty.save_attendance_senior_first')); ?>",
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
                            setTimeout(function() {
                                location.reload();
                                }, 15);
                        }
                    }
                });
            });

            $('body').on('submit', '#js-attendance_senior_secondsem', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "<?php echo e(route('faculty.save_attendance_senior_second')); ?>",
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
                            setTimeout(function() {
                                location.reload();
                                }, 15);
                        }
                    }
                });
            });

            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                window.open("<?php echo e(route('faculty.print_attendance')); ?>", '', 'height=800,width=800')
            })

            
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>