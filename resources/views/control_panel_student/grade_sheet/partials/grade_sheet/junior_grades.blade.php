<table class="table no-margin">
    <thead>
        <tr>
                <th>Subject</th>
                <th>First Grading</th>
                <th>Second Grading</th>
                <th>Third Grading</th>
                <th>Fourth Grading</th>
                <th>Final Grading</th>
                <th>Remarks</th>
                {{--  <th>Faculty</th>  --}}
        </tr>
    </thead>
    <tbody>
        @if ($GradeSheetData)
            <?php
                $showGenAvg = 0;
            ?>
            @foreach ($GradeSheetData as $key => $data)
                <tr>
                    <center>
                    <td>{{ $data->subject }}</td>
                    @if ($data->grade_status === -1)
                        <td colspan="{{$ClassDetail ? $ClassDetail->section_grade_level <= 10 ? '6' : '4' : '6'}}" class="text-center text-red">Grade not yet finalized</td>
                    @else 
                            <td><center>{{ $data->fir_g ? $data->fir_g > 0  ? round($data->fir_g) : '' : '' }}</center></td>
                            <td><center>{{ $data->sec_g ? $data->sec_g > 0  ? round($data->sec_g) : '' : '' }}</center></td>
                            <td><center>{{ $data->thi_g ? $data->thi_g > 0  ? round($data->thi_g) : '' : '' }}</center></td>
                            <td><center>{{ $data->fou_g ? $data->fou_g > 0  ? round($data->fou_g) : '' : '' }}</center></td>
                            
                            @if ($data->fou_g > 0)
                                <td><center>{{ round($data->final_g) }}</center></td>
                                <td><center><strong>{{ $data->final_g >= 75 ? 'Passed' : 'Failed' }}</strong></center></td>
                            @else
                                <td></td>
                            @endif

                            @if ($data->fir_g == 0 && $data->sec_g == 0 && $data->thi_g == 0 && $data->fou_g == 0)
                                <td></td>
                            @else
                                {{-- <td></td> --}}
                            @endif
                            
                    @endif
                    
                    </center>
                </tr>
            @endforeach
                <tr class="text-center">
                    <td style="text-align: right; padding-right: 1em" colspan="{{ $grade_level <= 10 ? '5' : '3'}}"><b>General Average</b></td>
                    <td>
                        <b>
                            @if($data->fir_g == 0 || $data->sec_g == 0 || $data->thi_g == 0 || $data->fou_g == 0)
                                
                            @else
                                {{ $general_avg && $general_avg >= 0 ? round($general_avg) : '' }}
                            @endif
                        </b>
                    </td>
                    @if($data->fir_g == 0 || $data->sec_g == 0 || $data->thi_g == 0 || $data->fou_g == 0)
                        @if($general_avg && $general_avg > 74) 
                            <!--<td style="color:'green';"><strong>Passed</strong></td>-->
                            <td></td>
                        @elseif($general_avg < 75) 
                            <td style="color:'red';"><strong>Failed</strong></td>
                        @else 
                            <td></td>
                        @endif
                    @else
                        @if($general_avg < 75 && $general_avg > 74) 
                            <!--<td style="color:'green';"><strong>Passed</strong></td>-->
                            <td></td>
                        @elseif($general_avg < 75) 
                            <td style="color:'red';"><strong>Failed</strong></td>
                        @else 
                            <td></td>
                        @endif
                    @endif                                    
                </tr>
        @else
            
    @endif
</tbody>
</table>

<p class="report-progress-left m0"  style="margin-top: .5em"><b>ATTENDANCE RECORD</b></p>
<table style="width:100%; margin-bottom: 1em">
    <tr>
        <th>
            
        </th>
            @foreach ($student_attendance['table_header'] as $data)
                    <th>{{ $data['key'] }}</th>
            @endforeach
    </tr>
    <tr>
        <th>
            Days of School
        </th>
        @foreach ($student_attendance['attendance_data']->days_of_school as $key => $data)
            <th style="width:7%">{{ $data }}
            </th>
        @endforeach
        <th class="days_of_school_total">
            {{ $student_attendance['days_of_school_total'] }}
        </th>
    </tr>
    <tr>
        <th>
            Days Present
        </th>
        @foreach ($student_attendance['attendance_data']->days_present as $key => $data)
            <th style="width:7%">{{ $data }} 
            </th>
        @endforeach
        <th class="days_present_total">
            {{ $student_attendance['days_present_total'] }}
        </th>
    </tr>
    <tr>
        <th>
            Days Absent
        </th>
        @foreach ($student_attendance['attendance_data']->days_absent as $key => $data)
            <th style="width:7%">{{ $data }}  
            </th>
        @endforeach
        <th class="days_absent_total">
            {{ $student_attendance['days_absent_total'] }}
        </th>
    </tr>
    <tr>
        <th>
            Times Tardy
        </th>
        @foreach ($student_attendance['attendance_data']->times_tardy as $key => $data)
            <th style="width:7%">{{ $data }}  
            </th>
        @endforeach
        <th class="times_tardy_total">
            {{ $student_attendance['times_tardy_total'] }}
        </th>
    </tr>
</table>

