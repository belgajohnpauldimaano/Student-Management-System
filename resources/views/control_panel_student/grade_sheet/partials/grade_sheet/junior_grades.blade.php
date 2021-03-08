<table class="table no-margin less-m-top">
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
                            @if ($data->fir_g == 0 || $data->sec_g == 0 || $data->thi_g == 0 || $data->fou_g == 0)
                                <td></td>
                            @else
                                <td></td>
                            @endif                            
                            <td></td>
                        @endif
                    @endif                    
                    </center>
                </tr>
            @endforeach
                <tr class="text-center">
                    <td style="text-align: right; padding-right: 1em" colspan="{{ $ClassDetail->school_year_id <= 10 ? '5' : '3'}}"><b>General Average</b></td>
                    <td>
                        <b>
                            @if($data->fir_g == 0 || $data->sec_g == 0 || $data->thi_g == 0 || $data->fou_g == 0)
                                
                            @else
                                {{ $general_avg && $general_avg >= 0 ? round($general_avg) : '' }}
                            @endif
                        </b>
                    </td>
                    @if($data->fir_g == 0 || $data->sec_g == 0 || $data->thi_g == 0 || $data->fou_g == 0)
                        {{-- @if($general_avg && $general_avg > 74) 
                            <td style="color:'green';"><strong>Passed</strong></td>
                            <td></td>
                        @elseif($general_avg < 75) 
                            <td style="color:'red';"><strong>Failed</strong></td>
                        @else 
                            <td></td>
                        @endif --}}
                        <td></td>
                    @else
                        @if($general_avg < 75 && $general_avg > 74) 
                            <td style="color:'green';"><strong>Passed</strong></td>
                            <td></td>
                        @elseif($general_avg < 75) 
                            <td style="color:'red';"><strong>Failed</strong></td>
                        @else 
                            <td><center><strong>{{ $data->final_g >= 75 ? 'Passed' : 'Failed' }}</strong></center></td>
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
            <th style="width:7%">{{ $data == '' ? 0 : $data}} 
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
            <th style="width:7%">{{ $data == '' ? 0 : $data}}  
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
            <th style="width:7%">{{ $data == '' ? 0 : $data}}   
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
            <th style="width:7%">{{ $data == '' ? 0 : $data}}   
            </th>
        @endforeach
        <th class="times_tardy_total">
            {{ $student_attendance['times_tardy_total'] }}
        </th>
    </tr>
    
    @if($ClassDetail->school_year_id == 9)
    <tr>
        <th><i>Days of class suspensions with ADM option.</i></th>
        <?php
            for ($x = 0; $x <= 8; $x++) {
                echo "<th>0</th>";
            }
        ?>
        <th>12</th>
        <th>3</th>
        <th>15</th>
    </tr>
    @endif
</table>

