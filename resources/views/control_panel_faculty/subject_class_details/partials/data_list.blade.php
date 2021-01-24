                        <?php
                            $days = $ClassSubjectDetail ? $ClassSubjectDetail->class_schedule ? explode(';', rtrim($ClassSubjectDetail->class_schedule,";")) : [] : [];
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
                        <h5>Subject : <span class="text-red"><i>{{ $ClassSubjectDetail->subject }}</i></span> 
                        {{--  Time : <span class="text-red"><i>{{ strftime('%r',strtotime($ClassSubjectDetail->class_time_from)) . ' - ' . strftime('%r',strtotime($ClassSubjectDetail->class_time_to)) }}</i></span> Days : <span class="text-red"><i>{{ $ClassSubjectDetail->class_days }}</i></span>  --}}
                        Schedule : <span class="text-red"><i>{{ rtrim($daysDisplay, '/') }}</i></span>  
                        </h5>
                        <h5>Grade & Section : <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h5>
                        {{-- <div class="pull-right">
                            {{ $EnrollmentMale ? $EnrollmentMale->links() : '' }}
                        </div> --}}
                        <table class="table no-margin table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Student Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-danger">
                                    <td colspan="3"><b>Male</b></td>
                                </tr>
                                @if ($EnrollmentMale)
                                    @foreach ($EnrollmentMale as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->student_name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="bg-yellow">
                                    <td colspan="3"><b>Female</b></td>
                                </tr>
                                @if ($EnrollmentFemale)
                                    @foreach ($EnrollmentFemale as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->student_name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>