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

        $('.js-question_setup').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul']],
                ['insert', ['table','link','picture']],
                ['view', ['fullscreen', 'help']
            ],
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
                {{--  loader_overlay();  --}}
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('faculty.assessment_subject.edit', $ClassSubjectDetail->id) }}",
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
                            for (var err in res.res_error_msg)
                            {
                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                            }
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
                        }
                        else
                        {
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });
                            $('#js-question-form')[0].reset();
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
                            for (var err in res.res_error_msg)
                            {
                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                            }
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

            $('select[name="question_type"]').change(function(e){
                e.preventDefault();
                examType();
            })

            $('#btn-question-type-selected').click(function(e){
                e.preventDefault();
                examType();
            })

            function examType(){
                let question_type = $('select[name="question_type"]').val();
                if(question_type){
                    $('#btn-question-type-selected').addClass('d-none')    
                    $('#js-head-type').removeClass('d-none');
                    $('#js-question').removeClass('d-none');
                    let point_item = `<label for="points_per_question">Points this question:</label>
                                    <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">`;

                    // alert('ayaw')
                    if(question_type==1){
                        $('#exam_type_title').text('Multiple Choice');
                        $('#js_question_type').val(1);
                        $('#js-multiple-choice').removeClass('d-none')
                        $('#js-true-false').addClass('d-none')
                        $('#js-match').addClass('d-none')
                        $('.js-points').html(point_item);
                    }
                    if(question_type==2){
                        $('#exam_type_title').text('True/False');
                        $('#js_question_type').val(2);
                        $('#js-multiple-choice').addClass('d-none')
                        $('#js-true-false').removeClass('d-none')
                        $('#js-match').addClass('d-none')
                        $('.js-points').html(point_item);
                    }
                    if(question_type==3){
                        $('#exam_type_title').text('Matching');
                        $('#js_question_type').val(3);
                        $('#js-multiple-choice').addClass('d-none')
                        $('#js-true-false').addClass('d-none')
                        $('#js-match').removeClass('d-none')
                        $('.js-points').html(point_item);
                    }
                    if(question_type==4){
                        $('#exam_type_title').text('Ordering');
                        $('#js_question_type').val(4);
                        $('#js-multiple-choice').addClass('d-none')
                        $('#js-true-false').addClass('d-none')
                        $('#js-match').addClass('d-none')
                    }
                    if(question_type==5){
                        $('#exam_type_title').text('Fill in the Blank Text');
                        $('#js_question_type').val(5);
                        $('#js-multiple-choice').addClass('d-none')
                        $('#js-true-false').addClass('d-none')
                        $('#js-match').addClass('d-none')
                    }
                    if(question_type==6){
                        $('#exam_type_title').text('Short Answer/Essay');
                        $('#js_question_type').val(6);
                        $('#js-multiple-choice').addClass('d-none')
                        $('#js-true-false').addClass('d-none')
                        $('#js-match').addClass('d-none')
                    }
                    
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