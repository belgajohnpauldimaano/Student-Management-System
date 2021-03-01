



<div class="table-responsive m-auto">
    <table class="table table-bordered table-sm table-hover w-100">
        <thead>
            <tr>
                <th class="text-center" colspan="6">
                    <h5>First Semester</h5>
                </th>
            </tr>
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
            @if($Enrollment_first_sem->count() > 0) 
                @forelse($Enrollment_first_sem as $key => $data)
                    <tr>
                        <td>
                            {{$data['subject']->subject ? $data['subject']->subject : $data->subject->subject}}
                        </td>                        
                        <td style="text-align: center">
                            {{round($data['fir_g'])}}
                        </td>
                        <td style="text-align: center">
                            {{round($data['sec_g'])}}             
                        </td>
                        <td style="text-align: center">
                            @if($data['fir_g'] != 0 && $data['sec_g'] != 0)
                                {{round($data['final_g'])}}
                            @endif
                        </td>
                        @if($data['final_g'])
                            @if($data['fir_g'] != 0 && $data['sec_g'] != 0)                                
                                <td class="text-center" style="color:{{ round($data['final_g']) >= 75 ? 'green' : 'red' }};">
                                        <strong>
                                            {{ round($data['final_g']) >= 75 ? 'Passed' : 'Failed' }}
                                        </strong>
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

    @if($Enrollment_first_sem->count() > 0)
        @if($student_attendance1 !='')
            @include('control_panel_student.grade_sheet.partials.grade_panel.senior.first_sem.attendance')
        @endif
    @endif
</div>