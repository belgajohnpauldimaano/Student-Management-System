@extends('control_panel.layouts.master')

@section ('content_title')
    Assessment | {{ $ClassSubjectDetail->classDetail->grade->id . '-' .$ClassSubjectDetail->classDetail->section->section }}
@endsection

@section ('content')
    <div class="card card-default">
        <div class="col-md-12">
            <a href="{{ route('faculty.question', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" style="margin-top: -3em" class="btn-success btn float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
            <div class="">
                <h5 class="box-title">
                    Edit Question 
                    <span class="float-right">Question Type: 
                        <span class="text-red"><i>{{ $Question->question }}</i></span>
                    </span>
                </h5>
            </div>
        </div>
        <!-- /.card-header -->
        <form id="js-question-form">
                {{ csrf_field() }}
            <div class="card-body">
                @if($Assessment != null)
                    <input type="hidden" name="assessment_id" value="{{ $Assessment->id }}">
                @endif
                <input type="hidden" name="question_id" value="{{ $Question->id }}">
                <input type="hidden" name="js_question_type" value="{{ $Question->question_type }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="js-data-container">
                            <div class="form-group">
                                <label for="summernote">Question:</label>
                                <textarea name="question" class="js-question_setup">{!! $Question->question_title !!}</textarea>
                                <div class="help-block text-red" id="js-question"></div>
                            </div>
                        </div>
                        <div id="js-multiple-choice">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="2">Options</th>
                                        <th class="text-center">Correct Answer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Question->options as $key => $data)
                                        <tr>
                                            <td class="text-right">
                                                <b>Option {{ $key+1 }}</b>
                                            </td>
                                            <td width="80%">
                                                <input type="hidden" name="option_id[]" value="{{ $data->id }}">
                                                <input type="text" class="form-control form-control-sm " name="options[]" value="{{ $data->option_title }}">
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="form-group clearfix">
                                                    <input type="hidden" name="answer_option_id" value="{{ $Question->answerMultipleChoice->id }}">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" name="options_answer[]" {{ $Question->answerMultipleChoice->correct_option_answer == $key+1 ? 'checked' : '' }} id="option-{{ $data->id }}" value="{{ $key+1 }}">
                                                        <label for="option-{{ $data->id }}"></label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="points_per_question">Points this question:</label>
                                </div>
                                <div class="col-md-2">
                                    <input 
                                        type="number" 
                                        class="form-control form-control-sm" 
                                        id="points_per_question" 
                                        name="points_per_question" 
                                        value="{{ $Question->answerMultipleChoice->points_per_question }}"
                                    >
                                </div>
                                <div class="col-md-3">
                                    <small><i>Note: 0 point value for this question is not valid. </i></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix">
                <button type="submit" class="btn btn-danger float-right">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('cms-new/dist/js/pages/dashboard.js') }}"></script>
    <script>
        $('.js-question_setup').summernote({
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
                    }
                }
            });
        });
    </script>
@endsection