@php
    $days = $ClassSubjectDetail ? $ClassSubjectDetail->class_schedule ? explode(';', rtrim($ClassSubjectDetail->class_schedule,";")) : [] : [];
    $daysObj = [];
    $daysDisplay = '';
    if ($days) 
    {
        foreach($days as $day)
        {
            $day_sched = explode('@', $day);
            $day = '';
            if ($day_sched[0] == 1) {
                $day = 'M';
            } else if ($day_sched[0] == 2) {
                $day = 'T';
            } else if ($day_sched[0] == 3) {
                $day = 'W';
            } else if ($day_sched[0] == 4) {
                $day = 'TH';
            } else if ($day_sched[0] == 5) {
                $day = 'F';
            }
            $t = explode('-', $day_sched[1]);
            $daysDisplay .= $day . '@' . $t[0] . '-' . $t[1] . '/';
        }
    }
@endphp

<h5>
    Subject : <span class="text-red"><i>{{ $ClassSubjectDetail->id }} {{ $ClassSubjectDetail->subject }}</i></span>
    Schedule : <span class="text-red"><i>{{ rtrim($daysDisplay, '/') }}</i></span>
    <br/>
    Grade & Section : <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span>
    <br/>
    Semester: <span class="text-red"><i>{{ $ClassSubjectDetail ? $ClassSubjectDetail->sem == 1 ? 'First' : 'Second' : '' }}</i></span>
</h5>

@if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12)
    @if($ClassSubjectDetail->sem==1)
        @include('control_panel_faculty.student_grade_sheet.partials.senior.first_sem')
    @else
        @include('control_panel_faculty.student_grade_sheet.partials.senior.second_sem')
    @endif
@else
    @include('control_panel_faculty.student_grade_sheet.partials.junior.data_list')
@endif