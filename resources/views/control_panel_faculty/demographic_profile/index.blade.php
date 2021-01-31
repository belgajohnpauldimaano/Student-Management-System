@extends('control_panel.layouts.master')

@section ('content_title')
    Student Demographic Profile
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <h3 class="card-title">
                @if(!$EnrollmentMale->isEmpty())
                    Student List of <b>Grade {{ $ClassDetail->section->grade_level }} - {{ $ClassDetail->section->section }}</b>
                @endif
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if(!$EnrollmentMale->isEmpty())
                        @include('control_panel_faculty.demographic_profile.partials.data_list')
                    @else
                        @include('errors.404')
                    @endif
                </div>
            </div>
        </div>
    </div>
     
@endsection

@section ('scripts')
    {{-- <script src="{{ asset('cms/plugins/datepicker1/bootstrap-datepicker1.js') }}"></script> --}}
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
    
    $('.datepicker').each(function () {
           $(this).removeClass('hasDatepicker').datepicker();
    });

    // $('.datepicker').datepicker({
    //         autoclose: true
    //     })  


    // $( "#datepicker" ).datepicker();
    $('body').on('submit', '.js_demographic', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('faculty.save_demographic') }}",
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
                            // loader_overlay();
                            // setTimeout(function() {
                            //     location.reload();
                            //     }, 15);
                        }
                    }
                });
            });
    
    </script>   
@endsection