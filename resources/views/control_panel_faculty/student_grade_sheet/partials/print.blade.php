<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Faculty Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        .page-break {
            page-break-after: always;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            font-size : 11px;
        }
        .text-red {
            color : #dd4b39 !important;
        }
        small {
            font-size : 10px;
        }
    </style>
</head>
<body>
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
    <h3>Grade sheet</h3>
    <h4>Faculty : {{ ucfirst($FacultyInformation->last_name). ', ' .ucfirst($FacultyInformation->first_name). ' ' . ucfirst($FacultyInformation->middle_name) }}</h4>
    <h4>Subject : <span class="text-red"><i>{{ $ClassSubjectDetail->subject }}</i></span> 
    Time : <span class="text-red"><i>{{ strftime('%r',strtotime($ClassSubjectDetail->class_time_from)) . ' - ' . strftime('%r',strtotime($ClassSubjectDetail->class_time_to)) }}</i></span> Days : <span class="text-red"><i>{{ $ClassSubjectDetail->class_days }}</i></span>
    Schedule : <span class="text-red"><i>{{ rtrim($daysDisplay, '/') }}</i></span>
    </h4>
    <h4>Grade & Section : <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
    <table class="table no-margin">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                
            @if ($ClassSubjectDetail->grade_level >= 11) 
                <th>First Semister</th>
                <th>Second Semister</th>
            @elseif($ClassSubjectDetail->grade_level <= 10)
                <th>First Grading</th>
                <th>Second Grading</th>
                <th>Third Grading</th>
                <th>Fourth Grading</th>
            @endif
                <th>Final Grading</th>
            </tr>
        </thead>
        <tbody>
            @if ($ClassSubjectDetail->grade_level >= 11) 
                @if ($EnrollmentMale)
                    @foreach ($EnrollmentMale as $key => $data)
                        <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->student_name }}</td>
                            <td>
                                {{ $data->fir_g }}
                            </td>
                            <td>
                                {{ $data->sec_g }}
                            </td>
                            <td>
                                <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                    <strong>
                                        <?php
                                            $g_ctr = 0;
                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                        ?>
                                        {{ ($g_ctr ? (($data->fir_g + $data->sec_g) / $g_ctr) : 0)  }}
                                    </strong>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if ($EnrollmentFemale)
                    @foreach ($EnrollmentFemale as $key => $data)
                        <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->student_name }}</td>
                            <td>
                                {{ $data->fir_g }}
                            </td>
                            <td>
                                {{ $data->sec_g }}
                            </td>
                            <td>
                                <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                    <strong>
                                        <?php
                                            $g_ctr = 0;
                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                        ?>
                                        {{ ($g_ctr ? (($data->fir_g + $data->sec_g) / $g_ctr) : 0)  }}
                                    </strong>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @elseif($ClassSubjectDetail->grade_level <= 10)
                @if ($EnrollmentMale)
                    @foreach ($EnrollmentMale as $key => $data)
                        <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->student_name }}</td>
                            <td>
                                {{$data->fir_g}}
                            </td>
                            <td>
                                {{$data->sec_g}}
                            </td>
                            <td>
                                {{$data->thi_g}}
                            </td>
                            <td>
                                {{$data->fou_g}}
                            </td>
                            <td>
                                <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                    <strong>
                                        <?php
                                            $g_ctr = 0;
                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                            $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                            $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                        ?>
                                        {{ ($g_ctr ? (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                    </strong>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if ($EnrollmentFemale)
                    @foreach ($EnrollmentFemale as $key => $data)
                        <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->student_name }}</td>
                            <td>
                                {{$data->fir_g}}
                            </td>
                            <td>
                                {{$data->sec_g}}
                            </td>
                            <td>
                                {{$data->thi_g}}
                            </td>
                            <td>
                                {{$data->fou_g}}
                            </td>
                            <td>
                                <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                    <strong>
                                        <?php
                                            $g_ctr = 0;
                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                            $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                            $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                        ?>
                                        {{ ($g_ctr ? (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                    </strong>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endif
        </tbody>
    </table>
</body>
</html>