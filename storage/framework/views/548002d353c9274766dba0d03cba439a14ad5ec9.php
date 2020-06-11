<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_title'); ?>
    Subject Class Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search</h3>
            <form id="js-form_search">
                <?php echo e(csrf_field()); ?>

                
                
                <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-right:0">
                    <select name="search_sy" id="search_sy" class="form-control">
                        <option value="">Select SY</option>
                        <?php $__currentLoopData = $SchoolYear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id); ?>"><?php echo e($data->school_year); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div> 
                &nbsp;
                <div id="js-form_search" class="form-group col-sm-12 col-md-5" style="padding-right:0">
                    <select name="search_class_subject" id="search_class_subject" class="form-control">
                        <option value="">Select Class Subject</option>
                    </select>
                </div>
                &nbsp;
                <button type="submit" class=" btn btn-flat btn-success"><i class="fa fa-search"></i> Search</button>
                <button type="button" class=" btn btn-flat btn-primary" id="js-btn_print"><i class="fa fa-file-pdf"></i> Print</button>
                
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            <div class="js-data-container">
                
            </div>
        </div>
        
    </div>
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
                url : "<?php echo e(route('faculty.subject_class.list_students_by_class')); ?>",
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
        $(function () {

            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#search_class_subject').val()) {
                    alert('Please select a subject');
                    return;
                }
                fetch_data();
            });
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data();
            });
            $('body').on('click', '.js-btn_deactivate', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to deactivate?', function(){  
                    $.ajax({
                        url         : "<?php echo e(route('registrar.class_details.deactivate_data')); ?>",
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
            $('body').on('change', '#search_sy', function () {
                $.ajax({
                    url : "<?php echo e(route('faculty.subject_class.list_class_subject_details')); ?>",
                    type : 'POST',
                    
                    data        : {_token: '<?php echo e(csrf_token()); ?>', search_sy: $('#search_sy').val()},
                    success     : function (res) {

                        $('#search_class_subject').html(res);
                    }
                })
            })
            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                const search_class_subject = $('#search_class_subject').val()
                const search_sy = $('#search_sy').val()
                if (!search_class_subject || !search_sy) {
                    alert('Please select a subject');
                    return;
                }
                window.open("<?php echo e(route('faculty.subject_class.list_students_by_class_print')); ?>?search_class_subject="+search_class_subject+"&search_sy="+search_sy, '', 'height=800,width=800')
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>