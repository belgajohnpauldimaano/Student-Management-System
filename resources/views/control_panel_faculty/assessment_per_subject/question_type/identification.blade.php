<div id="js-identification">
    <div class="row" id="identification">
        <div class="identification col-md-12">
            <div class="form-group" id="question_identification">
                <label for="summernote">Question Setup</label>
                <textarea name="question_identification[]" class="js-question_identification"></textarea>
                <div class="help-block text-red" id="js-question_identification"></div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <label for="answer_identification">Answer:</label>
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
                <div class="col-md-4">
                    <label for="">Answer is case sensitive:</label>
                    <div class="form-group clearfix">
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="case_sensitive" id="case_sensitive_yes" value="1">
                            <label for="case_sensitive_yes">
                                Yes
                            </label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input type="radio" name="case_sensitive" id="case_sensitive_no" value="0">
                            <label for="case_sensitive_no">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <button type="button" class="btn btn-sm btn-sm btn-outline-danger" id="btn-add-option-identification">
        <i class="fas fa-plus"></i> Add Question
    </button>
    <hr>
</div>