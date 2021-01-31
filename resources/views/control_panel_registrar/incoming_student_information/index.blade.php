@extends('control_panel.layouts.master')

@section ('content_title')
    Incoming Student/Not yet Approved
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <div class="col-md-8 m-auto">
                <h6 class="box-title">Search</h6>
                <form id="js-form_search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div id="js-form_search" class="form-group" style="padding-left:0;padding-right:0">
                                <input type="text" class="form-control" name="search">
                            </div>   
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn  btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        @include('control_panel_registrar.incoming_student_information.partials.data_list')
                    </div>
                </div>        
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
                url : "{{ route('admission.incoming_student') }}",
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
                fetch_data();
            });

            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data();
            });

            $('body').on('click', '.btn-approve', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to approve?', function(){  
                    $.ajax({
                        url         : "{{ route('admission.incoming_student.approve') }}",
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
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to disapprove?', function(){  
                    $.ajax({
                        url         : "{{ route('admission.incoming_student.disapprove') }}",
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

            $('body').on('click', '.btn-view-modal', function (e) {
                e.preventDefault();
                 
                var id = $(this).data('id');
                // var monthly_id = $(this).data('monthly_id');
                $.ajax({
                    url : "{{ route('admission.incoming_student.modal') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
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
@endsection