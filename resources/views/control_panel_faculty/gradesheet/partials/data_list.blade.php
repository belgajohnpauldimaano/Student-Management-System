<h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
<h4>Grade &amp; Section: <span class="text-red"><i>{{ $class_detail->grade->id . '-' .$class_detail->section->section }}</i></span></h4>

@if($class_detail->grade->id < 11)
    @include('control_panel_faculty.gradesheet.partials.data_list_junior')
@endif

@if($class_detail->grade->id > 10)
    @include('control_panel_faculty.gradesheet.partials.data_list_senior')
@endif



