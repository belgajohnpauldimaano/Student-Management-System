<div class="float-right" style="margin-top: -.5em">
    @if($Assessment != null)
        <a href="{{ route('faculty.question', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" class="btn btn-info">
            <i class="far fa-eye fa-lg"></i> Preview
        </a>
    @endif
</div>

<h5>Create Items</h5>
<hr>
<div class="form-group form-group-sm w-100 pb-5">
    <label>Select Exam Type:</label>
    <select class="form-control form-control-sm" name="question_type" style="width: 100%;">
        <option value="1" {{ $question == null ? '' : $question =='1' ? 'selected' : ''  }}>Multiple Choice</option>
        <option value="2" {{ $question == null ? '' : $question =='2' ? 'selected' : ''  }}>True/False</option>
        <option value="3" {{ $question == null ? '' : $question =='3' ? 'selected' : ''  }}>Matching</option>
        <option value="4" {{ $question == null ? '' : $question =='4' ? 'selected' : ''  }}>Ordering</option>
        <option value="5" {{ $question == null ? '' : $question =='5' ? 'selected' : ''  }}>Fill in the Blank Text or Identification</option>
        <option value="6" {{ $question == null ? '' : $question =='6' ? 'selected' : ''  }}>Short Answer/Essay</option>
    </select>
    <div class="help-block text-red" id="js-question_type"></div>
    <div class="mt-1 float-right">
        <button type="button" id="btn-question-type-selected" class="btn btn-primary">
            <i class="far fa-hand-pointer fa-lg"></i> Select
        </button>
    </div>
</div>