<center>
<table border="0" style="width: 80%" class="less-m-top2">

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
            <strong>
                <u>
                    &nbsp;&nbsp;{{ $Enrollment[0]->eligible_transfer  ? '' : 'Grade ' }}
                        {{ $Enrollment[0]->eligible_transfer  ? $Enrollment[0]->eligible_transfer : $ClassDetail->section_grade_level + 1 }}
                    &nbsp;&nbsp;&nbsp;
                </u>
            </strong>
        </td>                
    </tr>
    <tr style="margin-top: .5em">
        <td colspan="3" style="border: 0">Lacking units in:____<u> 
            @php
                try {
                    echo $GradeSheetData[0]->lacking_unit;
                } catch (\Throwable $th) {
                    echo '_____';
                }
            @endphp
            </u>____</td>                
    </tr>    
    <tr style="margin-top: .5em">
        @if($DateRemarks)
            <td colspan="3" style="border: 0">Date:___<u>{{ $DateRemarks->j_date ? date_format(date_create( $DateRemarks->j_date ), 'F d, Y') : '' }}</u>____</td>
        @else
            <td colspan="3" style="border: 0">Date:________________</td>  
        @endif
    </tr>
    <tr style="margin-top: .5em">
         <td colspan="3" style="border: 0">&nbsp;</td>   
    </tr>
    {{-- <tr> <td colspan="3" style="border: 0">&nbsp;</td>   </tr> --}}

    <tr style="margin-top: 0em">        
            <table border="0" style="width: 100%; margin-top: 1.5em">
                    <tr>
                        <td style="border: 0; width: 50%;">
                            <center>
                                @if($Signatory->adviser->id == 30)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" 
                                        src="{{ $Signatory->adviser->e_signature ? \File::exists(public_path('/img/signature/'.$Signatory->adviser->e_signature)) 
                                        ? asset('/img/signature/'.$Signatory->adviser->e_signature) 
                                        : asset('/img/account/photo/blank-user.png') 
                                        : asset('/img/account/photo/blank-user.png') }}" 
                                        style="width:150px; margin-bottom: 1em"
                                    >
                                @else
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" 
                                        src="{{ $Signatory->adviser->e_signature 
                                        ? \File::exists(public_path('/img/signature/'.$Signatory->adviser->e_signature)) 
                                        ? asset('/img/signature/'.$Signatory->adviser->e_signature) 
                                        : asset('/img/account/photo/blank-user.png') 
                                        : asset('/img/account/photo/blank-user.png') }}" style="width:100px"
                                    >
                                @endif                                
                            </center>
                        </td>
                        <td style="border: 0; width: 50%;">
                            <center>
                                @if($Signatory->adviser->id == 26 || $Signatory->adviser->id == 28 || $Signatory->adviser->id == 66 || $Signatory->adviser->id == 10|| $Signatory->adviser->id == 11)
                                    <img class="profile-user-img img-responsive img-circle" 
                                        id="img--user_photo" 
                                        src="{{ asset('/img/signature/principal_signature.png') }}" 
                                        style="width:170px; margin-top: 2em"
                                    >
                                @elseif($Signatory->adviser->id == 23) 
                                    <img class="profile-user-img img-responsive img-circle" 
                                        id="img--user_photo" 
                                        src="{{ asset('/img/signature/principal_signature.png') }}" 
                                        style="width:170px; margin-top: 2.5em"
                                    >            
                                @else
                                    <img class="profile-user-img img-responsive img-circle" 
                                        id="img--user_photo" 
                                        src="{{ asset('/img/signature/principal_signature.png') }}" 
                                        style="width:170px; margin-bottom: -1em"
                                    >
                                @endif                                
                            </center>
                        </td>
                    </tr>
            </table>

            @if($Signatory->adviser->id == 7)
                <table border="0" style="width: 100%; margin-top: -100px; margin-bottom: 0em">     
            @elseif($Signatory->adviser->id == 20 || $Signatory->adviser->id == 59 || $Signatory->adviser->id == 21)
                <table border="0" style="width: 100%; margin-top: -85px; margin-bottom: 0em">
            @elseif($Signatory->adviser->id== 68|| $Signatory->adviser->id == 10|| $Signatory->adviser->id == 11 || $Signatory->adviser->id == 14 || $Signatory->adviser->id == 30)
                <table border="0" style="width: 100%; margin-top: -90px; margin-bottom: 0em">
            @elseif($Signatory->adviser->id == 66)
                <table border="0" style="width: 100%; margin-top: -90px; margin-bottom: 0em">
            @elseif($Signatory->adviser->id == 26 || $Signatory->adviser->id == 28 || $Signatory->adviser->id == 65 || $Signatory->adviser->id == 23 || $Signatory->adviser->id == 62 || $Signatory->adviser->id == 19
              || $Signatory->adviser->id == 45 || $Signatory->adviser->id == 37 || $Signatory->adviser->id == 60  || $Signatory->adviser->id == 25 || $Signatory->adviser->id== 67)
                <table border="0" style="width: 100%; margin-top: -80px; margin-bottom: 0em">                         
            @else
                <table border="0" style="width: 100%; margin-top: -80px; margin-bottom: 0em">
            @endif   
                <tr>
                    <td style="border: 0; width: 50%; height: 100px">
                        <span style="margin-left: 2em; text-transform: uppercase">
                            <center>
                                {{ $Signatory->adviser->adviser_signature }}
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