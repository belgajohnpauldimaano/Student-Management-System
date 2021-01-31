                        <div class="float-right">
                            {{ $AdmissionInformation ? $AdmissionInformation->links() : '' }}
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
                                @if ($AdmissionInformation)
                                    @foreach ($AdmissionInformation as $data)
                                        <tr>
                                            <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                                            <td>{{ $data->user->username }}</td>
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
                                                        <a class="dropdown-item js-btn_update_sy" href="#" data-id="{{ $data->id }}">
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item js-btn_reset_pw" data-id="{{ $data->id }}" data-type="admission" href="#">
                                                            Reset Password
                                                        </a>
                                                         <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">
                                                            Deactivate
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>