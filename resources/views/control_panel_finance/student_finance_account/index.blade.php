@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Student Account
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'not-paid' ? 'active' : '' : '' }}" 
                    href="{{ route('finance.student_acct', ['tab' => 'not-paid']) }}">Not Paid</a>
                </li>                                
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'paid' ? 'active' : '' : '' }}" 
                    href="{{ route('finance.student_acct', ['tab' => 'paid']) }}">Paid</a>
                </li>        
            </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">                
                <div class="table-responsive">
                    <div class="col-md-8 m-auto">
                        <h6 class="box-title">Search</h6>
                        <form id="js-form_search">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    {{-- <label class="control-label">- School year -</label> --}}
                                    <div class="input-school_year">
                                        <select name="school_year" id="school_year" class="form-control form-control-sm ">
                                            <option value="0">
                                                - School Year -
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </option>
                                            @foreach ($School_years as $item)
                                                @if($item->school_year != '2018-2019' && $item->school_year != '2019-2020')
                                                    <option value="{{ $item->id }}">{{ $item->school_year }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block text-red text-left" id="js-school_year">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div id="js-form_search" class="form-group" style="padding-left:0;padding-right:0">
                                        <input type="text" class="form-control form-control-sm" name="search">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-sm btn-success">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>                                
                    <div class="card-body">
                        <div class="js-data-container">                 
                            @include('control_panel_finance.student_finance_account.partials.data_list')
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
                url : "{{ route('finance.student_acct', ['tab' => $tab] ) }}",
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

            $('body').on('click', '.btn-paid', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-sm btn-primary";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want the status paid? <i style="color: red">Note: The account of student will be paid in the whole year</i>.', function(){  
                    $.ajax({
                        url         : "{{ route('finance.student_acct.paid') }}",
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

            $('body').on('click', '.btn-unpaid', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-sm btn-primary";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want the status unpaid?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.student_acct.unpaid') }}",
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
            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                fetch_data();
            });

            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data();
            });
                    
            $('body').on('click', '.btn-disapprove-modal', function (e) {
                e.preventDefault();
                 loader_overlay();
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('finance.student_acct.modal') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        loader_overlay();
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