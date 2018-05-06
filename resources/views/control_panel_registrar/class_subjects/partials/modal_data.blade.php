<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_subject_details">
                {{ csrf_field() }}
                @if ($ClassSubjectDetail)
                    <input type="hidden" name="id" value="{{ $ClassSubjectDetail->id }}">
                @endif
                
                <input type="hidden" name="class_details_id" value="{{ $class_details_id }}">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $ClassSubjectDetail ? 'Edit Class Subject' : 'Add Class Subject' }}
                    </h4>
                </div>
                <div class="modal-body">                    
                    
                    <div class="form-group">
                        <label for="">Faculty</label>
                        <select name="faculty" id="faculty" class="form-control">
                            <option value="">Select faculty</option>
                            @foreach ($FacultyInformation as $data) 
                                <option value="{{ $data->id }}" {{ $ClassSubjectDetail ? $ClassSubjectDetail->faculty_id == $data->id ? 'selected' : '' : '' }}>{{ $data->first_name . ' ' . $data->last_name }}</option>
                            @endforeach
                        </select>
                        <div class="help-block text-red text-center" id="js-faculty">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Subject</label>
                        <select name="subject" id="subject" class="form-control">
                            <option value="">Select subject</option>
                            @foreach ($SubjectDetail as $data) 
                                <option value="{{ $data->id }}" {{ $ClassSubjectDetail ? $ClassSubjectDetail->subject_id == $data->id ? 'selected' : '' : '' }}>{{ $data->subject_code . ' ' . $data->subject }}</option>
                            @endforeach
                        </select>
                        <div class="help-block text-red text-center" id="js-subject">
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6  no-padding">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                <label>Class Time (<i>from</i>)</label>

                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="subject_time_from" value="{{ $ClassSubjectDetail ? strftime('%r',strtotime($ClassSubjectDetail->class_time_from)) : '' }}">

                                    <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                <label>Class Time (<i>to</i>)</label>

                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="subject_time_to" value="{{ $ClassSubjectDetail ? strftime('%r',strtotime($ClassSubjectDetail->class_time_to)) : '' }}">

                                    <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Schedule</label>
                    </div>
                    <div class="checkbox">
                        <label>
                        <input id="check_all_days" type="checkbox" data-checked-all="true"> Check All days
                        </label>
                    </div>
                    <div class="form-inline">
                        <div class="checkbox">
                            <label>
                            <input name="sched_mon" id="sched_mon" class="sched_days" type="checkbox"> Monday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                            <input name="sched_tue" id="sched_tue" class="sched_days" type="checkbox"> Tuesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                            <input name="sched_wed" id="sched_wed" class="sched_days" type="checkbox"> Wednesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                            <input name="sched_thu" id="sched_thu" class="sched_days" type="checkbox"> Thursday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                            <input name="sched_fri" id="sched_fri" class="sched_days" type="checkbox"> Friday
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->