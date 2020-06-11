<?php $__env->startSection('content_title'); ?>
    Faculty Class Schedule
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
                <button type="button" class="pull-right btn btn-flat btn-danger" id="js-btn_report_all"><i class="fa fa-download"></i> Print</button>
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            <div class="js-data-container">
                <?php echo $__env->make('control_panel.faculty_schedule.partials.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "<?php echo e(route('shared.faculty_class_schedules.index')); ?>",
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
            $('body').on('click', '#js-button-add, .js-btn_update_sy', function (e) {
                e.preventDefault();
                
                var id = $(this).data('id');
                $.ajax({
                    url : "<?php echo e(route('admin.faculty_information.modal_data')); ?>",
                    type : 'POST',
                    data : { _token : '<?php echo e(csrf_token()); ?>', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
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
            $('body').on('click', '.js-btn_view_class_schedule', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url         : "<?php echo e(route('shared.faculty_class_schedules.get_faculty_class_schedule')); ?>",
                    type        : 'POST',
                    data        : { _token : '<?php echo e(csrf_token()); ?>', id : id },
                    success     : function (res) {
                        $('.js-modal_holder').html(res);    
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        
                    }
                });
            });

            $('body').on('click', '.js-btn_report', function (e) {
                e.preventDefault()
                const id = $(this).data('id')
                window.open("<?php echo e(route('shared.faculty_class_schedules.print_handled_subject')); ?>?id=" + id, '', 'height=800,width=800')
            })
            
            $('body').on('click', '#js-btn_report_all', function (e) {
                e.preventDefault()
                window.open("<?php echo e(route('shared.faculty_class_schedules.print_handled_subject_all')); ?>", '', 'height=800,width=800')
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>