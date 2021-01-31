<div class="float-right">
    {{ $ClassDetail ? $ClassDetail->links() : '' }}
</div>
<table class="table no-margin table-sm table-hover">
    <thead>
        <tr>
            <th>School Year</th>
            <th>Room</th>
            <th>Grade Level</th>
            <th>Section</th>
            <th>Adviser</th>
            <th>Status</th>
            <th>Actions</th>
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
                    <td>{{ $data->adviserData->full_name }}</td>
                    <td>
                        <span class="badge badge-{{ $data->status == 1 ? 'success' : 'danger' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td width="17%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <input type="hidden" name="school_year_id" value="{{ $data->schoolyearid }}">                                
                                <a href="#" class="dropdown-item js-btn_update" data-id="{{ $data->id }}">Edit</a>
                                <a href="{{ route('registrar.class_subjects', $data->id) }}" class="dropdown-item" data-id="{{ $data->id }}">Manage Subjects</a>
                                <a href="{{ route('registrar.student_enrollment', $data->id) }}" class="dropdown-item" data-id="{{ $data->id }}">Enroll Student</a>
                                <a href="{{ route('registrar.student_enrolled_list', $data->id) }}" class="dropdown-item" data-id="{{ $data->id }}">Student List Enrolled</a>
                                <a href="#" class="dropdown-item js-btn_deactivate" class="dropdown-item" data-id="{{ $data->id }}">Deactivate</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>