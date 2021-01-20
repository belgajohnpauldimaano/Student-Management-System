@extends('control_panel.layouts.master')

@section ('content_title')
    Registration Button
@endsection

@section ('content')
    <div class="row">
        <div class="col-md-6">
            <div div class="box">
                <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-header with-border">
                    <div class="js-data-container">
                        @include('control_panel.registration_button.partials.data_list')
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
                url : "{{ route('admin.maintenance.registration_button') }}",
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

        $('body').on('submit', '#js-registration_button', function (e) {
            e.preventDefault();
                var formData = new FormData($(this)[0]);
                var name = $('input[name=registration_button]:checked', '#js-registration_button').val();
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to '+name+' ?', function(){
                    
                    $.ajax({
                        url         : "{{ route('admin.maintenance.registration_button.updated') }}",
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
                               
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                                fetch_data();
                            }
                        }
                    });                    
                }, function(){  

                });
        });
                
        
            $('body').on('click', '.js-btn_toggle_current', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var toggle_title = $(this).data('toggle_title');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
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