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
                        <input type="text" class="form-control" id="date" name="date" data-date-format="yyyy/m/d" value="{{ $OnlineAppointment ? $OnlineAppointment->date : '' }}">
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