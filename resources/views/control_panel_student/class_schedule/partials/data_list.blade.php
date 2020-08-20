<div class="box-body">
    <div class="js-data-container">
        <div class="table-responsive">
            <table class="table no-margin table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Schedule</th>
                        <th>Subject</th>
                        <th>Room</th>
                        <th>Grade & Section</th>
                        <th>Faculty</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($Enrollment)
                        @if($findSchoolYear =='')
                            <td colspan="5" style="text-align: center; font-weight: 600">
                                <img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.
                            </td>
                        @endif
                        @foreach ($Enrollment as $key => $data)
                        <?php
                                $days = $data ? $data->class_schedule ? explode(';', rtrim($data->class_schedule,";")) : [] : [];
                                $daysObj = [];
                                $daysDisplay = '';
                                if ($days) 
                                {
                                    foreach($days as $day)
                                    {
                                        $day_sched = explode('@', $day);
                                        $day = '';
                                        if ($day_sched[0] == 1) {
                                            $day = 'M';
                                        } else if ($day_sched[0] == 2) {
                                            $day = 'T';
                                        } else if ($day_sched[0] == 3) {
                                            $day = 'W';
                                        } else if ($day_sched[0] == 4) {
                                            $day = 'TH';
                                        } else if ($day_sched[0] == 5) {
                                            $day = 'F';
                                        }
                                        $t = explode('-', $day_sched[1]);
                                        $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                    }
                                }

                            ?>
                            <tr>
                                <td>{{ rtrim($daysDisplay, '/') }}</td>
                                <td>{{ $data->subject_code . ' ' . $data->subject }}</td>
                                <td>{{ 'Room' . $data->room_code }}</td>
                                <td>{{ $data->grade_level . ' ' . $data->section }}</td>
                                <td>{{ $data->faculty_name }}</td>
                            </tr>
                        @endforeach                        
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>