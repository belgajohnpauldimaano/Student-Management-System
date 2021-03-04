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
        <option value="1">Multiple Choice</option>
        <option value="2">True/False</option>
        <option value="3">Matching</option>
        <option value="4">Ordering</option>
        <option value="5">Fill in the Blank Text</option>
        <option value="6">Short Answer/Essay</option>
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
        
        <div class="card">
            <div id="js-head-type" class="d-none">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Exam Type: <span id="exam_type_title">Multiple Choice</span>
                    </h3>
                    <div class="card-tools"></div>
                </div>
            </div>
            
            <!-- /.card-header -->
            <div id="js-question" class="d-none">
                <div class="card-body">
                    <input type="hidden" id="js_question_type" name="js_question_type">

                    <div class="form-group">
                        <label for="summernote">Question</label>
                        <textarea name="question" class="js-question_setup"></textarea>
                        <div class="help-block text-red" id="js-question"></div>
                    </div>
                    
                    <div id="js-multiple-choice" class="d-none">
                        <div class="form-group">
                            <p>Options</p>
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
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger" id="btn-add-option-multiple">
                            <i class="fas fa-plus"></i> Add Option
                        </button>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class='js-points'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- matching type --}}
                    <div id="js-match" class="d-none">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Question</th>
                                        <th>Answer</th>
                                    </tr>
                                </thead>
                            </table>
                            <ul class="todo-list" data-widget="todo-list">
                                <li>
                                    <div class="input-group">
                                        <span class="handle mt-1">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>                       
                                        <input type="text" class="form-control form-control-sm" name="matching_options[]">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" name="matching_answer[]">
                                    </div>
                                </li>
                                <li>
                                    <div class="input-group">
                                        <span class="handle mt-1">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>                       
                                        <input type="text" class="form-control form-control-sm" name="matching_options[]">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" name="matching_answer[]">
                                    </div>
                                </li>
                                <li>
                                    <div class="input-group">
                                        <span class="handle mt-1">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>                       
                                        <input type="text" class="form-control form-control-sm" name="matching_options[]">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" name="matching_answer[]">
                                    </div>
                                </li>
                                <li>
                                    <div class="input-group">
                                        <span class="handle mt-1">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>                       
                                        <input type="text" class="form-control form-control-sm" name="matching_options[]">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" name="matching_answer[]">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <div class='js-points'></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div id="js-true-false" class="d-none">
                    <div class="form-group pl-3 pr-3">
                        <div class="row">
                            <div class="col-md-12 pb-2">
                                <a href="{{ route('faculty.question.archiveIndex', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" 
                                    class="btn-primary btn btn-sm">
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
                                   <div class='js-points'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>
            
        </div>
        
                
    </form>
</div>