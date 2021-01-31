                        <div class="float-right">
                            {{ $RegistrarInformation ? $RegistrarInformation->links() : '' }}
                        </div>
                        <table class="table table-sm table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($RegistrarInformation)
                                    @foreach ($RegistrarInformation as $data)
                                        <tr>
                                            <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                                            <td>{{ $data->user->username }}</td>
                                            {{--  <td> {{ \App\RegistrarInformation::DEPARTMENTS[$data->department_id]['department_name'] }} {{ $data->department_id }}</td>  --}}
                                            {{--  <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td>  --}}
                                            <td>
                                                <span class="badge badge-{{ $data->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Action</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}">Edit</a>
                                                        @if($isAdmin->role == 1)
                                                        <a href="#" class="dropdown-item js-btn_reset_pw" data-id="{{ $data->id }}" data-type="registrar">
                                                                Reset Password
                                                            </a>
                                                        <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">
                                                            Deactivate
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>