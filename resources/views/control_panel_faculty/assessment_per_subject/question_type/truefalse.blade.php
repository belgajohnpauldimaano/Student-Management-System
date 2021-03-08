<div id="js-true-false">
    <div class="form-group">
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