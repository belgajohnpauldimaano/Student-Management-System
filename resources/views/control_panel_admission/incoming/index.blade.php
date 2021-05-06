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
                        Pending Approval
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
                        Rejected
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-header">
                <div class="col-md-9 m-auto">
                    <h6 class="box-title">Search</h6>
                    <form id="js-form_search">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group input-school_year p-0">
                                    <select name="school_year" id="school_year" class="form-control form-control-sm">                            
                                        <option value="0">
                                            - Select School Year -
                                        </option>
                                        @foreach ($School_years as $item)
                                            <option value="{{ $item->id }}">{{ $item->school_year }}</option>
                                        @endforeach      
                                    </select>
                                    <div class="help-block text-red text-left" id="js-school_year"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
            </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="js-data-container">
                            @if($tab == 'approved')
                                <a href="{{ route('export_excel.excel.admission') }}" class="btn btn-success" style="margin-bottom: -4em">
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

        function countIncomingStudent(incomingCount)
        {
            var totalCount = parseFloat(incomingCount - 1);
            console.log(totalCount)
            if(totalCount > 0){
                $('.js-incoming_stud').empty();
                $('.js-incoming_stud').append(totalCount);
            }
            if(totalCount <= 0){
                $('.js-incoming_stud').addClass('d-none');
            }
        }
        
        $('body').on('click', '.btn-approve', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want to approve?', function(){  
                    loader_overlay();
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
                                loader_overlay();
                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                $('.js-modal_holder .modal').modal('hide');
                                
                                var incomingCount = res.count;
                                countIncomingStudent(incomingCount);
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
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify.defaults.theme.cancel = "btn btn-danger";
                alertify.confirm('Confirmation', 'Are you sure you want to disapprove?', function(){  
                    loader_overlay();
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
                                loader_overlay();
                                $('.js-modal_holder .modal').modal('hide');
                                var incomingCount = res.count;
                                countIncomingStudent(incomingCount);
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

        $('body').on('click', '.btn-print', function (e) {
            e.preventDefault()
            var id = $(this).data('id');
            var tab = '{{ $tab }}';
            window.open("{{ route('admission.incoming.print') }}?id="+id+"&tab="+tab, '', 'height=800,width=800')
        })

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