<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $attendance ? 'Edit Attendance Number' : 'Add Attendance Number' }}                 
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="js-form_attendance">
                        {{ csrf_field() }}                        
                        <h4 class="modal-title">
                            Attendance Number
                        </h4>
                        @if ($attendance)
                            <input type="hidden" name="id" value="{{ $attendance->id }}">
                        @endif
                        <br/>
                        <div class="grid-width-100">
                            <select name="sy_search" id="sy_search" class="form-control">
                                <option value="">Select School Year</option>
                                @foreach ($SchoolYear as $data)
                                    <option value="{{ $data->id }}" 
                                        @php 
                                        try {
                                            echo $attendance->school_year_id == $data->id ? 'selected' : '';
                                        } catch (\Throwable $th) {
                                            echo '';
                                        } 
                                        @endphp
                                    >{{ $data->school_year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br/>
                        <br/>
                        <table class="table">
                            <tr>
                                <th>Title</th>
                                @foreach ($student_attendance['table_header'] as $data)
                                    <th>{{ $data['key'] }}</th>
                                {{--  {{ json_encode($data) }}  --}}
                                @endforeach
                            </tr>
                            <tr>
                                <th>
                                    Days of School
                                </th>
                                @foreach ($student_attendance['attendance_data']->days_of_school as $key => $data)
                                    <th style="width:7%">
                                        <input type="text" class="form-control days_of_school" 
                                            min="0" max="30" id="days_of_school{{ $key }}" name="days_of_school[]" 
                                            value="{{ $data != '' ? $data : '' }}"
                                        />
                                    </th>
                                @endforeach
                            </tr>
                            <tr>
                                <th>
                                    Days Present
                                </th>
                                @foreach ($student_attendance['attendance_data']->days_present as $key => $data)
                                    <th style="width:7%">
                                        <input type="text" class="form-control days_present" 
                                            min="0" max="30" id="days_present{{ $key }}" name="days_present[]"
                                            value="{{ $data }}" 
                                        />    
                                    </th>
                                @endforeach
                            </tr>
                            <tr>
                                <th>
                                    Days Absent
                                </th>
                                @foreach ($student_attendance['attendance_data']->days_absent as $key => $data)
                                    <th style="width:7%">
                                        <input type="text" class="form-control days_absent" min="0" max="30" 
                                            id="days_present{{ $key }}" name="days_absent[]" value="{{ $data }}" 
                                        />    
                                    </th>
                                @endforeach
                            </tr>
                            <tr>
                                <th>
                                    Times Tardy
                                </th>
                                @foreach ($student_attendance['attendance_data']->times_tardy as $key => $data)
                                    <th style="width:7%">
                                        <input type="text" class="form-control times_tardy" min="0" max="30" 
                                            id="days_present{{ $key }}" name="times_tardy[]" value="{{ $data }}" 
                                        />    
                                    </th>
                                @endforeach
                            </tr>
                        </table>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-flat">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

