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