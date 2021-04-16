
<div class="table-responsive" style="height: 350px;">
    <div class="float-right">
        {{ $Assessment ? $Assessment->links() : '' }}
    </div>
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>Assessment Name</th>
                <th class="text-center">Exam Period</th>
                <th class="text-center">Date Publish</th>
                <th class="text-center">Date Expiration</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Assessment as $item)
                @if($tab == 'new')
                    @if($dt->between($item->date_time_publish, $item->date_time_expiration, true))
                        @include('control_panel_student.assessments.assessment_subject_details.partials.data_table')
                    @endif
                @else
                    @if($item->date_time_expiration < $dt->toDateTimeString())
                        @include('control_panel_student.assessments.assessment_subject_details.partials.data_table')
                    @endif
                @endif
            @empty
                <tr>
                    <th colspan="6" class="text-center">
                        No Record Found
                    </th>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>