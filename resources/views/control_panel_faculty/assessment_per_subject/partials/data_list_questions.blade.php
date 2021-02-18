<div class="float-right" style="margin-top: -.5em">
    <a href="{{ route('faculty.question', encrypt($Assessment->id) ) }}" class="btn btn-info">
        <i class="far fa-eye fa-lg"></i> Preview
    </a>
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
        <button type="button" class="btn btn-primary">
            <i class="far fa-save fa-lg"></i> Select
        </button>
    </div>
</div>

<div id="multiple-choice mt-5">
    <form id="js-question-form">
        {{ csrf_field() }}
        @if($Assessment != null)
            <input type="hidden" name="id" value="{{ $Assessment->id }}">
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Exam Type: Multiple Choice
                </h3>

                <div class="card-tools">
                
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <input type="hidden" name="js_question_type" value="multiple choice">
                <div class="form-group">
                    <label for="summernote">Question</label>
                    <textarea name="question" class="js-question_setup"></textarea>
                    <div class="help-block text-red" id="js-question"></div>
                </div>
                <div class="form-group">
                    <p>Options</p>

                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <div class="input-group">
                                <span class="handle mt-1">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>                       
                                <input type="text" class="form-control form-control-sm" name="options[]">
                            </div>
                        </li>
                        <li>
                            <div class="input-group">
                                <span class="handle mt-1">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>                       
                                <input type="text" class="form-control form-control-sm" name="options[]">
                            </div>
                        </li>
                        <li>
                            <div class="input-group">
                                <span class="handle mt-1">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>                       
                                <input type="text" class="form-control form-control-sm" name="options[]">
                            </div>
                        </li>
                        <li>
                            <div class="input-group">
                                <span class="handle mt-1">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>                       
                                <input type="text" class="form-control form-control-sm" name="options[]">
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="form-group">
                    <p>Correct Answer</p>

                    <div class="form-group clearfix">
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="options_answer" id="optionsA" value="A">
                            <label for="optionsA">
                                A
                            </label>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="options_answer" id="optionsB" value="B">
                            <label for="optionsB">
                                B
                            </label>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="options_answer" id="optionsC" value="C">
                            <label for="optionsC">
                                C
                            </label>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="options_answer" id="optionsD" value="D">
                            <label for="optionsD">
                                D
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-danger float-right"><i class="fas fa-plus"></i> Save</button>
                </div>
            </div>
        </div>
                
    </form>
</div>