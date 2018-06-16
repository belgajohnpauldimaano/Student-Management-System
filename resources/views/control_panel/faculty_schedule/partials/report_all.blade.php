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
        }
    </style>
</head>
<body>
    <div>
        @foreach ($faculty_subjects as $fs)
            <div>
                <label for="">Faculty Name : </label>
                <strong>{{ ucfirst($fs->faculty->last_name) . ', ' . ucfirst($fs->faculty->first_name) . ' ' . ucfirst($fs->faculty->middle_name) }}</strong>
                <div>
                    <label>Subjects</label>
                    <table class="table table-bordered">
                        <tr>
                            <th>Time</th>
                            <th>Day</th>
                            <th>Subject</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>Room</th>
                            <th>School Year</th>
                        </tr>
                        <tbody>
                            @if ($fs->subjects)
                                @foreach($fs->subjects as $data) 
                                    <tr>
                                        <td>{{ $data->class_time_from . '-' . $data->class_time_to }}</td>
                                        <td>{{ $data->class_days }}</td>
                                        <td>{{ $data->subject }}</td>
                                        <td>{{ $data->grade_level }}</td>
                                        <td>{{ $data->section }}</td>
                                        <td>{{ $data->room_code }}</td>
                                        <td>{{ $data->school_year }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="7">No record found</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        @endforeach
    </div>
</body>
</html>