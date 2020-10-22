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
        }  --}}
        * {
            font-family: Arial, Times, serif;
        }
        .page-break {
            page-break-after: always;
        }
        th, td {
            border: 1px solid #000;
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
        .text-center {
            text-align: center;
        }
        .heading1 {
            text-align: center;
            padding: 0;
            margin:0;
            font-size: 11px;
        }
        .heading2 {
            text-align: center;
            padding: 0;
            margin:0;
        }
        .heading2-title {
            font-family: "Old English Text MT", Times, serif;
        }
        .heading2-subtitle {
            font-size: 12px;
        }
        .p0 {
            padding: 0;
        }
        .m0 {
            margin: 0;
        }

        .student-info {
            font-size: 12px;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .report-progress {
            text-align: center;
            font-size: 12px;
            font-weight: 700;
        }
        .table-student-info {
            width: 100%;
        }            
        .table-student-info th, .table-student-info td {
            border: none;
            padding: 0 2px 2px 2px;
        }
    </style>
</head>
<body>
    <h2 class="heading2 heading2-title">St. John's Academy Inc.</h2>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    <h3 class="heading2 ">Class Schedules</h3>
    <img style="margin-right: 3em; margin-top: {{  asset('img/sja-logo.png') }}" width="115" />
    <div>
    
    <h5>Faculty : {{ strtoupper($FacultyInformation->last_name. ', '. $FacultyInformation->first_name . ' ' . $FacultyInformation->middle_name) }}</h5>
    <table class="table no-margin">
        <thead>
            <tr>
                <th>Days and Time</th>
                <th>Subject</th>
                <th>Room</th>
                <th>Grade & Section</th>
            </tr>
        </thead>
        <tbody>
                @forelse ($ClassSubjectDetail as $key => $data)
                    <tr>
                        <td>
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
                                        
                                        $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
                                    }
                                }
                            @endphp
                            {{ rtrim($daysDisplay, '/') }}
                        </td>
                        <td>{{ $data->subject_code . ' ' . $data->subject }}</td>
                        <td>{{ 'Room' . $data->room_code }}</td>
                        <td>{{ $data->grade_level . ' ' . $data->section }}</td>
                    </tr>
                @empty
                    <td class="text-center">
                        No Schedule Yet
                    </td>
                @endforelse
        </tbody>
    </table>
</body>
</html>