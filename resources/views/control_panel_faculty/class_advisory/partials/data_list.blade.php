<div class="pull-right">
    {{ $ClassDetail ? $ClassDetail->links() : '' }}
</div>
<table class="table no-margin">
    <thead>
        <tr>
            <th>School Year</th>
            <th>Room</th>
            <th>Grade Level</th>
            <th>Section</th>
            <th>Status</th>
            <th width="15%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($ClassDetail)
            @foreach ($ClassDetail as $data)
                <tr>
                    <td>{{ $data->schoolYear->school_year }} </td>
                    <td>{{ $data->room->room_code }}</td>
                    <td>{{ $data->grade_level }}</td>
                    <td>{{ $data->section->section }}</td>
                    <td>{{ $data->status == 0 ? 'Inactive' : 'Active' }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item js-btn_view" href="{{ route('faculty.advisory_class.view') }}?c={{ encrypt($data->id) }}" 
                                    data-id="{{ encrypt($data->id) }}">
                                    Student List
                                </a>
                                <a class="dropdown-item js-btn_gradesheet1" href="{{ route('faculty.student_gradesheet.index') }}?c={{ encrypt($data->id) }}" 
                                    data-id="{{ encrypt($data->id) }}">
                                    Grade Sheet
                                </a>
                            </div>
                        </div>                        
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>