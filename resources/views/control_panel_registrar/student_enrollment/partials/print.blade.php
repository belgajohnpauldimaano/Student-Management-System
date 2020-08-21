<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Enrolled Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        *   {
                font-family: Arial, Times, serif;
            }
            .page-break {
                page-break-after: always;
            }
            th, td {
                border: 1px solid #000;
                padding: 3px;
            }
            table {
                width: 100%;
                border-spacing: 0;
                border-collapse: collapse;
                font-size : 11px;
            }
            .table-student-info {
                width: 100%;
            }            
            .table-student-info th, .table-student-info td {
                border: none;
                padding: 0 2px 2px 2px;
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
            }
            .sja-logo {
                top: 10px;
                right: 10px;
            }
            .deped-bataan-logo {
                top: 10px;
                left: 10px;
            }
            .report-progress {
                text-align: center;
                font-size: 12px;
                font-weight: 700;
            }
            .report-progress-left {
                text-align: left;
                font-size: 12px;
                font-weight: 700;
            }
            
    </style>
</head>
<body>

    <div style="margin-top: 20px">
        <h3 class="heading2 heading2-title">St. John's Academy Inc</h3>    
        <p class="heading2 heading2-subtitle"><b>Formerly Saint John Academy</b></p>
        <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
        <img style="margin-right: 32em; margin-top: "  class="logo sja-logo" width="100" src="{{ asset('img/sja-logo.png') }}" />
        <h3 class="heading2 heading2-title">Enrolled Students</h3>
    </div>
    <div style="margin-top: 50px">
        <p class="m0 heading2-subtitle">School Year: <strong>{{ $ClassDetail->school_year }}</p>
        <p class="m0 heading2-subtitle">Grade & Section: <strong>{{ $ClassDetail->grade_level }} - {{ $ClassDetail->section }}</strong></p>
        
        
        <div style="margin-top: 10px">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Number</th>
                        <th>Student Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($EnrollmentMale)
                        <tr>
                            <td colspan="3">
                                Male
                            </td>
                        </tr>
                        @foreach ($EnrollmentMale as $key => $data)                            
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td style="text-align: center">{{ $data->username }}</td>
                                <td style="text-align: center">{{ ucwords(strtolower($data->fullname)) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">
                                Female
                            </td>
                        </tr>
                        @foreach ($EnrollmentFemale as $key => $data)                            
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td style="text-align: center">{{ $data->username }}</td>
                                <td style="text-align: center">{{ ucwords(strtolower($data->fullname)) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>