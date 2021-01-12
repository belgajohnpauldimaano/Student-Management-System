@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Student Enrolled List - {{ $ClassDetail->section->section }}
@endsection

@section ('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Search</h3>
            <form id="js-form_search">
                {{ csrf_field() }}                
                <div class="form-group col-md-3 input-school_year" style="padding-right:0; padding-left: 0">
                    <input type="text" class="form-control" name="search_student" placeholder="search">
                </div>
                <div class="help-block text-red text-left" id="js-search_student">
                </div>
                &nbsp;
                <button type="submit" class="btn btn-flat btn-success">
                    Search
                </button>
                <button type="button" class="btn btn-flat btn-primary btn_clear" style="display: none">
                    <i class="fa fa-refresh"></i> Clear
                </button>
                <button type="button" class="btn btn-flat btn-success pull-right"  title="Print" id="js-btn_print">
                    <i class="fa fa-file-pdf"></i> Print
                </button>               
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="box-body">
            <div class="js-data-container">                        
                @include('control_panel_registrar.student_enrolled.partials.data_list')                        
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
                url : "{{ route('registrar.student_enrolled_list', $id) }}",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                    $('.btn_clear').removeAttr('style');
                }
            });
        }

         $('.btn_clear').click(function (){
            location.reload();
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

            $('body').on('click', '.js-btn_drop , .js-btn_undrop', function (e) {
                e.preventDefault();
                var enrollment_id = $(this).data('id');
                var student_id = $(this).data('student_id');
                var type = $(this).data('type');
                // alert((type === 'drop') ? 'undrop' : 'drop')

                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";                
                alertify.confirm('Confirmation', 'Are you sure you want to '+(type == 'drop' ? 'drop' : 'undrop')+' this student?', function(){ 
                    $.ajax({
                        url         : "{{ route('student_enrolled.drop', $id) }}",
                        type        : 'POST',
                        data        : { 
                            _token : '{{ csrf_token() }}', 
                            enrollment_id : enrollment_id, 
                            class_detail_id : '{{ $ClassDetail->id }}', 
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
                            }
                        }
                    });
                }, function(){  

                });
            });

            
            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                window.open("{{ route('registrar.student_enrollment.print_enrolled_students',$id) }}", '', 'height=800,width=800')
            })
        });
    </script>
@endsection