@extends('control_panel.layouts.master')

@section ('styles') 

@endsection

@section ('content_title')
    Appointee List
@endsection

@section ('content')
    <div class="box">
        <div class="box-header with-border">
            <div class="form-group col-sm-12">
                <h3 class="box-title">Filter</h3>
            </div>
            <form id="js-form_search">
                {{ csrf_field() }}    
                {{-- <div class="form-group col-sm-12 col-md-3" style="padding-right:0">
                    <select name="js_status" id="js_status" class="form-control js_status">
                        <option value="">--Select Status--</option>
                        <option value="1"> Active</option>
                        <option value="0"> Inactive</option>
                    </select>
                </div>              --}}
                <div class="form-group col-sm-12 col-md-3" style="padding-right:0">
                    <select name="js_date" id="js_date" class="form-control js_date">
                        <option value="">Select Date and time</option>
                        @foreach ($date_time as $data)
                            <option value="{{ $data->id }}"> {{ $data ? date_format(date_create($data->date), 'F d, Y h:i A') : '' }}</option>
                        @endforeach
                    </select>
                </div> 
                &nbsp;
                <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">            
            <div class="js-data-container"></div>            
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


        $('body').on('click', '.btn_done', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var self = $(this);
                var rows= $('#myTable tbody tr').length;

                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
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
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
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
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
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