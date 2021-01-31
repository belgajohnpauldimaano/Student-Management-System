@extends('control_panel.layouts.master')

@section ('content_title')
    Semester
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <h3 class="card-title">Semester List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        @include('control_panel.semester.partials.data_list')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('scripts')
    <script>
        
        function fetch_data () {            
            loader_overlay();
            $.ajax({
                url : "{{ route('admin.maintenance.semester') }}",
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
        
            $('body').on('click', '.js-btn_toggle_current', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var toggle_title = $(this).data('toggle_title');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to '+toggle_title+' ?', function(){  
                    $.ajax({
                        url         : "{{ route('admin.maintenance.semester.toggle_current_sy') }}",
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
                               
                                setTimeout(function() {
                                    location.reload();
                                }, 15);
                                fetch_data();
                            }
                        }
                    });
                }, function(){  

                });
            });
        
    </script>
@endsection