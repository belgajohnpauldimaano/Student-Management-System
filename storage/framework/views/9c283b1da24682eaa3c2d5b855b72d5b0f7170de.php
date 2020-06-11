<?php $__env->startSection('styles'); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_title'); ?>
    My advisory Class Grade Sheet
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">        
        <?php if($GradeLevel->grade_level  == 11 ||  $GradeLevel->grade_level  == 12): ?>                    
            <div class="box-header with-border">
                <div class="form-group col-sm-12">
                    <h3 class="box-title">Filter</h3>
                </div>                        
                <form id="js-form_filter">
                    <?php echo e(csrf_field()); ?>

                        <div class="form-group col-sm-12 col-md-3" style="padding-right:0">
                            <select name="search_school_year" id="search_school_year" class="form-control">
                                <option value="">Select SY</option>
                                <?php $__currentLoopData = $SchoolYear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(encrypt($data->id)); ?>"><?php echo e($data->school_year); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div> 
                        &nbsp;
                        <div class="form-group col-sm-12 col-md-4" style="padding-right:0">
                            <select name="semester_grades" id="semester_grades" class="form-control">                            
                                <option value="">Select Semester</option>                      
                            </select>
                        </div>                
                        &nbsp;
                        <div class="form-group col-sm-12 col-md-4" style="padding-right:0">
                            <select name="quarter_" id="quarter_" class="form-control">
                                <option value="">Select Class Quarter</option>
                            </select>
                        </div>                
                        &nbsp;

                    <button type="submit" class="btn btn-flat btn-success">Search</button>
                </form>
            </div>
            <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
            <div class="box-body">
                <div class="js-data-container1"></div>
            </div>                    
        <?php else: ?>
            <div class="box-header with-border">
                <h3 class="box-title">Filter</h3>
                <form id="js-form_search">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group col-sm-12 col-md-3" style="padding-right:0">
                        <select name="search_sy" id="search_sy" class="form-control">
                            <option value="">Select SY</option>
                            <?php $__currentLoopData = $SchoolYear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(encrypt($data->id)); ?>"><?php echo e($data->school_year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div> 
                    &nbsp;
                    <div class="form-group col-sm-12 col-md-4" style="padding-right:0">
                        <select name="quarter_grades" id="quarter_grades" class="form-control">
                            <option value="">Select Class Quarter</option>                                
                        </select>
                    </div>                
                    &nbsp;
                    <button type="submit" class="btn btn-flat btn-success">Search</button>                    
                </form>
            </div>
            <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
            <div class="box-body">
                <div class="js-data-container"></div>
            </div>
        <?php endif; ?>                                                    
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

            var quarter_grades = $('#quarter_grades').val();
                    
                    if (quarter_grades == '1st') 
                    {
                       
                        $.ajax({
                            url : "<?php echo e(route('faculty.MyAdvisoryClass.firstquarter')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }                        
                        });
                        return;
                    }
                    else if(quarter_grades == '2nd')
                    {
                        
                        $.ajax({
                            url : "<?php echo e(route('faculty.MyAdvisoryClass.secondquarter')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }
                        });
                        return;
                    }
                    else if(quarter_grades == '3rd')
                    {
                        
                        $.ajax({
                            url : "<?php echo e(route('faculty.MyAdvisoryClass.thirdquarter')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }
                        });
                        return;
                    }
                    else if(quarter_grades == '4th')
                    {
                        
                        $.ajax({
                            url : "<?php echo e(route('faculty.MyAdvisoryClass.fourthquarter')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }
                        });
                        return;
                    }
                    else if(quarter_grades == '1st-2nd')
                    {
                        
                        // alert('1st-2nd');
                        $.ajax({
                            url : "<?php echo e(route('faculty.Average')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }
                        });
                        return;
                    }
                    else if(quarter_grades == '1st-3rd')
                    {
                        // alert('1st-3rd');
                        
                        $.ajax({
                            url : "<?php echo e(route('faculty.Average')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }
                        });
                        return;
                    }
                    else if(quarter_grades == '1st-4th')
                    {
                        // alert('1st-4th');
                        
                        $.ajax({
                            url : "<?php echo e(route('faculty.Average')); ?>",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                            }
                        });
                        return;
                    }
        }

        // var page = 1;
        function fetch_data1() {
            var formData = new FormData($('#js-form_filter')[0]);
            formData.append('page', page);
            loader_overlay();
            
            var semester_grades = $('#semester_grades').val();
            var quarter_ = $("#quarter_").val();
                    
                    if (semester_grades == '1st') 
                    {
                       
                        if (quarter_ == '1st') 
                        {
                            // alert('1st'); 
                            $.ajax({
                                url : "<?php echo e(route('faculty.MyAdvisoryClass.first_sem_1quarter')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }
                        else
                        {
                            // alert('2nd');
                            $.ajax({
                                url : "<?php echo e(route('faculty.MyAdvisoryClass.first_sem_2quarter')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }        
                    
                    }
                    else if(semester_grades == '2nd')
                    {
                        // alert('2nd');
                        
                        if (quarter_ == '1st') 
                        {
                            // alert('1st'); 
                            $.ajax({
                                url : "<?php echo e(route('faculty.MyAdvisoryClass.first_sem_3quarter')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }
                        else
                        {
                            // alert('2nd');
                            $.ajax({
                                url : "<?php echo e(route('faculty.MyAdvisoryClass.first_sem_4quarter')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }        
                    }
                    else if(semester_grades == '3rd')
                    {
                        if (quarter_ == '1st-2nd') 
                        {
                            // alert('1st'); 
                            $.ajax({
                                url : "<?php echo e(route('faculty.Average_Senior')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }
                        else if(quarter_ == '3rd-4th')
                        {
                            // alert('2nd');
                            $.ajax({
                                url : "<?php echo e(route('faculty.Average_Senior_Second_Sem')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }    
                        else
                        {
                            $.ajax({
                                url : "<?php echo e(route('faculty.Average_Senior')); ?>",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }    
                    }
                   
        }
        
        $(function(){
            
            $('body').on('change', '#search_school_year', function () {
                $.ajax({
                    url : "<?php echo e(route('faculty.MyAdvisoryClass.list_class_subject_details')); ?>",
                    type : 'POST',
                    
                    data        : {_token: '<?php echo e(csrf_token()); ?>', search_school_year: $('#search_school_year').val()},
                    success     : function (res) {
                        $('#semester_grades').html(res);
                    }
                })
            })

            $('body').on('change', '#semester_grades', function () {
                $.ajax({
                    url : "<?php echo e(route('faculty.MyAdvisoryClass.list_quarter-sem-details')); ?>",
                    type : 'POST',
                    
                    data        : {_token: '<?php echo e(csrf_token()); ?>', semester_grades: $('#semester_grades').val()},
                    success     : function (res) {
                        $('#quarter_').html(res);
                    }
                })
            })

            $('body').on('change', '#search_sy', function () {
                $.ajax({
                    url : "<?php echo e(route('faculty.MyAdvisoryClass.list_quarter')); ?>",
                    type : 'POST',
                    
                    data        : {_token: '<?php echo e(csrf_token()); ?>', search_sy: $('#search_sy').val()},
                    success     : function (res) {
                        $('#quarter_grades').html(res);
                    }
                })
            })

            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#search_sy').val()) {                    
                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select a School year!',
                        type    : 'error'
                    });
                    return;
                }
            });
            
            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#quarter_grades').val()) {
                    
                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select Class Quarter!',
                        type    : 'error'
                    });
                    return;
                }
                fetch_data();
            });
            //2nd form
            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#search_school_year').val()) {
                    
                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select School year!',
                        type    : 'error'
                    });
                    return;
                }
            });

            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#semester_grades').val()) {
                    
                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select Semester!',
                        type    : 'error'
                    });
                    return;
                }
            });

            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#quarter_').val()) {

                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select Class Quarter!',
                        type    : 'error'
                    });
                    
                    return;
                }
                fetch_data1();
            });
        });

        $('body').on('click', '#js-btn_print', function (e) {
            e.preventDefault()
            const quarter_grades = $('#quarter_grades').val();          
            const search_class_subject = $('#search_class_subject').val()
            const search_sy = $('#search_sy').val()
            const search_school_year = $('#search_school_year').val();
            const semester_grades = $('#semester_grades').val()
            const quarter_ = $('#quarter_').val()                   
            //junnior   
            if (quarter_grades == '1st') 
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_first_quarter')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            else if(quarter_grades == '2nd')
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_second_quarter')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            else if(quarter_grades == '3rd')
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_third_quarter')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            else if(quarter_grades == '4th')
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_fourth_quarter')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            else if(quarter_grades == '1st-2nd')
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.first_second_print_average')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            else if(quarter_grades == '1st-3rd')
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.first_third_print_average')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            else if(quarter_grades == '1st-4th')
            {
                window.open("<?php echo e(route('faculty.MyAdvisoryClass.first_fourth_print_average')); ?>?search_sy="+search_sy, '', 'height=800,width=800')
            }
            
            // senior
            if(semester_grades == '1st')
            {
                if(quarter_ == '1st')
                {
                    window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_firstSem_firstq')); ?>?search_school_year="+search_school_year, '', 'height=800,width=800')                       
                }
                else
                {
                    window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_firstSem_secondq')); ?>?search_school_year="+search_school_year, '', 'height=800,width=800') 
                }
            }
            else if(semester_grades == '2nd')
            {
                if(quarter_ == '1st')
                {
                    window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_secondSem_firstq')); ?>?search_school_year="+search_school_year, '', 'height=800,width=800') 
                }
                else
                {
                    window.open("<?php echo e(route('faculty.MyAdvisoryClass.print_secondSem_secondq')); ?>?search_school_year="+search_school_year, '', 'height=800,width=800') 
                }
            }
            else
            {
                if(quarter_ == '1st-2nd')
                {
                    window.open("<?php echo e(route('faculty.MyAdvisoryClass.final_print_average')); ?>?search_school_year="+search_school_year, '', 'height=800,width=1200') 
                }
                
            }            
        });
       
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>