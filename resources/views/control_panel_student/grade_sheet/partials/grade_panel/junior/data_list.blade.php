<h4>
    <span class="logo-mini"><img src="{{ asset('/img/sja-logo.png') }}" style="height: 60px;"></span> 
    <b> Grade-level/Section : <i style="color:red">{{$ClassDetail->grade_level.' '.$ClassDetail->section}}</i></b>
</h4>
<hr/> 
<div class="table-responsive">
    <table class="table no-margin table-bordered">
        <thead>
            <tr>
                <th style="text-align: center">Subject</th>
                <th style="text-align: center">First Grading</th>
                <th style="text-align: center">Second Grading</th>
                <th style="text-align: center">Third Grading</th>
                <th style="text-align: center">Fourth Grading</th>
                <th style="text-align: center">Weighted Average</th>
                <th style="text-align: center">Remarks</th>                                
                <th style="text-align: center">Faculty</th>
            </tr>
        </thead>
        <tbody>            
            @if ($GradeSheetData)
                <?php
                    $showGenAvg = 0;
                ?>
                @foreach ($GradeSheetData as $key => $data)
                    <tr>
                        
                            <td>{{ $data->subject }}</td>
                            @if ($data->grade_status === -1)
                                <td colspan="{{$ClassDetail ? $ClassDetail->section_grade_level <= 10 ? '6' : '4' : '6'}}" class="text-center text-red">Grade not yet finalized</td>
                            @else 
                                    <td class="text-center">{{ $data->fir_g ? $data->fir_g > 0  ? round($data->fir_g) : '' : '' }}</td>
                                    <td class="text-center">{{ $data->sec_g ? $data->sec_g > 0  ? round($data->sec_g) : '' : '' }}</td>
                                    <td class="text-center">{{ $data->thi_g ? $data->thi_g > 0  ? round($data->thi_g) : '' : '' }}</td>
                                    <td class="text-center">{{ $data->fou_g ? $data->fou_g > 0  ? round($data->fou_g) : '' : '' }}</td>

                                    @if ($data->fir_g == 0 && $data->sec_g  == 0 && $data->thi_g  == 0 && $data->fou_g == 0)
                                    
                                        @if ($data->fir_g == 0 && $data->sec_g  == 0 && $data->thi_g  == 0 && $data->fou_g == 0)
                                            <td class="text-center"></td>
                                            <td class="text-center"></td> 
                                        @else
                                            <td class="text-center">
                                                {{ $data->final_g ? round($data->final_g) : '' }}
                                            </td> 
                                            <td style="color:{{ round($final_ave) >= 75 ? 'green' : 'red' }};">
                                                
                                                    <strong>
                                                        {{ round($final_ave) >= 75 ? 'Passed' : 'Failed' }}
                                                    </strong>
                                                
                                            </td>                                                
                                        @endif                                                     
                                        
                                    @else                                                        
                                        @if ($data->fir_g == 0 || $data->sec_g  == 0 || $data->thi_g  == 0 || $data->fou_g == 0)
                                            <td class="text-center"></td>
                                            <td class="text-center"></td> 
                                        @else
                                            <td class="text-center">
                                                
                                                    <?php echo round($final_ave = (round($data->fir_g) + round($data->sec_g) + round($data->thi_g) + round($data->fou_g)) / 4) ?>
                                                
                                            </td> 
                                            <td style="color:{{ round($final_ave) >= 75 ? 'green' : 'red' }};">
                                                
                                                    <strong>
                                                        {{ round($final_ave) >= 75 ? 'Passed' : 'Failed' }}
                                                    </strong>
                                                
                                            </td>                                                
                                        @endif           
                                    @endif              
                                    
                                    <td class="text-left">
                                        <?php                                                   
                                            $faculty = \App\ClassSubjectDetail::where('id', $data->class_subject_details_id)->first();
                                            $faculty_name = \App\FacultyInformation::where('id', $faculty->faculty_id)->first();
                                            echo $faculty_name->last_name.', '.$faculty_name->first_name.' '.$faculty_name->middle_name;                                             
                                        ?>
                                    </td>
                                    
                            @endif                        
                        
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if($student_attendance != '')
        @include('control_panel_student.grade_sheet.partials.grade_panel.junior.data_junior')
    @endif
</div>