<div class="float-right">
    {{ $FacultyInformation ? $FacultyInformation->links() : '' }}
</div>
<table class="table no-margin table-sm table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Department</th>
            <th>Login URL <i style="color: red">(use other browser)</i></th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        {{-- @if ($FacultyInformation)
            @foreach ($FacultyInformation as $data)
                <tr>
                    <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                    <td width="5%">{{ $data->user->username }}</td>
                    <td width="5%">{{ (collect(\App\Models\FacultyInformation::DEPARTMENTS)->firstWhere('id', $data->department_id)['department_name']) }}</td>
                    <td>{{ $data->loginlink }}</td>
                    <td>
                        <span class="badge badge-{{ $data->status == 1 ? 'success' : 'danger' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td  width="17%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item js-btn_update_sy" href="#" data-id="{{ $data->id }}">
                                    Edit
                                </a>
                                @if($isAdmin->role == 1)                                                            
                                    <a href="#" class="js-btn_reset_pw dropdown-item" data-id="{{ $data->id }}" data-type="faculty">
                                        Reset Password
                                    </a>
                                    <a href="#" class="js-btn_deactivate dropdown-item" data-id="{{ $data->id }}">
                                        Deactivate
                                    </a>
                                @endif
                                <a class="dropdown-item js-btn_view_additional_info" href="#"  data-id="{{ $data->id }}">
                                    View Information
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif --}}
    </tbody>
</table>