                        <div class="float-right">
                            {{-- {{ $SchoolYear ? $SchoolYear->links() : '' }} --}}
                        </div>
                        <table class="table table-sm table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Date for Junior</th>
                                    <th>Date for Senior 1st sem</th>
                                    <th>Date for Senior 2nd sem</th>
                                    {{-- <th>Current</th> --}}
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($SchoolYear)
                                    @foreach ($SchoolYear as $data)
                                        <tr>
                                            {{-- <td>{{ $data->school_year }}</td> --}}
                                            <td>
                                                {{ $data->school_year }}
                                            </td>
                                            <td>{{ $data->j_date ? date_format(date_create($data->j_date), 'F d, Y') : '' }}</td>
                                            <td>{{ $data->s_date1 ? date_format(date_create($data->s_date1), 'F d, Y') : '' }}</td>
                                            <td>{{ $data->s_date2 ? date_format(date_create($data->s_date2), 'F d, Y') : '' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $data->status == 1 ? 'success' : 'danger' }}">
                                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            {{-- <td></td> --}}
                                            {{-- <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td>
                                            <td></td> --}}
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Action</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}">Edit</a>
                                                        <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>