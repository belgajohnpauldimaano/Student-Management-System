<div class="float-right">
    {{ $FacultyInformation ? $FacultyInformation->links() : '' }}
</div>
<table class="table table-sm table-hover no-margin">
    <thead>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>No. of Handled Subjects</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($FacultyInformation)
            @foreach ($FacultyInformation as $data)
                <tr>
                    <td>{{ $data->full_name }}</td>
                    <td>{{ collect(\App\Models\FacultyInformation::DEPARTMENTS)->firstWhere('id', $data->department_id)['department_name'] }}</td>
                    <td class="text-center">
                        {{ $data->subjects_count }}
                    </td>                                            
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item js-btn_view_class_schedule" data-id="{{ $data->id }}">
                                    View Handled Subjects
                                </a>
                                <a href="#" class="dropdown-item js-btn_report" data-id="{{ $data->id }}">
                                    Print Subjects
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>