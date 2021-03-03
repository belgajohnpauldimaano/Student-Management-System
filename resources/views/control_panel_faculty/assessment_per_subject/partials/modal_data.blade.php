<div class="modal fade" tabindex="-1" role="dialog" id="create-assessment-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Create and Setup Assessment
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="js-assessment-create-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control form-control-sm" name="title" value="">
                                    <div class="help-block text-red" id="js-title">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-sm w-100">
                                        <label>Exam Period</label>
                                        <select class="form-control form-control-sm" name="exam_period" style="width: 100%;">
                                            <option value="1">Prelims</option>
                                            <option value="2">Midterms</option>
                                            <option value="3">Finals</option>
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
                                        data-date-format="yyyy-mm-dd hh:ii" id="publishdatetime" value="">
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
                                        data-date-format="yyyy-mm-dd hh:ii" id="expdatetime" value="">
                                    </div>
                                    <div class="help-block text-red" id="js-exp_date_time">
                                    </div>
                                </div>
                                @if($ClassSubjectDetail->classDetail->grade->id > 10)
                                <div class="col-md-3">                                    
                                    <div class="form-group form-group-sm w-100">
                                        <label>Semester Period:</label>
                                        <select class="form-control form-control-sm" name="semester_period" style="width: 100%;">
                                            <option value="1" {{ $semester != null ? ($semester == 1 ? 'selected' : '') : '' }}>1st semester</option>
                                            <option value="2" {{ $semester != null ? ($semester == 2 ? 'selected' : '') : '' }}>2nd semester</option>
                                        </select>
                                    </div>
                                    <div class="help-block text-red" id="js-semester_period"></div>
                                </div>
                                @endif
                                <div class="col-md-3">
                                    <div class="form-group form-group-sm w-100">
                                        <label>Quarter Period:</label>
                                        <select class="form-control form-control-sm" name="quarter_period" style="width: 100%;">
                                            <option value="1">1st quarter</option>
                                            <option value="2">2nd quarter</option>
                                            @if($ClassSubjectDetail->classDetail->grade->id < 11)
                                            <option value="3">3rd quarter</option>
                                            <option value="4">4th quarter</option>
                                            @endif
                                        </select>
                                        <div class="help-block text-red" id="js-quarter_period"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="summernote">Instructions</label>
                                    <textarea name="instructions" id="summernote"></textarea>
                                    <div class="help-block text-red" id="js-instructions"></div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <hr/>

                    <div class="form-group">
                        <h5>Assessment Settings</h5>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="">Questions are randomly ordered:</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="randomly_ordered" id="randomly_ordered_yes" value="1">
                                        <label for="randomly_ordered_yes">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="randomly_ordered" id="randomly_ordered_no" value="0">
                                        <label for="randomly_ordered_no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Time Limit: <small class="text-red"><i>eg. 60 mins</i></small></label>                
                                <input type="number" class="form-control form-control-sm" name="time_limit" value="">
                                <div class="help-block text-red" id="js-time_limit"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Total Item:</label>                
                                <input type="number" class="form-control form-control-sm" name="total_item" value="">
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
                                        <input type="radio" name="view_results" id="view_results_no" value="0">
                                        <label for="view_results_no">
                                            No
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="view_results" id="view_results_yes" value="1">
                                        <label for="view_results_yes">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="view_results" id="view_results_yes_answers" value="2">
                                        <label for="view_results_yes_answers">
                                            Yes with correct answers
                                        </label>
                                    </div>
                                    <div class="help-block text-red" id="js-instructions"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Number of attempts of student:</label>
                                <select class="form-control form-control-sm" name="attempts" style="width: 100%;">
                                    @for ($x = 1; $x < 11; $x++) 
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                                </select>
                                <div class="help-block text-red" id="js-attempts"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Assessment Status</label>
                                <select class="form-control form-control-sm" name="exam_status" style="width: 100%;">
                                    <option value="0">Unpublished</option>
                                    <option value="1">Published</option>
                                    <option value="2">Archived</option>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->