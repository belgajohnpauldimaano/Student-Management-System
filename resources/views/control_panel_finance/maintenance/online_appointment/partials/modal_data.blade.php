<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_other_fee">
                {{ csrf_field() }}
                @if ($OnlineAppointment)
                    <input type="hidden" name="id" value="{{ $OnlineAppointment->id }}">
                @endif
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $OnlineAppointment ? 'Edit Online Appointment' : 'Add Online Appointment' }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="date" class="form-control pull-right" 
                            data-date-format="yyyy-mm-dd hh:ii" id="datetimepicker" 
                            value="{{ $OnlineAppointment ? $OnlineAppointment->date : '' }}">
                        </div>
                        {{-- <input type="text" class="form-control" id="datetimepicker" name="date" data-date-format="yyyy/m/d" placeholder="yyyy/m/d" value="{{ $OnlineAppointment ? date_format(date_create($OnlineAppointment->date), 'F d, Y h:i A') : '' }}"> --}}
                        <div class="help-block text-red text-center" id="js-date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Time</label>
                        <input type="text" class="form-control timepicker" name="time" value="{{ $OnlineAppointment ? $OnlineAppointment->time : '' }}">
                        <div class="help-block text-red text-center" id="js-time">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Grade level</label>
                        <select name="grade_lvl" id="grade_lvl" class="form-control">
                            <option value="">Select Grade level</option>
                            @if($Gradelvl)
                                @foreach($Gradelvl as $grade_lvl)
                                    <option value="{{$grade_lvl->id}}" {{ $OnlineAppointment ? $OnlineAppointment->grade_lvl_id == $grade_lvl->id ? 'selected' : '' : '' }}> Grade {{ $grade_lvl->grade }}</option>                    
                                @endforeach
                            @endif
                        </select>
                        <div class="help-block text-red text-center" id="js-grade_lvl">
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="">Number of Appointee</label>
                            <input type="number" class="form-control" name="appointee" value="{{ $OnlineAppointment ? $OnlineAppointment->available_students : '' }}">
                            <div class="help-block text-red text-center" id="js-appointee">
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