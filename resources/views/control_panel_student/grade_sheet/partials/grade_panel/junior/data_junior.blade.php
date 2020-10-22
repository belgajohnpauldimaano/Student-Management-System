@if($Enrollment[0]->attendance)
<p class="report-progress-left"  style="margin-top: 2em; "><b>ATTENDANCE RECORD</b></p>
    <table style="margin-top: 2em" class="table no-margin table-bordered table-striped">
        <tr>
            <th></th>                                                                                     
            @foreach ($student_attendance['table_header'] as $data)
                    <th style="text-align:center">{{ $data['key'] }}</th> 
            @endforeach
        </tr>
        <tr>
            <th>
                Days of School
            </th>
            @foreach ($student_attendance['attendance_data']->days_of_school as $key => $data)
                <th style="width:7%; text-align:center">
                    {{ $data }}
                </th>                                                                        
            @endforeach
            <th class="days_of_school_total"  style="text-align:center">
                {{ $student_attendance['days_of_school_total'] }}
            </th>
        </tr>
        <tr>
            <th>
                Days Present
            </th>
            @foreach ($student_attendance['attendance_data']->days_present as $key => $data)
                <th style="width:7%;text-align:center">
                    {{ $data }} 
                </th>
            @endforeach
            <th class="days_present_total" style="text-align:center">
                {{ $student_attendance['days_present_total'] }}
            </th>
        </tr>
        <tr>
            <th>
                Days Absent
            </th>
            @foreach ($student_attendance['attendance_data']->days_absent as $key => $data)
                <th style="width:7%; text-align:center">
                    {{ $data }}   
                </th>
            @endforeach
            <th class="days_absent_total" style="text-align:center">
                {{ $student_attendance['days_absent_total'] }}
            </th>
        </tr>
        <tr>
            <th>
                Times Tardy
            </th>
            @foreach ($student_attendance['attendance_data']->times_tardy as $key => $data)
                <th style="width:7%; text-align:center">
                    {{ $data }} 
                </th>
            @endforeach
            <th class="times_tardy_total" style="text-align:center">
                {{ $student_attendance['times_tardy_total'] }}
            </th>
        </tr>
    </table>
@endif