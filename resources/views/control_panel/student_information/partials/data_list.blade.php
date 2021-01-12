                        <div class="pull-right">
                            {{ $StudentInformation ? $StudentInformation->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Gender</th>
                                    <th>Parent/Guardian</th>
                                    <th>Address</th>
                                    <th>Login URL <i style="color: red">(use other browser)</i></th>
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
                                            <td  width="5%">{{ $data->loginlink }}</td>
                                            <td>
                                                <span class="label label-{{ $data->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td width="15%">
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                        Action <span class="fa fa-caret-down"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @if ($data->enrolled_class) 
                                                            <li>
                                                                <a href="#" class="js-btn_print_grade" data-id="{{ $data->id }}">
                                                                    Print Grade
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a href="#" class="js-btn_update_sy" data-id="{{ $data->id }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        @if($isAdmin->role == 1)
                                                            <li>
                                                                <a href="#" class="js-btn_reset_pw" data-id="{{ $data->id }}" data-type="student">
                                                                    Reset Password
                                                                </a>
                                                            </li>
                                                            @if($data->status == 1)
                                                                <li>
                                                                    <a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">
                                                                        Deactivate
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if($data->status == 0)
                                                                <li>
                                                                    <a href="#" class="js-btn_activate" data-id="{{ $data->id }}">
                                                                        Activate
                                                                    </a>
                                                                </li>
                                                            @endif

                                                        @endif
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>