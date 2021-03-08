@extends('control_panel.layouts.master')

@section ('content_title')
    Assessment | {{ $ClassSubjectDetail->classDetail->grade->id . '-' .$ClassSubjectDetail->classDetail->section->section }}
@endsection

@section ('content')
    <div class="card card-default">
        <div class="col-md-12">
            <a href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" style="margin-top: -3em" class="btn-success btn float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
            <div class="">
                <a href="{{ route('faculty.question.archiveIndex', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" style="margin-top: 0em" class="btn-primary btn float-right">
                    <i class="fas fa-archive"></i> Archived
                </a>
                <h5 class="box-title">Questions for Subject: <span class="text-red"><i>{{ $ClassSubjectDetail->subject->subject }}</i></span></h5>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        <p>Time: {{ $Assessment->time_limit }} mins</p>
                        <table class="table table-condensed table-hover">
                            <tbody>
                                {{-- <ol> --}}
                                    @forelse ($instructions as $key => $data)
                                        <tr>
                                            <td style="width: 7%"><b>Part {{ $key+1 }}:</b></td>
                                            <td colspan="2">{!! $data->instructions !!}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    {{-- <button type="button" class="btn btn-danger"><i class="fas fa-cog"></i></button> --}}
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span><i class="fas fa-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('faculty.instruction.edit',  [encrypt($data->id), 'tab' => 'instruction']) }}" class="dropdown-item" data-id="{{ $data->id }}">
                                                            <i class="far fa-eye"></i> Edit
                                                        </a>
                                                        <a href="#" class="dropdown-item" data-id="{{ $data->id }}">
                                                            <i class="far fa-check-square"></i> Publish
                                                        </a>
                                                        <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">
                                                            <i class="fas fa-archive"></i> Archive
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach ($data->questions as $key => $item)
                                                <tr>
                                                    <td></td>
                                                    <td style="width: 5%">{{ $key+1 }}.)</td>
                                                    <td> 
                                                        {!! $item->question_title !!} 
                                                        
                                                        @if($data->question_type == 3)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <hr>
                                                                    <p><b>List of option: <i class="text-red">(drag it to List of your answer)</i></b></p>
                                                                    <div class="row">
                                                                        @foreach ($item->answerMatching as $key => $match)
                                                                            <section class="connectedSortable">
                                                                                <div class="col-md-12">
                                                                                    <div class="card">
                                                                                        <div class="card-header">
                                                                                            <h3 class="card-title">
                                                                                                {{ $match->correct_option_answer }}
                                                                                            </h3>
                                                                                            <input type="hidden" name="match_options[{{ $item->id }}]" value="{{ $data->correct_option_answer }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><b>List of question:</b></p>
                                                                    <ol>
                                                                    @foreach ($item->options as $key => $option)
                                                                        <div class="form-group clearfix mt-3">
                                                                            <li>
                                                                                {{ $option->option_title }}<br/>
                                                                                <i class="text-red">
                                                                                    <small>({{ $item->answerMultipleChoice->points_per_question }} point {{ $item->answerMultipleChoice->points_per_question > 1 ? 's' : '' }} )</small>
                                                                                </i>
                                                                            </li>
                                                                        </div>
                                                                    @endforeach
                                                                    </ol>
                                                                </div>
                                                                <div class="col-md-6 ui-sortable-placeholder sort-highlight">
                                                                    <p><b>List of your answer:</b></p>
                                                                    
                                                                    <section class="connectedSortable">
                                                                        @foreach ($item->answerMatching as $key => $match)
                                                                            <div class=""></div>
                                                                        @endforeach
                                                                    </section>
                                                                    
                                                                </div>
                                                            </div>
                                                        @elseif($data->question_type == 4)
                                                            <div class="row">
                                                                <hr>
                                                                <p><b>List of option: <i class="text-red">(drag it to List of your answer)</i></b></p>
                                                                <div class="col-md-12 connectedSortable">
                                                                    @foreach ($item->answerMatching as $key => $match)
                                                                            <section class="">
                                                                                <div class="card">
                                                                                    <div class="card-header">
                                                                                        <h3 class="card-title">
                                                                                            {{ $match->correct_option_answer }}
                                                                                        </h3>
                                                                                        <input type="hidden" name="match_options[{{ $item->id }}]" value="{{ $data->correct_option_answer }}">
                                                                                    </div>
                                                                                </div>
                                                                            </section>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @else
                                                            <i class="text-red">
                                                                <small>({{ $item->answerMultipleChoice->points_per_question }} point {{ $item->answerMultipleChoice->points_per_question > 1 ? 's' : '' }} )</small>
                                                            </i>
                                                            @foreach ($item->options as $key => $option)
                                                                <div class="form-group clearfix mt-3">
                                                                    <div class="icheck-{{ $item->answerMultipleChoice->correct_option_answer == $key+1 ? 'success' : 'danger' }} d-inline">
                                                                        <input type="radio" {{ $item->answerMultipleChoice->correct_option_answer == $key+1 ? 'checked' : '' }} name="options_answer[{{ $item->id }}]" id="option-{{ $option->id }}" value="{{ $option->order_number }}">
                                                                        <label for="option-{{ $option->id }}">
                                                                            {{ $option->option_title }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            {{-- <button type="button" class="btn btn-success"><i class="fas fa-cog"></i></button> --}}
                                                            <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                <i class="fas fa-cog"></i><span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="{{ route('faculty.question.edit', [encrypt($item->id), 'tab' => 'questions']) }}" class="dropdown-item">
                                                                    <i class="far fa-eye"></i> Edit
                                                                </a>
                                                                <a href="#" class="dropdown-item js-btn_archived" data-id="{{ $item->id }}">
                                                                    <i class="fas fa-archive"></i> Move to Archive
                                                                </a>
                                                                <a href="#" class="dropdown-item js-btn_delete" data-id="{{ $item->id }}">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                <a class="btn btn-outline-primary" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'questions', 'question' => $data->question_type]) }}">
                                                    <i class="fas fa-plus"></i> Add Question
                                                </a>
                                            </th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th class="text-center">Record Not Found</th>
                                        </tr>
                                    @endforelse
                                {{-- </ol> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
<script src="{{ asset('cms-new/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script>
        
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            
            $.ajax({
                url : "{{ route('faculty.assessment_subject', $ClassSubjectDetail->id) }}",
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

            $('.js-assessment-subject').click(function (){
                $('#js-assessment-subject-container').addClass('d-none');
            });

            $('body').on('click', '#js-button-add, .js-btn_update_sy', function (e) {
                e.preventDefault();
                {{--  loader_overlay();  --}}
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('faculty.assessment_subject.modal_data', $ClassSubjectDetail->id) }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
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


            $('body').on('click', '.js-btn_view', function (e) {
                e.preventDefault();
                // alert('je;;')
                var id = $(this).data('id');
                // alert(id)
                $.ajax({
                    url : "{{ route('faculty.assessment_subject.edit', $ClassSubjectDetail->id) }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        var loc = window.location;
                        window.location = loc.protocol+"//"+loc+"/faculty/home";
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

            $('body').on('click', '.js-btn_archived', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to move this to archive?', function(){  
                    $.ajax({
                        url         : "{{ route('faculty.question.archive', $ClassSubjectDetail->id) }}",
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
                                location.reload();
                                // $(this).closest("tr").remove();
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
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
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
                                location.reload();
                                // fetch_data();
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