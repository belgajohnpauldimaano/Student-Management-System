@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    My Student List
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <h3 class="card-title">Student List of <b>Grade {{ $ClassDetails->grade_level }} - {{ $ClassDetails->section->section }}</b></h3>
            {{-- <div class="box-header with-border"> --}}
            {{-- <h3 class="box-title">Search</h3> --}}
            <form id="js-form_search">
                {{-- {{ csrf_field() }}
                <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-left:0;padding-right:0">
                    <input type="text" class="form-control form-control-sm" name="search">
                </div>                
                <button type="submit" class="btn  btn-success">Search</button> --}}
            </form>
        {{-- </div> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        @include('control_panel_faculty.class_student.partials.data_list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('faculty.advisory_class.view') }}",
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
            $('body').on('click', '.js-btn_drop , .js-btn_undrop', function (e) {
                e.preventDefault();
                var enrollment_id = $(this).data('id');
                var student_id = $(this).data('student_id');
                var type = $(this).data('type');
                {{ $class_id }}

                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";                
                alertify.confirm('Confirmation', 'Are you sure you want to '+(type == 'drop' ? 'drop' : 'undrop')+' this student?', function(){ 
                    $.ajax({
                        url         : "{{ route('student_enrolled.drop', $class_id) }}",
                        type        : 'POST',
                        data        : { 
                            _token : '{{ csrf_token() }}', 
                            enrollment_id : enrollment_id, 
                            class_detail_id : '{{ $class_id }}', 
                            student_id : student_id, 
                            type : type
                        },
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

                                fetch_data();
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                                // 
                            }
                        }
                    });
                }, function(){  

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
            $('body').on('click', '.js-btn_deactivate', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to deactivate?', function(){  
                    $.ajax({
                        url         : "{{ route('registrar.class_details.deactivate_data') }}",
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
                                fetch_data();
                            }
                        }
                    });
                }, function(){  

                });
            });
            
            

            
        });
        
    </script>
@endsection