<div class="box-body">
    @if($GradeSheet != 0)
        @if ($grade_level >= 11)         
            
            <h3>
                Grade-level/Section : <i style="color:red">
                    @php
                        try {
                            echo $ClassDetail->grade_level .' - '. $ClassDetail->section;
                        } catch (\Throwable $th) {
                            echo 'No Grades and Section';
                        }

                    @endphp
                </i>
            </h3>
            
            @include('control_panel_student.grade_sheet.partials.grade_panel.senior.first_sem.data_list')
        <hr>
            @include('control_panel_student.grade_sheet.partials.grade_panel.senior.second_sem.data_list')   
        @else                     
            @include('control_panel_student.grade_sheet.partials.grade_panel.junior.data_list')                  
        @endif
    @endif
</div>