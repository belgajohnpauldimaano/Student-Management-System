@if($type == 'average')
        
    @if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12)
        <h4>Semester: <span class="text-red"><i>{{ $sem }}</i></span> Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>                        
        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
        
        @include('control_panel_faculty.my_advisory_class.partials.data_button_print')

        <div class="table-responsive">
            @include('control_panel_faculty.my_advisory_class.partials.data_senior')
        </div>
    @else
    {{-- Junior Highschool --}}
        <h4>Quarter: <span class="text-red"><span class="text-red"><i>{{ $quarter }}</i></span></h4>
                    
        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
        
        @include('control_panel_faculty.my_advisory_class.partials.data_button_print')                    
        @include('control_panel_faculty.my_advisory_class.partials.data_junior')            
    @endif
             
@else     
          
    @if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12)
        <h4>Semester: <span class="text-red"><i>{{ $sem }}</i></span> Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
        @include('control_panel_faculty.my_advisory_class.partials.data_button_print')
        @include('control_panel_faculty.my_advisory_class.partials.data_senior_gradesheet')
    
    @elseif($ClassSubjectDetail->grade_level == 7 || $ClassSubjectDetail->grade_level == 8 || $ClassSubjectDetail->grade_level == 9)
        <h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
    
        @include('control_panel_faculty.my_advisory_class.partials.data_button_print')

        @if($quarter == 'Fourth')
            <div class="table-responsive">
                                           
            </div>
        @else
            <div class="table-responsive">
                                            
        @endif
    @else
        
        <h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
        @include('control_panel_faculty.my_advisory_class.partials.data_button_print')          
        @if($quarter == 'Fourth')
           
        @else
            
        @endif
    @endif
 @endif