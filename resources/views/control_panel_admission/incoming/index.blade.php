@extends('control_panel.layouts.master')

@section ('styles') 

@endsection

@section ('content_title')
    Incoming Student
@endsection

@section ('content')
    <div class="card">
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'not-yet-approved' ? 'active' : '' : '' }}" 
                        href="{{ route('admission.incoming', ['tab' => 'not-yet-approved']) }}" >
                        Not Yet Approved
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'approved' ? 'active' : '' : '' }}" 
                        href="{{ route('admission.incoming', ['tab' => 'approved']) }}" >
                        Approved
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'disapproved' ? 'active' : '' : '' }}" 
                        href="{{ route('admission.incoming', ['tab' => 'disapproved']) }}" >
                        Disapproved
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-header">
                <div class="col-md-8 m-auto">
                    <h6 class="box-title">Search</h6>
                    <form id="js-form_search">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-9">
                                <div id="js-form_search" class="form-group" style="padding-left:0;padding-right:0">
                                    <input type="text" class="form-control form-control-sm form-control form-control-sm" name="search">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="js-data-container">
                            @if($tab == 'approved')
                            <a href="{{ route('export_excel.excel.admission') }}" class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                            @endif
                            @include('control_panel_admission.incoming.partials.data_list')
                        </div>
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
                url : "{{ route('admission.incoming', ['tab' => $tab]) }}",
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

        // $('.nav-item').click(function(e){
        //     e.preventDefault();
        //     loader_overlay();
        //     setTimeout(
        //         function() 
        //         {
        //             $('#js-loader-overlay').addClass('d-none')
        //             fetch_data ()
        //         }, 
        //     500);
            
        // })

        $('body').on('click', '.btn-approve', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to approve?', function(){  
                    $.ajax({
                        url         : "{{ route('admission.incoming.approve') }}",
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

            $('body').on('click', '.btn-disapprove', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to disapprove?', function(){  
                    $.ajax({
                        url         : "{{ route('admission.incoming.disapprove') }}",
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
        
       
        $(function () {            
            $('body').on('click', '.btn-view-modal', function (e) {
                e.preventDefault();
                 
                var id = $(this).data('id');
                // var monthly_id = $(this).data('monthly_id');
                $.ajax({
                    url  : "{{ route('admission.incoming.modal') }}",
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

        $('body').on('submit', '#js-form_search', function (e) {
            e.preventDefault();
            fetch_data();
        });
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            page = $(this).attr('href').split('=')[1];
            fetch_data();
        });
        
    </script>
@endsection