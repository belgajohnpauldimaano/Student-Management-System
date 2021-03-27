@extends('control_panel.layouts.master')

@section ('content_title')
    Assessment | {{ $ClassSubjectDetail->classDetail->grade->id . '-' .$ClassSubjectDetail->classDetail->section->section }}
@endsection

@section ('content')
    <div class="card">
        <div class="col-md-12">
            <a href="{{ route('faculty.assessment') }}" style="margin-top: -3em" class="btn-success btn btn-sm float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header p-2">
            <h5 class="float-right pt-2 pr-2">
                Subject: <span class="text-red"><i>{{ $ClassSubjectDetail->subject->subject }}</i></span>
            </h5>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'unpublished' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject', [encrypt($ClassSubjectDetail->id), 'tab' => 'unpublished']) }}" >
                        Unpublished
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'published' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject', [encrypt($ClassSubjectDetail->id), 'tab' => 'published']) }}" >
                        Published
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'archived' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject', [encrypt($ClassSubjectDetail->id), 'tab' => 'archived']) }}" >
                        Archived
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
                                    <input type="text" class="form-control form-control-sm" name="search">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-success">Search</button>
                                <a href="#" type="button" class="btn btn-sm btn-danger" id="js-button-add">
                                    <i class="fa fa-plus"></i> Create
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="card-body">
            <div class="tab-content">
                {{-- <div class="{{ $tab ? $tab == 'unpublished' ? 'active' : '' : '' }} tab-pane">                     --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="js-data-container">
                                @include('control_panel_faculty.assessment_per_subject.partials.data_list')
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
                {{-- <!-- /.tab-pane -->
                <div class="{{ $tab ? $tab == 'published' ? 'active' : '' : '' }} tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="js-data-container">
                                @include('control_panel_faculty.assessment_per_subject.partials.data_list')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="{{ $tab ? $tab == 'archived' ? 'active' : '' : '' }} tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="js-data-container">
                                @include('control_panel_faculty.assessment_per_subject.partials.data_list')
                            </div>
                        </div>
                    </div>
                </div> --}}
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script>
        
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            
            $.ajax({
                url : "{{ route('faculty.assessment_subject', encrypt($ClassSubjectDetail->id) ) }}",
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

            $('body').on('click', '#js-button-add, .js-btn_update_sy', function (e) {
                e.preventDefault();
                
                loader_overlay();
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('faculty.assessment_subject.modal_data', $ClassSubjectDetail->id) }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('#js-loader-overlay').addClass('d-none')
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.select2').select2();
                        $('#publishdatetime, #expdatetime').datetimepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd hh:ii'
                        })
                        // $('#summernote').summernote()
                        $('#summernote').summernote({
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'italic', 'underline', 'clear']],
                                ['para', ['ul']],
                                ['insert', ['table','link', 'video', 'picture']],
                                ['view', ['fullscreen', 'help']
                            ],
                            // ['codeview']
                            ],
                            height: 100,
                            codemirror: {
                            theme: 'monokai'
                            },
                            placeholder: 'write here...',
                            spellCheck: true
                        });
                    }
                });
            });


            $('body').on('submit', '#js-assessment-create-form', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                loader_overlay();
                $.ajax({
                    url         : "{{ route('faculty.assessment_subject.save_data', $ClassSubjectDetail->id) }}",
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
                            loader_overlay();
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });
                            // var loc = window.location;
                            let slug = res.data;
                            let url = "{{ route('faculty.assessment_subject.edit', ":slug") }}";
                            url = url.replace(':slug', slug);
                            window.location.href=url;
                            
                            $('#js-loader-overlay').addClass('d-none')
                            $("#create-assessment-modal").modal('hide');

                           
                            // fetch_data();
                        }
                    }
                });
            });

            $('body').on('click', '.js-btn_archived', function (e) {
                e.preventDefault();
                var self = $(this);
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-sm btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to move this to archive?', function(){  
                    $.ajax({
                        url         : "{{ route('faculty.assessment.archive') }}",
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
                                // fetch_data();
                                // location.reload();
                                self.closest('tr').remove();
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '.js-btn-publish', function (e) {
                e.preventDefault();
                var self = $(this);
                let id = $(this).data('id');
                let type = $(this).data('type');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-sm btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to mark this as '+type+'?', function(){  
                    $.ajax({
                        url         : "{{ route('faculty.assessment.publish') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', id : id, type : type },
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
                               
                                // fetch_data();
                                self.closest('tr').remove();
                                // location.reload();
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '.js-btn_delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-sm btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to delete this question?', function(){  
                    $.ajax({
                        url         : "{{ route('faculty.question.delete', $ClassSubjectDetail->id) }}",
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
                                // location.reload();
                                // fetch_data();
                            }
                        }
                    });
                }, function(){  

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
                alertify.defaults.theme.ok = "btn btn-sm btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to deactivate?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.maintenance.disc_fee.deactivate_data') }}",
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
                alertify.defaults.theme.ok = "btn btn-sm btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-sm btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to '+toggle_title+' ?', function(){  
                    $.ajax({
                        url         : "{{ route('finance.maintenance.disc_fee.toggle_current_sy') }}",
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