<center>
<table border="0" style="width: 80%">

    <tr style="margin-top: .5em">
        <td style="border: 0">Description</td>
        <td style="border: 0">Grading Scale</td>
        <td style="border: 0">Remarks</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">With Highest Honors</td>
        <td style="border: 0">98-100</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">With High Honors</td>
        <td style="border: 0">95-97</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">With Honors</td>
        <td style="border: 0">90-94</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">Passed</td>
        <td style="border: 0">75-79</td>
        <td style="border: 0">Passed</td>                
    </tr>

    <tr style="margin-top: .5em">
        <td style="border: 0">Failed</td>
        <td style="border: 0">Below 75</td>
        <td style="border: 0">Failed</td>                
    </tr>
    <tr style="margin-top: .5em">
        <td style="border: 0"></td>
        <td style="border: 0"></td>
        <td style="border: 0"></td>   
    </tr>

    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Eligible to transfer and admission to:
               
                        <!--//@if($general_avg && $general_avg > 74) -->
                        <!--  //  <strong><u>&nbsp;&nbsp;Grade {{ $ClassDetail->section_grade_level + 1 }}&nbsp;&nbsp;&nbsp;&nbsp;</u></strong>-->
                        <!--//@elseif($general_avg && $general_avg < 75) -->
                        <!--  //  <strong><u>&nbsp;&nbsp;Grade {{ $ClassDetail->section_grade_level }}&nbsp;&nbsp;&nbsp;&nbsp;</u></strong>-->
                        <!--//@else -->
                            _______________________                                            
                        <!--//@endif-->
        </td>                
    </tr>

    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Lacking units in:________<u></u>____</td>                
    </tr>
    
    <tr style="margin-top: .5em">
        @if($DateRemarks)
            <td colspan="3" style="border: 0">Date:___<u>{{ $DateRemarks->j_date }}</u>____</td>
        @else
            <td colspan="3" style="border: 0">Date:________________</td>  
        @endif
    </tr>
    <tr style="margin-top: .5em">
         <td colspan="3" style="border: 0">&nbsp;</td>   </tr>
    {{-- <tr> <td colspan="3" style="border: 0">&nbsp;</td>   </tr> --}}

    <tr style="margin-top: 0em">
        
            <table border="0" style="width: 100%; margin-top: -1em">
                    <tr>
                        <td style="border: 0; width: 50%;">
                            <center>
                                @if($ClassDetail->faculty_id == 30)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}" style="width:150px; margin-bottom: 1em">
                                @else
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $ClassDetail->e_signature ? \File::exists(public_path('/img/signature/'.$ClassDetail->e_signature)) ? asset('/img/signature/'.$ClassDetail->e_signature) : asset('/img/account/photo/blank-user.png') : asset('/img/account/photo/blank-user.png') }}" style="width:100px">
                                @endif
                                
                            </center>
                        </td>
                        <td style="border: 0; width: 50%;">
                            <center>

                                @if($ClassDetail->faculty_id == 26 || $ClassDetail->faculty_id == 28 || $ClassDetail->faculty_id == 66 || $ClassDetail->faculty_id == 10|| $ClassDetail->faculty_id == 11)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ asset('/img/signature/principal_signature.png') }}" 
                                    style="width:170px; margin-top: 2em">
                                @elseif($ClassDetail->faculty_id == 23) 
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ asset('/img/signature/principal_signature.png') }}" 
                                    style="width:170px; margin-top: 2.5em">            
                                @else
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ asset('/img/signature/principal_signature.png') }}" 
                                    style="width:170px; ">
                                @endif
                                
                            </center>
                        </td>
                    </tr>
            </table>

            @if($ClassDetail->faculty_id == 7)
                <table border="0" style="width: 100%; margin-top: -100px; margin-bottom: 0em">     
            @elseif($ClassDetail->faculty_id == 20 || $ClassDetail->faculty_id == 59 || $ClassDetail->faculty_id == 21)
                <table border="0" style="width: 100%; margin-top: -85px; margin-bottom: 0em">
            @elseif($ClassDetail->faculty_id== 68|| $ClassDetail->faculty_id == 10|| $ClassDetail->faculty_id == 11 || $ClassDetail->faculty_id == 14 || $ClassDetail->faculty_id == 30)
                <table border="0" style="width: 100%; margin-top: -90px; margin-bottom: 0em">
            @elseif($ClassDetail->faculty_id == 66)
                <table border="0" style="width: 100%; margin-top: -90px; margin-bottom: 0em">
            @elseif($ClassDetail->faculty_id == 26 || $ClassDetail->faculty_id == 28 || $ClassDetail->faculty_id == 65 || $ClassDetail->faculty_id == 23 || $ClassDetail->faculty_id == 62 || $ClassDetail->faculty_id == 19
              || $ClassDetail->faculty_id == 45 || $ClassDetail->faculty_id == 37 || $ClassDetail->faculty_id == 60  || $ClassDetail->faculty_id == 25 || $ClassDetail->faculty_id== 67)
                <table border="0" style="width: 100%; margin-top: -80px; margin-bottom: 0em">                         
            @else
                <table border="0" style="width: 100%; margin-top: -60px; margin-bottom: 0em">
            @endif   
                <tr>
                    <td style="border: 0; width: 50%; height: 100px">
                        <span style="margin-left: 2em; text-transform: uppercase">
                            <center>
                                {{ $ClassDetail->first_name }} {{ $ClassDetail->middle_name }} {{ $ClassDetail->last_name }}
                            </center>
                            </br>
                            <center style="margin-top: -1em">Adviser</center>
                        </span>
                    </td>
                    <td style="border: 0; width: 50%; height: 100px">
                            <span style="margin-left: 23em;">
                                <center>Gemma R. Yao, Ph.D.</center>
                                </br>
                                <center style="margin-top: -1em">PRINCIPAL</center>
                            </span>
                        </td>
                </tr>
            </table>
        
        
    </tr>
    

</table>

<div class="page-break"></div>
</center>