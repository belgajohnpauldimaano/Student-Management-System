<?php $__env->startSection('styles'); ?> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_title'); ?>
    Incoming Student
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search</h3>
            <form id="js-form_search">
                <?php echo e(csrf_field()); ?>

                <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-left:0;padding-right:0">
                    <input type="text" class="form-control" name="search">
                </div>                
                <button type="submit" class="btn btn-flat btn-success">Search</button>
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            
            <div class="js-data-container">
                <?php echo $__env->make('control_panel_registrar.incoming_student.partials.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>       
            </div>
            
        </div>        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('cms/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
    
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "<?php echo e(route('registrar.incoming_student')); ?>",
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

        $('body').on('click', '.btn-approve', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to approve?', function(){  
                    $.ajax({
                        url         : "<?php echo e(route('registrar.incoming_student.approve')); ?>",
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
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '.btn-disapprove', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to disapprove?', function(){  
                    $.ajax({
                        url         : "<?php echo e(route('registrar.incoming_student.disapprove')); ?>",
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
                            }
                        }
                    });
                }, function(){  

                });
            });
        
       
        $(function () {            
            $('body').on('click', '.btn-view-modal', function (e) {
                e.preventDefault();
                 
                var id = $(this).data('id');
                // var monthly_id = $(this).data('monthly_id');
                $.ajax({
                    url : "<?php echo e(route('registrar.incoming_student.modal')); ?>",
                    type : 'POST',
                    data : { _token : '<?php echo e(csrf_token()); ?>', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                                                             
                            
                        });
                    }
                });
            });            
        });

       

        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>