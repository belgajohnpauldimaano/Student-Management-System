<div class="pull-right">
    {{ $ClassDetail ? $ClassDetail->links() : '' }}
</div>
<table class="table no-margin table-hover">
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
                        <span class="label label-{{ $data->status == 1 ? 'success' : 'danger' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td width="17%">
                        <div class="input-group-btn pull-left text-left">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <input type="hidden" name="school_year_id" value="{{ $data->schoolyearid }}">                                
                                <li><a href="#" class="js-btn_update" data-id="{{ $data->id }}">Edit</a></li>
                                <li><a href="{{ route('registrar.class_subjects', $data->id) }}" data-id="{{ $data->id }}">Manage Subjects</a></li>
                                <li><a href="{{ route('registrar.student_enrollment', $data->id) }}" data-id="{{ $data->id }}">Enroll Student</a></li>
                                <li><a href="{{ route('registrar.student_enrolled_list', $data->id) }}" data-id="{{ $data->id }}">Student List Enrolled</a></li>
                                <li><a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>