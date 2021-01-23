


<h4 style="margin-top: 20px">
    <b>Second Semester</b>
</h4>

<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered no-margin w-100">
        <thead>
            <tr>
                <th style="text-align: center">Subject</th>
                <th style="text-align: center">First Quarter</th>
                <th style="text-align: center">Second Quarter</th>
                <th style="text-align: center">Weighted Average</th>
                <th style="text-align: center">Remarks</th>                                
                <th style="text-align: center">Faculty</th>
            </tr>
        </thead>
        <tbody>    
            @if($Enrollment_secondsem->count() > 0)              
                @forelse($Enrollment_secondsem as $key => $data)
                    <tr>
                        <td>
                            {{$data['subject']->subject}}
                        </td>                        
                        <td style="text-align: center">
                            {{round($data['thi_g'])}}
                        </td>
                        <td style="text-align: center">
                            {{round($data['fou_g'])}}             
                        </td>
                        <td style="text-align: center">
                            @if($data['thi_g'] != 0 && $data['fou_g'] != 0)
                                {{round($data['final_g'])}}
                            @endif
                        </td>
                        @if($data['final_g'])
                            @if($data['thi_g'] != 0 && $data['fou_g'] != 0)                                
                                <td style="color:{{ round($data['final_g']) >= 75 ? 'green' : 'red' }};">
                                    <center>
                                        <strong>
                                            {{ round($data['final_g']) >= 75 ? 'Passed' : 'Failed' }}
                                        </strong>
                                    </center>
                                </td> 
                            @else    
                                <td></td>   
                            @endif
                        @else    
                            <td></td>   
                        @endif    
                        <td>
                            {{$data['faculty_name']}}        
                        </td> 
                    </tr>
                @empty
                <tr>
                    <th class="text-center" colspan="6">
                        No Data for Second Semester.   
                    </th> 
                </tr>
                @endforelse
            @else
                <tr>
                    <th class="text-center" colspan="6">
                        No Data for Second Semester.   
                    </th> 
                </tr>
            @endif     
        </tbody>
    </table>
    @if($Enrollment_secondsem->count() > 0) 
        @if($student_attendance2 !='')
            @include('control_panel_student.grade_sheet.partials.grade_panel.senior.second_sem.attendance')
        @endif
    @endif
</div>