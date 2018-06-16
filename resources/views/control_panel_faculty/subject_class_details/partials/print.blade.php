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

    <h4>Faculty : {{ strtoupper($FacultyInformation->last_name. ', '. $FacultyInformation->first_name . ' ' . $FacultyInformation->middle_name) }}</h4>
    <h4>Subject : <span class="text-red"><i>{{ $ClassSubjectDetail->subject }}</i></span> Time : <span class="text-red"><i>{{ strftime('%r',strtotime($ClassSubjectDetail->class_time_from)) . ' - ' . strftime('%r',strtotime($ClassSubjectDetail->class_time_to)) }}</i></span> Days : <span class="text-red"><i>{{ $ClassSubjectDetail->class_days }}</i></span></h4>
    <h4>Grade & Section : <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
    <small for="">as of {{ Date('F d, Y H:i') }}</small>
    <table class="table no-margin">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Student Name</th>
            </tr>
        </thead>
        <tbody>
            @if ($Enrollment)
                @foreach ($Enrollment as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->student_name }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>