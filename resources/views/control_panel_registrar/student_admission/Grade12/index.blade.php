@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Student list: Grade 12
@endsection

@section ('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search</h3>
            <form id="js-form_search">
                {{ csrf_field() }}
                <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-left:0;padding-right:0">
                    <input type="text" class="form-control" name="search">
                </div>                
                <button type="submit" class="btn btn-flat btn-success">Search</button>
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">            
            <div class="js-data-container">
                @include('control_panel_registrar.student_admission.Grade12.partials.data_list')       
            </div>            
        </div>        
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('registrar.student_admission.grade12') }}",
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
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to approve?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.student_payment.approve') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', id : id },
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
                                setTimeout(function() 
                                {
                                    location.reload();  //Refresh page
                                }, 1000);
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '.btn-disapprove', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to disapprove?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.student_payment.disapprove') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', id : id },
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
                                setTimeout(function() 
                                {
                                    location.reload();  //Refresh page
                                }, 1000);
                            }
                        }
                    });
                }, function(){  

                });
            });
        
       
        $(function () {  
            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                fetch_data();
            });

            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data();
            });
                      
            $('body').on('click', '.btn-view-modal', function (e) {
                e.preventDefault();
                 
                var id = $(this).data('id');
                var monthly_id = $(this).data('monthly_id');
                $.ajax({
                    url : "{{ route('finance.student_payment.modal') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id , monthly_id : monthly_id},
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                                                             
                            
                        });
                    }
                });
            });

            $('body').on('click', '.js-btn_enroll_student', function (e) {
                e.preventDefault();
                var student_id = $(this).data('student_id');
                var class_id = $(this).data('class_id');
                var section = $(this).data('section');
                var student = $(this).data('student');
                
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to assign student <b>'+student+'</b> in this section <b>'+section+'</b>?', function(){  
                    $.ajax({
                        url         : "{{ route('registrar.student_admission.enroll_student') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', student_id : student_id, class_id : class_id },
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
                                setTimeout(function() 
                                {
                                    location.reload();  //Refresh page
                                }, 1000);
                                fetch_data_enrolled();
                            }
                        }
                    });
                }, function(){  

                });
            });

            
        });

       

        
    </script>
@endsection