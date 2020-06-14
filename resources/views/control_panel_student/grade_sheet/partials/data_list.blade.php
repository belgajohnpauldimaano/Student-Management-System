<div class="box-body">
    @if($GradeSheet != 0)
        @if ($grade_level >= 11)         
            <?php 
                $Semester = \App\Semester::where('current', 1)->first()->id; 
            ?>
            <h3>
                <span class="logo-mini"><img src="{{ asset('/img/sja-logo.png') }}" style="height: 60px;"></span> Grade-level/Section : <i style="color:red">{{ $ClassDetail->grade_level .' - '. $ClassDetail->section}}</i>
            </h3>
            
            @include('control_panel_student.grade_sheet.partials.grade_panel.senior.first_sem.data_list')
        <hr>
            @include('control_panel_student.grade_sheet.partials.grade_panel.senior.second_sem.data_list')            
            
        @else           
            @include('control_panel_student.grade_sheet.partials.grade_panel.junior.data_list')       
        @endif
    @else
        <h4>Gradesheet not available this time.</h4>
    @endif
</div>