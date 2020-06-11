<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_title'); ?>
    Schedules
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <?php echo $__env->make('control_panel_student.class_schedule.partials.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
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
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel_student.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>