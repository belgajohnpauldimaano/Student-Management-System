@extends('control_panel.layouts.master')

@section ('styles') 

@endsection

@section ('content_title')
    Appointee List
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <div class="col-md-8 m-auto">
                <form id="js-form_search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group" style="padding-right:0">
                                <select name="js_date" id="js_date" class="form-control form-control-sm js_date">
                                    <option value="">Select Date and time</option>
                                    @foreach ($date_time as $data)
                                        <option value="{{ $data->id }}"> {{ $data ? date_format(date_create($data->date), 'F d, Y h:i A') : '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container"></div>
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
                url : "{{ route('finance.online_appointment.show') }}",
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

        $('body').on('submit', '#js-form_search', function (e) {
            e.preventDefault();
            if (!$('#js_date').val()) {
                show_toast_alert({
                    heading : 'Error',
                    message : 'Please select date!',
                    type    : 'error'
                });
                return;
            }
            fetch_data();
        });

        $('body').on('click', '#js-btn_print', function (e) {
            e.preventDefault()
            const js_date = $('#js_date').val();
           
            window.open("{{ route('finance.online_appointment.print') }}?js_date="+js_date, '', 'height=800,width=800')
            
        })


        $('body').on('click', '.btn_done', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var self = $(this);
                var rows= $('#myTable tbody tr').length;

                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want the status done?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.online_appointment.done') }}",
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
                                self.closest('tr').find('td').eq(4).replaceWith('<td><span class="label label-danger">Done</span></td>');
                                self.closest('tr').find('td').eq(5).replaceWith('<td><button disabled class="btn btn-primary btn_done"><i class="far fa-check-circle"></i> Already Done</button></td>');
                               
                                // $('tr').find('td').eq(3).text('changeMe');

                                if(rows == 0){
                                    var total_output = '';
                                    total_output +='<tr>';
                                    total_output +='<td colspan="5">There is no active appointment</td>';
                                    total_output +='</tr>';
                                    $('#myTable tbody').html(total_output);
                                }

                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '.btn_disapprove', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var self = $(this);
                var rows= $('#myTable tbody tr').length;

                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want it to disapprove?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.online_appointment.disapprove') }}",
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
                                self.closest('tr').remove();

                                if(rows == 0){
                                    var total_output = '';
                                    total_output +='<tr>';
                                    total_output +='<td colspan="5">There is no active appointment</td>';
                                    total_output +='</tr>';
                                    $('#myTable tbody').html(total_output);
                                }

                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '.btn-deactivate', function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want the entire schedule deactivated? This schedule will not appear to the student online appointment panel.', function(){  
                    $.ajax({
                        url         : "{{ route('finance.online_appointment.deactivate_date') }}",
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
                                
                                setTimeout(function(){
                                    location.reload();
                                }, 2000);
                                
                            }
                        }
                    });
                }, function(){  

                });
            });
        
       
        $(function () {            
            $('body').on('click', '.btn-disapprove-modal', function (e) {
                e.preventDefault();
                 
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('finance.student_acct.modal') }}",
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