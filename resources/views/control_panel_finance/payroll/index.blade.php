@extends('control_panel.layouts.master')

@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('cms-new/plugins/select2/css/select2.min.css') }}"> --}}
@endsection
@section ('content_title')
    Payroll
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <div class="col-md-8 m-auto">
                <h6 class="box-title">Filter</h6>
                <form id="js-form_search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            {{-- <div id="js-form_search" class="form-group" style="padding-left:0;padding-right:0">
                                <input type="text" class="form-control form-control-sm" name="search">
                            </div> --}}                            
                            <select name="search" id="search" class="form-control form-control-sm">
                                <option value="">Select Date</option>
                                @foreach ($payroll_dates as $data)
                                    <option value="{{ $data->payroll_date }}">{{ $data->payroll_date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Search</button>
                            <button type="button" class="btn btn-danger" id="js-button-add">
                                <i class="fa fa-plus"></i> Add
                            </button>
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
                        @include('control_panel_finance.payroll.partials.data_list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('cms-new/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('finance.payroll') }}",
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
            
            $('body').on('click', '#btn-upload-paroll', function (e) {
                e.preventDefault()
                $('#payroll').click()
            })
            $('body').on('change', '#payroll', function(e) {
                const val = e.target.value.split('\\')
                if (val.length > 1) {
                    $('#btn-upload-payroll').text(val[val.length - 1])
                } else {
                    $('#btn-upload-paryoll').text('Choose file')
                }
            })

            $('.select2').select2()

            $('body').on('click', '#js-button-add, .js-btn_update_sy', function (e) {
                e.preventDefault();
                
                var id = $(this).data('id'); 
                $.ajax({
                    url : "{{ route('finance.payroll.modal') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });

                        
                        if(!id){
                            $("#datepicker").datepicker().datepicker("setDate", new Date());
                        }
                        else{
                            $('#datepicker').datepicker(("setDate", new Date()));
                        }
                        

                        $('.select2').select2()

                        // get the data of employee
                        $('body').on('change', '#emp_category', function () {
                            $.ajax({
                                url : "{{ route('finance.payroll.employee_list') }}",
                                type : 'POST',
                                data        : {_token: '{{ csrf_token() }}', emp_category: $('#emp_category').val()},
                                success     : function (res) {

                                    $('#employee_name').html(res);
                                }
                            })
                        })
                        
                        
                    }
                });
            });
            
            $('body').on('submit', '#js-form_payroll', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('finance.payroll.save') }}",
                    type        : 'POST',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    success     : function (res) {
                        $('.help-block').html('');
                        if (res.res_code == 1)
                        {
                            for (var err in res.res_error_msg)
                            {
                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                            }
                        }
                        else
                        {
                            $('.js-modal_holder .modal').modal('hide');
                            fetch_data();
                        }
                    }
                });
            });

            $('body').on('click', '.js-btn_download', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var file = $(this).data('file');
                $.ajax({
                    url : "{{ route('finance.payroll.download_payroll') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id, file_name: file },
                    success : function (res) {
                        if (res.res_code == 1) {
                            show_toast_alert({
                                heading : 'Error',
                                message : res.res_msg,
                                type    : 'error'
                            });
                        } else {
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });
                            console.log(res)
                            window.location = res.file_path;
                        }
                    }
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
                        url         : "{{ route('finance.payroll.deactivate_data') }}",
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
            
            $('body').on('click', '.js-btn_toggle_current', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var toggle_title = $(this).data('toggle_title');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to '+toggle_title+' ?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.maintenance.tuition_fee.toggle_current_sy') }}",
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