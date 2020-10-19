<h4>
    @if(
        $quarter == '1st' && $sem == '1st'      || 
        $quarter == '3rd' && $sem == '2nd'      || 
        $quarter == '1st-2nd' && $sem == '3rd'  || 
        $quarter == '2nd' && $sem == '1st'      || 
        $quarter == '4th' && $sem == '2nd'
    )
        Semester -
    @endif

    Quarter: 

    <span class="text-red">
        <i>
            @if(
                $quarter == '1st' && $sem == '1st'      || 
                $quarter == '3rd' && $sem == '2nd'      || 
                $quarter == '1st-2nd' && $sem == '3rd'  || 
                $quarter == '2nd' && $sem == '1st'      || 
                $quarter == '4th' && $sem == '2nd'
            )
                {{$sem}} -
            @endif
            {{ $quarter }}
        </i>
    </span>
</h4>
<h4>
    Grade &amp; Section: <span class="text-red"><i>{{ $class_detail->grade->id . '-' .$class_detail->section->section }}</i></span>
    <div class="text-right" style="margin-top: -2em">
        <button id="js-print" class="btn btn-flat btn-success" 
            data-id='{{$class_detail->id}}' 
            data-sy='{{$class_detail->school_year_id}}'
            data-adviser_id='{{$class_detail->adviser_id}}'
        >
            <i class="fas fa-file-pdf"></i> Print
        </button>
    </div>    
</h4>

<div>
    @if($class_detail->grade->id < 11)
        @include('control_panel_faculty.gradesheet.partials.data_list_junior')
    @endif

    @if($class_detail->grade->id > 10)
        @include('control_panel_faculty.gradesheet.partials.data_list_senior')
    @endif
</div>