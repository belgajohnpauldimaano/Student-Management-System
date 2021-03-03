<form id="js-{{ $Assessment != null ? 'assessment-update-form' : 'assessment-create-form' }}">
    {{ csrf_field() }}
    @if ($ClassSubjectDetail)
        <input type="hidden" name="class_subject_details_id" value="{{ $ClassSubjectDetail->id }}">
    @endif

    @if($Assessment != null)
        <input type="hidden" name="id" value="{{ $Assessment->id }}">
    @endif
    
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-9">
                    <label for="">Title</label>
                    <input type="text" class="form-control form-control-sm" name="title" value="{{ $Assessment != null ? $Assessment->title : '' }}">
                    <div class="help-block text-red" id="js-title">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-group-sm w-100">
                        <label>Exam Period</label>
                        <select class="form-control form-control-sm" name="exam_period" style="width: 100%;">
                            <option value="1" {{ $Assessment != null ? ($Assessment->period == 1 ? 'selected' : '') : '' }}>Prelim</option>
                            <option value="2" {{ $Assessment != null ? ($Assessment->period == 2 ? 'selected' : '') : '' }}>Midterm</option>
                            <option value="3" {{ $Assessment != null ? ($Assessment->period == 3 ? 'selected' : '') : '' }}>Final</option>
                        </select>
                    </div>
                    <div class="help-block text-red" id="js-exam_period">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Publish Date and Time: </label>
                    <div class="input-group date">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        </div>
                        <input type="text" name="publish_date_time" class="form-control form-control-sm pull-right"  
                        data-date-format="yyyy-mm-dd hh:ii" id="publishdatetime" value="{{ $Assessment != null ? $Assessment->date_time_publish : '' }}">
                    </div>
                    <div class="help-block text-red" id="js-publish_date_time">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Expiry Date and Time: </label>
                    <div class="input-group date">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        </div>
                        <input type="text" name="exp_date_time" class="form-control form-control-sm pull-right" 
                        data-date-format="yyyy-mm-dd hh:ii" id="expdatetime" value="{{ $Assessment != null ? $Assessment->date_time_expiration : '' }}">
                    </div>
                    <div class="help-block text-red" id="js-exp_date_time">
                    </div>
                </div>
                @if($ClassSubjectDetail->classDetail->grade->id > 10)
                <div class="col-md-3">
                    <div class="form-group form-group-sm w-100">
                        <label>Semester Period:</label>
                        <select class="form-control form-control-sm" name="semester_period" style="width: 100%;">
                            <option value="1" {{ $Assessment != null ? ($Assessment->semester == 1 ? 'selected' : '') : '' }}>1st semester</option>
                            <option value="2" {{ $Assessment != null ? ($Assessment->semester == 2 ? 'selected' : '') : '' }}>2nd semester</option>
                        </select>
                    </div>
                    <div class="help-block text-red" id="js-semester_period"></div>
                </div>
                @endif
                <div class="col-md-3">
                    <div class="form-group form-group-sm w-100">
                        <label>Quarter Period:</label>
                        <select class="form-control form-control-sm" name="quarter_period" style="width: 100%;">
                            <option value="1" {{ $Assessment != null ? ($Assessment->quarter == 1 ? 'selected' : '') : '' }}>1st quarter</option>
                            <option value="2" {{ $Assessment != null ? ($Assessment->quarter == 2 ? 'selected' : '') : '' }}>2nd quarter</option>
                            @if($ClassSubjectDetail->classDetail->grade->id < 11)
                            <option value="3" {{ $Assessment != null ? ($Assessment->quarter == 3 ? 'selected' : '') : '' }}>3rd quarter</option>
                            <option value="4" {{ $Assessment != null ? ($Assessment->quarter == 4 ? 'selected' : '') : '' }}>4th quarter</option>
                            @endif
                        </select>
                        <div class="help-block text-red" id="js-quarter_period"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>

    <div class="form-group">
         <h5>Assessment Settings</h5>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="">Questions are randomly ordered:</label>
                <div class="form-group clearfix">
                    <div class="icheck-danger d-inline">
                        <input type="radio" name="randomly_ordered" {{ ($Assessment != null ? ($Assessment->randomly_ordered == 1 ? 'checked' : '') : '') }} id="randomly_ordered_yes" value="1">
                        <label for="randomly_ordered_yes">
                            Yes
                        </label>
                    </div>
                    <div class="icheck-danger d-inline">
                        <input type="radio" name="randomly_ordered" {{ ($Assessment != null ? ($Assessment->randomly_ordered == 0 ? 'checked' : '') : '') }} id="randomly_ordered_no" value="0">
                        <label for="randomly_ordered_no">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Time Limit: <small class="text-red"><i>eg. 60 mins</i></small></label>                
                <input type="number" class="form-control form-control-sm" name="time_limit" value="{{ ($Assessment != null ? ($Assessment->time_limit) : '') }}">
                <div class="help-block text-red" id="js-time_limit"></div>
            </div>
            <div class="col-md-4">
                <label for="">Total Item:</label>                
                <input type="number" class="form-control form-control-sm" name="total_item" value="{{ ($Assessment != null ? ($Assessment->total_items) : '') }}">
                <div class="help-block text-red" id="js-total_item"></div>
            </div>
        </div>
        <hr/>
        <h5>Student Settings</h5>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="">Students can view results after submission:</label>
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <input type="radio" name="view_results" {{ ($Assessment != null ? ($Assessment->student_view_result == 0 ? 'checked' : '') : '') }} id="view_results_no" value="0">
                        <label for="view_results_no">
                            No
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" name="view_results" {{ ($Assessment != null ? ($Assessment->student_view_result == 1 ? 'checked' : '') : '') }} id="view_results_yes" value="1">
                        <label for="view_results_yes">
                            Yes
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" name="view_results" {{ ($Assessment != null ? ($Assessment->student_view_result == 2 ? 'checked' : '') : '') }} id="view_results_yes_answers" value="2">
                        <label for="view_results_yes_answers">
                            Yes with correct answers
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Number of submission attempts of student:</label>
                <select class="form-control form-control-sm" name="attempts" style="width: 100%;">
                    @for ($x = 1; $x < 11; $x++) 
                        <option value="{{ $x }}" {{ ($Assessment != null ? ($Assessment->attempt_limit == $x ? 'selected' : '') : '') }}>{{ $x }}</option>
                    @endfor
                </select>
                <div class="help-block text-red" id="js-attempts"></div>
            </div>
            <div class="col-md-4">
                <label for="">Assessment Status</label>
                <select class="form-control form-control-sm" name="exam_status" style="width: 100%;">
                    <option value="0" {{ $Assessment != null ? $Assessment->exam_status == 0 ? 'selected' : '' : '' }}>Unpublished</option>
                    <option value="1" {{ $Assessment != null ? $Assessment->exam_status == 1 ? 'selected' : '' : '' }}>Published</option>
                    <option value="2" {{ $Assessment != null ? $Assessment->exam_status == 2 ? 'selected' : '' : '' }}>Archived</option>
                </select>
                <div class="help-block text-red" id="js-exam_status"></div>
            </div>
            {{-- <div class="col-md-4">
                <label for="">Number of question in every page:</label>
                <select class="form-control form-control-sm" name="attempts" style="width: 100%;">
                    <option>1</option>
                    <option></option>
                    <option></option>
                </select>
                <div class="help-block text-red" id="js-attempts"></div>
            </div> --}}
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="far fa-save fa-lg"></i> {{ $Assessment != null ? 'Update' : 'Save' }}</button>
    </div>
</form>