<div id="multiple-choice mt-3" >
    <form id="js-question-form">
        {{ csrf_field() }}
        @if($Assessment != null)
            <input type="hidden" name="id" value="{{ $Assessment->id }}">
        @endif

        @if($question=='1' || $question=='2' || $question=='3' || $question=='4' || $question=='5' || $question=='6')
            <div class="card">
                <div id="js-head-type">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Exam Type: <span id="exam_type_title">Multiple Choice</span>
                        </h3>
                        <div class="card-tools"></div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div>
                    <div class="card-body">
                        <input type="hidden" id="js_question_type" name="js_question_type" value="{{ $question }}">

                        <div class="form-group" id="question_setup">
                            <label for="summernote">Question Setup</label>
                            <textarea name="question" class="js-question_setup"></textarea>
                            <div class="help-block text-red" id="js-question"></div>
                        </div>

                        {{-- multiple-choice --}}
                        @if($question=='1')
                        <div id="js-multiple-choice" >
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Options</th>
                                            <th class="text-right">Answer</th>
                                        </tr>
                                    </thead>
                                </table>
                                <ul class="todo-list" id="multiple-choice" data-widget="todo-list">
                                    <li class="li-row">
                                        <div class="input-group">
                                            <span class="handle mt-1">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm" name="options[]">
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="multiple_answer" id="options1" value="1">
                                                <label for="options1"></label>
                                            </div>
                                            <div class="tools p-1">
                                                <i class="fas fa-times-circle fa-lg delete-multiple-item"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li-row">
                                        <div class="input-group">
                                            <span class="handle mt-1">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm" name="options[]">
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="multiple_answer" id="options2" value="2">
                                                <label for="options2"></label>
                                            </div>
                                            <div class="tools p-1">
                                                <i class="fas fa-times-circle fa-lg delete-multiple-item"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li-row">
                                        <div class="input-group">
                                            <span class="handle mt-1">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm" name="options[]">
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="multiple_answer" id="options3" value="3">
                                                <label for="options3"></label>
                                            </div>
                                            <div class="tools p-1">
                                                <i class="fas fa-times-circle fa-lg delete-multiple-item"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li-row">
                                        <div class="input-group">
                                            <span class="handle mt-1">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-sm" name="options[]">
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="multiple_answer" id="options4" value="4">
                                                <label for="options4"></label>
                                            </div>
                                            <div class="tools p-1">
                                                <i class="fas fa-times-circle fa-lg delete-multiple-item"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="help-block text-red" id="js-multiple_answer"></div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="btn-add-option-multiple">
                                <i class="fas fa-plus"></i> Add Option
                            </button>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class='js-points'>
                                                <label for="points_per_question">Points this question:</label>
                                                <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- matching type --}}
                        @if($question=='3')
                        <div id="js-match">
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Question</th>
                                            <th>Answer</th>
                                        </tr>
                                    </thead>
                                </table>
                                <ul class="todo-list" id="match" data-widget="todo-list">
                                    <li class="li-row">
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
                                    </li>
                                    <li class="li-row">
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
                                    </li>
                                    <li class="li-row">
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
                                    </li>
                                    <li class="li-row">
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
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="btn-add-option-match">
                                <i class="fas fa-plus"></i> Add Option
                            </button>
                            <hr>
                            <div class="col-md-3">
                                <div class="form-group">
                                <div class='js-points'>
                                        <label for="points_per_question">Points this question:</label>
                                        <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        @endif

                        {{-- ordering --}}
                        @if($question=='4')
                        <div id="js-ordering">
                            <div class="form-group">
                                <p>Options: <i class="text-red"><small>This options is auto random in student panel, please re-order it from top to last</small></i></p>
                                <ul class="todo-list" id="ordering" data-widget="todo-list">
                                    <li class="li-row">
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
                                    </li>
                                    <li class="li-row">
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
                                    </li>
                                    <li class="li-row">
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
                                    </li>
                                    <li class="li-row">
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
                                    </li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="btn-add-option-ordering">
                                <i class="fas fa-plus"></i> Add Option
                            </button>
                            <hr>
                            <div class="col-md-3">
                                <div class="form-group">
                                <div class='js-points'>
                                        <label for="points_per_question">Points this question:</label>
                                        <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        @endif

                        {{-- fill in the blanks or identification --}}
                        @if($question=='5')
                            <div id="js-identification" class="d-none">
                                <div class="row" id="identification">
                                    <div class="form-group col-md-12" id="js-question_identification">
                                        <label for="summernote">Question Setup</label>
                                        <textarea name="question_identification[]" class="js-question_identification"></textarea>
                                        <div class="help-block text-red" id="js-question_identification"></div>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="answer_identification">Answer:</label>
                                        <input type="number" class="form-control form-control-sm" id="answer_identification" name="answer_identification">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <div class='js-points'>
                                                    <label for="points_per_question">Points this question:</label>
                                                    <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <button type="button" class="btn btn-sm btn-outline-danger" id="btn-add-option-identification">
                                    <i class="fas fa-plus"></i> Add Question
                                </button>
                                <hr>
                            </div>                
                        @endif

                        {{-- essay --}}
                        @if($question=='6')
                        <div id="js-essay">
                            <div class="form-group pl-3 pr-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="js-character_limit">Word Limit:</label>
                                        <input type="number" class="form-control form-control-sm" id="js-character_limit" name="character_limit" value="400">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <div class='js-points'>
                                                    <label for="points_per_question">Points this question:</label>
                                                    <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- true or false --}}
                        @if($question=='2')
                            <div id="js-true-false">
                                <div class="form-group pl-3 pr-3">
                                    <div class="row">
                                        <div class="col-md-12 pb-2">
                                            <a href="{{ route('faculty.question.archiveIndex', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" 
                                                class="btn-outline-primary btn btn-sm">
                                                <i class="fas fa-cog"></i> Change the default text for true and false
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="true">Text for "true": *</label>
                                                <input type="text" class="form-control form-control-sm" id="true" name="true_or_false_options[]" value="True">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="false">Text for "false": *</label>
                                                <input type="text" class="form-control form-control-sm" id="false" name="true_or_false_options[]" value="False">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Correct Answer:</label>
                                            <select class="form-control form-control-sm" name="true_or_false_options_answer" style="width: 100%;">
                                                <option value="1">True</option>
                                                <option value="2">False</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <div class='js-points'>
                                                    <label for="points_per_question">Points this question:</label>
                                                    <input type="number" class="form-control form-control-sm" id="points_per_question" name="points_per_question" value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>