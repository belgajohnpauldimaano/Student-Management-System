@extends('control_panel.layouts.master')

@section ('content_title')
  {{ $Assessment != null ? 'Edit' : 'Create' }} Assessment | {{ $ClassSubjectDetail->classDetail->grade->id . '-' .$ClassSubjectDetail->classDetail->section->section }}
@endsection

@section ('content')
    <div class="card">
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="col-md-12">
            <a href="{{ route('faculty.assessment_subject', [encrypt($ClassSubjectDetail->id), 'tab' => $Assessment->assessment_status ] ) }}" style="margin-top: -3em" class="btn-success btn float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link {{ $tab ? $tab == 'setup' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'setup']) }}" >Settings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $tab ? $tab == 'instruction' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'instruction']) }}">Instruction</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $tab ? $tab == 'questions' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'questions']) }}">Question</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#grading" data-toggle="tab">Monitoring</a>
                </li>
                <li class="nav-item ml-auto dropdown">
                    <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fas fa-cog"></i> Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item js-btn-publish" data-id="{{ $Assessment->id }}" data-type="{{ $Assessment->exam_status == 1 ? 'unpublish' : 'publish' }}">
                            <i class="far fa-check-square"></i> Move to {{ $Assessment->exam_status == 1 ? 'Unpublish' : 'Publish' }}
                        </a>
                        @if($tab == 'archived')
                            <a href="#" class="dropdown-item js-btn-publish" data-id="{{ $Assessment->id }}" data-type="{{ $Assessment->exam_status == 1 ? 'unpublish' : 'publish' }}">
                                <i class="far fa-check-square"></i> Move to Unpublish
                            </a>
                        @else
                            <a href="#" class="dropdown-item js-btn_archived" data-id="{{ $Assessment->id }}">
                                <i class="fas fa-archive"></i> Move as Archive
                            </a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-setup {{ $tab ? $tab == 'setup' ? 'active' : '' : '' }} tab-pane" id="setup">
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_setup')
                </div>
                <!-- /.tab-pane -->
                <div class="{{ $tab ? $tab == 'instruction' ? 'active' : '' : '' }} tab-pane" id="instruction">
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_instruction')
                </div>

                <div class="{{ $tab ? $tab == 'questions' ? 'active' : '' : '' }} tab-pane" id="questions">
                    {{-- <form id="js-form_search">
                        {{ csrf_field() }}
                    </form> --}}
                    
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_question')
                    
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="grading">
                    
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('cms-new/dist/js/pages/dashboard.js') }}"></script>
    <script>
        $('.select2').select2();
        // $('.tab-setup').addClass('active')
        // $('.nav-setup').addClass('active')
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
                ['insert', ['table','link']],
                ['view', ['fullscreen', 'help']
            ],
            // ['codeview']
            ],
            height: 50,
            codemirror: {
            theme: 'monokai'
            },
            placeholder: 'Write here...',
            spellCheck: true
        });

        $('.js-question_setup, .js-question_identification').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul']],
                ['insert', ['table','link','picture']],
                ['view', ['fullscreen', 'help']],
            // ['codeview']
            ],
            height: 50,
            codemirror: {
            theme: 'monokai'
            },
            placeholder: 'Write here...',
            spellCheck: true,
            
        });

        $('.js-answer_option').summernote({
          airMode: true
        });

        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            
            $.ajax({
                
                url : "{{ route('faculty.assessment_subject.edit',encrypt($Assessment->id))}}",
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
                {{--  loader_overlay();  --}}
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('faculty.assessment_subject.edit', [$ClassSubjectDetail->id, 'tab' => $tab] ) }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        

                    }
                });
            });

            $('body').on('submit', '#js-assessment-create-form, #js-assessment-update-form', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
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
                        }
                    }
                });
            });

            // question save
            $('body').on('submit', '#js-question-form', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('faculty.question.save_data', $ClassSubjectDetail->id) }}",
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
                            
                           location.reload();
                            // fetch_data();
                        }
                    }
                });
            });
            // save instruction
            $('body').on('submit', '#js-instruction-form', function (e) {
                e.preventDefault();
                
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('faculty.instruction.save_data', encrypt($ClassSubjectDetail->id) ) }}",
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

                            let slug = res.data;
                            let url = "{{ route('faculty.question', ":slug") }}";
                            url = url.replace(':slug', slug);
                            window.location.href=url;                            
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
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
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
                                location.reload();
                                // self.closest('tr').remove();
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
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
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
                                // self.closest('tr').remove();
                                location.reload();
                            }
                        }
                    });
                }, function(){  

                });
            });

            $(document).on('change', 'select[name="question_type"]', function(e){
                e.preventDefault();
                examType();
            })

            $(document).on('click', '#btn-question-type-selected', function(e){
                e.preventDefault();
                examType();
            })

            // add button
            let btn=4;
            $('#btn-add-option-multiple').click(function(e){
                e.preventDefault();
                btn++;
                $('#multiple-choice').append(`<li class="li-row">
                    <div class="input-group">
                        <span class="handle mt-1">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                        </span>                       
                        <input type="text" class="form-control form-control-sm" name="options[]">
                        &nbsp;&nbsp;&nbsp;
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="multiple_answer" id="options`+btn+`" value="`+btn+`">
                            <label for="options`+btn+`"></label>
                        </div>
                        <div class="tools p-1">
                            <i class="fas fa-times-circle fa-lg delete-multiple-item"></i>
                        </div>
                    </div>
                </li>`);                
            })
            
            $(document).on('click', '.delete-multiple-item', function(){
                $(this).closest('.li-row').remove();
            })

            
            $('#btn-add-option-match').click(function(e){
                e.preventDefault();
                btn++;
                $('#match').append(`<li class="li-row">
                                    <div class="input-group">
                                        <span class="handle mt-1">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-sm" name="matching_options[]">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" name="matching_answer[]">
                                        <div class="tools p-1">
                                            <i class="fas fa-times-circle fa-lg delete-match-item"></i>
                                        </div>
                                    </div>
                                </li>`);                
            })
            
            $(document).on('click', '.delete-match-item', function(){
                $(this).closest('#match .li-row').remove();
            })

            $('#btn-add-option-ordering').click(function(e){
                e.preventDefault();
                btn++;
                $('#ordering').append(`<li class="li-row">
                                    <div class="input-group">
                                        <span class="handle mt-1">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-sm" name="ordering_option[]">
                                        &nbsp;&nbsp;
                                        <div class="tools p-1">
                                            <i class="fas fa-times-circle fa-lg delete-ordering-item"></i>
                                        </div>
                                    </div>
                                </li>`);                
            })
            
            $(document).on('click', '.delete-ordering-item', function(e){
                e.preventDefault();
                $(this).closest('#ordering .li-row').remove();
            })

           $('#btn-add-option-identification').click(function(e){
                e.preventDefault();
               
                $('#identification').append(`<div class="identification col-md-12">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="form-group" id="js-question_identification">
                                <div class="float-right">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete-entire-identification">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                                <label class="mt-3" for="summernote">Question Setup</label>
                                <textarea name="question_identification[]" class="js-question_identification"></textarea>
                                <div class="help-block text-red" id="js-question_identification"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="identification_answer">Answer:</label>
                                    <input type="text" class="form-control form-control-sm" id="identification_answer" name="identification_answer[]">
                                    <div class="help-block text-red" id="js-identification_answer"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class='js-points'>
                                            <label for="points_per_question">Points this question:</label>
                                            <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question[]" value="1">
                                            <div class="help-block text-red" id="js-points_per_question"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`);

                // var div = $('<div>').appendTo($("#js-question_field"));
                // div.class('js-question_setup').summernote();
                $(".js-question_identification").summernote({
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul']],
                        ['insert', ['table','link','picture']],
                        ['view', ['fullscreen', 'help']],
                    // ['codeview']
                    ],
                    height: 50,
                    codemirror: {
                    theme: 'monokai'
                    },
                    placeholder: 'Write here...',
                    spellCheck: true,
                    
                });
            })
            
            $(document).on('click', '.btn-delete-entire-identification', function(e){
                e.preventDefault();
                $(this).closest('#identification .identification').remove();
            })

            function examType(){
                loader_overlay();
                let question_type = $('select[name="question_type"]').val();
                if(question_type){
                    $('#btn-question-type-selected').addClass('d-none')
                    setTimeout(function(){
                        $('#js-loader-overlay').addClass('d-none')
                    },1000);

                    let url = "{{ route('faculty.assessment_subject.edit', encrypt($Assessment->id))}}?tab=questions&question="+question_type+"";
                    // url = url.replace(':slug', slug);
                    window.location.href=url;
                    
                    
                }
            }

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
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
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