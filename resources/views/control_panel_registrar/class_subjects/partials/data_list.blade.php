                        <div class="float-right">
                            {{ $ClassSubjectDetail ? $ClassSubjectDetail->links() : '' }}
                        </div>
                        <table class="table no-margin table-sm table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Subject Code</th>
                                    <th>Subject</th>
                                    <th style="width: 25%">Schedule</th>
                                    <th style="width: 25%">Faculty</th>
                                    <th>Order</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)
                                    @if ($ClassSubjectDetail)
                                            @foreach ($ClassSubjectDetail as $data)
                                                @php
                                                    $days = $data ? $data->class_schedule ? explode(';', rtrim($data->class_schedule,";")) : [] : [];
                                                    $daysObj = [];
                                                    $daysDisplay = '';
                                                    if ($days) 
                                                    {
                                                        foreach($days as $day)
                                                        {
                                                            $day_sched = explode('@', $day);
                                                            $d = $day_sched[0];
                                                            $day = '';
                                                            if ($day_sched[0] == 1) {
                                                                $day = 'M';
                                                                $daysObj[$d]['day'] = 'M';
                                                            } else if ($day_sched[0] == 2) {
                                                                $day = 'T';
                                                                $daysObj[$d]['day'] = 'T';
                                                            } else if ($day_sched[0] == 3) {
                                                                $day = 'W';
                                                                $daysObj[$d]['day'] = 'W';
                                                            } else if ($day_sched[0] == 4) {
                                                                $day = 'TH';
                                                                $daysObj[$d]['day'] = 'TH';
                                                            } else if ($day_sched[0] == 5) {
                                                                $day = 'F';
                                                                $daysObj[$d]['day'] = 'F';
                                                            }
                                                            $t = explode('-', $day_sched[1]);
                                                            /*$daysObj[$d]['from'] = $t[0];
                                                            $daysObj[$d]['to'] = $t[1];*/

                                                            $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                                        }
                                                    }

                                                @endphp
                                                <tr>
                                                    <td>{{ $data->subject_code }}</td>
                                                    <td>{{ $data->subject }}</td>
                                                    {{--  <td>{{ $data->class_days }}</td>  --}}
                                                    <td>{{ rtrim($daysDisplay, '/') }}</td>
                                                    <td>
                                                        @foreach ($data->teachersData as $teacherData)
                                                            <span title="{{ $teacherData->faculty->full_name }}" class="badge bg-primary">
                                                                {{ $teacherData->faculty->full_name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $data->class_subject_order }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger">Action</button>
                                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="#" class="dropdown-item js-btn_update" data-id="{{ $data->id }}">Edit</a>
                                                                <a href="#" class="dropdown-item js-btn_update_faculty" data-id="{{ $data->id }}">Edit Faculty</a>
                                                                <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    @endif

                                @else

                                    @if ($ClassSubjectDetail1)
                                        @foreach ($ClassSubjectDetail1 as $data)
                                            @php
                                                $days = $data ? $data->class_schedule ? explode(';', rtrim($data->class_schedule,";")) : [] : [];
                                                $daysObj = [];
                                                $daysDisplay = '';
                                                if ($days) 
                                                {
                                                    foreach($days as $day)
                                                    {
                                                        $day_sched = explode('@', $day);
                                                        $d = $day_sched[0];
                                                        $day = '';
                                                        if ($day_sched[0] == 1) {
                                                            $day = 'M';
                                                            $daysObj[$d]['day'] = 'M';
                                                        } else if ($day_sched[0] == 2) {
                                                            $day = 'T';
                                                            $daysObj[$d]['day'] = 'T';
                                                        } else if ($day_sched[0] == 3) {
                                                            $day = 'W';
                                                            $daysObj[$d]['day'] = 'W';
                                                        } else if ($day_sched[0] == 4) {
                                                            $day = 'TH';
                                                            $daysObj[$d]['day'] = 'TH';
                                                        } else if ($day_sched[0] == 5) {
                                                            $day = 'F';
                                                            $daysObj[$d]['day'] = 'F';
                                                        }
                                                        $t = explode('-', $day_sched[1]);
                                                        /*$daysObj[$d]['from'] = $t[0];
                                                        $daysObj[$d]['to'] = $t[1];*/

                                                        $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                                    }
                                                }

                                            @endphp
                                            <tr>
                                                <td>{{ $data->subject_code }} </td>
                                                <td>{{ $data->subject }}</td>
                                                {{--  <td>{{ $data->class_days }}</td>  --}}
                                                <td> {{ rtrim($daysDisplay, '/') }} </td>
                                                <td>
                                                    @foreach ($data->teachersData as $teacherData)
                                                        <span title="{{ $teacherData->faculty->full_name }}" class="badge bg-primary">
                                                            {{ $teacherData->faculty->full_name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $data->class_subject_order }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger">Action</button>
                                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item js-btn_update" data-id="{{ $data->id }}">Edit</a>
                                                            <a href="#" class="dropdown-item js-btn_update_faculty" data-id="{{ $data->id }}">Edit Faculty</a>
                                                            <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif                                
                            </tbody>
                        </table>