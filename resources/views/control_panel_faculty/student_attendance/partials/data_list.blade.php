
        
 <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id=""><i class="fa fa-file-pdf"></i> Print</button>
 <br/><br/>
 <table class="table no-margin table-striped table-bordered">
    <thead>
        <tr>
            <th style="width: 30px">#</th>
            <th colspan="13" style="text-align:left">Student Name</th>
        </tr>
    </thead>
    <tbody>      
                                                    
    <tr>
        <td colspan="16">
            <b>Male</b> 
        </td>
    </tr>

    @forelse ($attendance_male as $key => $data) 
    <tr>
        <td>{{ $key + 1 }}.</td>
        <td>
            <b style="font-size: 15px">
                {{ $data['student_name'] }}
            </b>
            
            <form id = "js-attendance">
                {{ csrf_field() }}
                    
                <input type="hidden" id="enroll_id" name="enroll_id" value="{{  $data['e_id'] }}" />
                <input type="hidden" id="class_id" name="class_id" value="{{ encrypt($class_id) }}" />
                
                <table class="table">
                    <tr>
                        <th>
                            <i style="font-size: 16px; color: red">Title</i>
                        </th>
                            @foreach ($data['table_header'] as $item)
                                    <th>{{ $item['key'] }}</th> 
                            @endforeach
                        </tr>
                        <tr>
                            <th>
                                Days of School
                            </th>
                            
                            @foreach ($data['attendance_data']->days_of_school as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school{{ $key }}" name="days_of_school[]"  value="{{ $item ? $item : '' }}" />
                                </th>                                                                        
                            @endforeach
                            <th class="days_of_school_total">
                                {{ $data['days_of_school_total'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Days Present
                            </th>
                            @foreach ($data['attendance_data']->days_present as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control days_present" min="0" max="30" id="days_present{{ $key }}" name="days_present[]" value="{{ $item ? $item : '' }}" />    
                                </th>
                            @endforeach
                            <th class="days_present_total">
                                {{ $data['days_present_total'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Days Absent
                            </th>
                            @foreach ($data['attendance_data']->days_absent as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control days_absent" min="0" max="30" id="days_present{{ $key }}" name="days_absent[]" value="{{ $item ? $item : '' }}" />    
                                </th>
                            @endforeach
                            <th class="days_absent_total">
                                {{ $data['days_absent_total'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Times Tardy
                            </th>
                            @foreach ($data['attendance_data']->times_tardy as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present{{ $key }}" name="times_tardy[]" value="{{ $item ? $item : '' }}" />    
                                </th>
                            @endforeach
                            <th class="times_tardy_total">
                                {{ $data['times_tardy_total'] }}
                            </th>
                        </tr>
                    </table>
                    <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <th class="text-center">
            No Available Data
        </th>
    </tr>
    @endforelse

    <tr>
        <td colspan="16">
            <b>Female</b> 
        </td>
    </tr>
    @forelse ($attendance_female as $key => $data) 
    <tr>
        <td>{{ $key + 1 }}.</td>
        <td>
            <b style="font-size: 15px">
                {{ $data['student_name'] }}
            </b>
            
            <form id = "js-attendance">
                {{ csrf_field() }}
                    
                <input type="hidden" id="enroll_id" name="enroll_id" value="{{  $data['e_id'] }}" />
                <input type="hidden" id="class_id" name="class_id" value="{{ encrypt($class_id) }}" />
                
                <table class="table">
                    <tr>
                        <th>
                            <i style="font-size: 16px; color: red">Title</i>
                        </th>
                            @foreach ($data['table_header'] as $item)
                                    <th>{{ $item['key'] }}</th> 
                            @endforeach
                        </tr>
                        <tr>
                            <th>
                                Days of School
                            </th>
                            
                            @foreach ($data['attendance_data']->days_of_school as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school{{ $key }}" name="days_of_school[]"  value="{{ $item ? $item : '' }}" />
                                </th>                                                                        
                            @endforeach
                            <th class="days_of_school_total">
                                {{ $data['days_of_school_total'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Days Present
                            </th>
                            @foreach ($data['attendance_data']->days_present as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control days_present" min="0" max="30" id="days_present{{ $key }}" name="days_present[]" value="{{ $item ? $item : '' }}" />    
                                </th>
                            @endforeach
                            <th class="days_present_total">
                                {{ $data['days_present_total'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Days Absent
                            </th>
                            @foreach ($data['attendance_data']->days_absent as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control days_absent" min="0" max="30" id="days_present{{ $key }}" name="days_absent[]" value="{{ $item ? $item : '' }}" />    
                                </th>
                            @endforeach
                            <th class="days_absent_total">
                                {{ $data['days_absent_total'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Times Tardy
                            </th>
                            @foreach ($data['attendance_data']->times_tardy as $key => $item)
                                <th style="">
                                    <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present{{ $key }}" name="times_tardy[]" value="{{ $item ? $item : '' }}" />    
                                </th>
                            @endforeach
                            <th class="times_tardy_total">
                                {{ $data['times_tardy_total'] }}
                            </th>
                        </tr>
                    </table>
                    <button type="submit" id="btn_save1" class="btn btn-primary btn-flat pull-right">Save</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <th class="text-center">
            No Available Data
        </th>
    </tr>
    @endforelse
    
 </table>
                

