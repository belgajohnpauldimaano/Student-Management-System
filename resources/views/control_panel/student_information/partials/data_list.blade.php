                        <div class="float-right">
                            {{ $StudentInformation ? $StudentInformation->links() : '' }}
                        </div>
                        <table class="table table-sm table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Gender</th>
                                    <th>Parent/Guardian</th>
                                    <th>Address</th>
                                    @if($isAdmin->role == 1)
                                    <th>Login URL <i style="color: red">(use other browser)</i></th>
                                    @endif
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($StudentInformation)
                                    @foreach ($StudentInformation as $data)
                                        <tr>
                                            <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                                            <td>{{ $data->user->username }}</td>
                                            <td>{{ ($data->gender == 1 ? 'Male' : 'Female') }}</td>
                                            {{-- <td>{{ $data->birthdate ? date_format(date_create($data->birthdate), 'F d, Y') : '' }}</td> --}}
                                            <td>{{ $data->guardian }}</td>
                                            <td>{{ $data->c_address }}</td>
                                            @if($isAdmin->role == 1)
                                                <td  width="5%">{{ $data->loginlink }}</td>
                                            @endif
                                            <td>
                                                <span class="badge badge-{{ $data->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td width="15%">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Action</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($data->enrolled_class) 
                                                            <a href="#" class="dropdown-item js-btn_print_grade" data-id="{{ $data->id }}">
                                                                Print Grade
                                                            </a>
                                                        @endif
                                                        <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}">
                                                            Edit
                                                        </a>
                                                        @if($isAdmin->role == 1)
                                                            <a href="#" class="dropdown-item js-btn_reset_pw" data-id="{{ $data->id }}" data-type="student">
                                                                Reset Password
                                                            </a>
                                                            @if($data->status == 1)
                                                                <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">
                                                                    Deactivate
                                                                </a>
                                                            @endif
                                                            @if($data->status == 0)
                                                                <a href="#" class="dropdown-item js-btn_activate" data-id="{{ $data->id }}">
                                                                    Activate
                                                                </a>
                                                            @endif

                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>