<div class="modal fade class_schedules" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_subject_details">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{--  Class Schedule  --}}
                    </h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-dark">
                        <tr>
                            <th>Time</th>
                            <th>Day</th>
                        </tr>
                        <tbody>
                            @foreach($ClassSubjectDetail as $data) 
                                <tr>
                                    <td>{{ $data->class_time_from . '-' . $data->class_time_to }}</td>
                                    <td>{{ $data->class_days }}</td>
                                    <td>{{ $data->subject }}</td>
                                    subject
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->