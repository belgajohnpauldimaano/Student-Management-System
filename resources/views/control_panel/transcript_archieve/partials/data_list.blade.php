                        <div class="float-right">
                            {{ $TrascriptArhieve ? $TrascriptArhieve->links() : '' }}
                        </div>
                        <table class="table table-sm table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>School Year Graduated</th>
                                    <th>TOR Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($TrascriptArhieve)
                                    @foreach ($TrascriptArhieve as $data)
                                        <tr>
                                            <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                                            <td>{{ $data->school_year_graduated }}</td>
                                            {{--  <td>{{ (collect(\App\TrascriptArhieve::DEPARTMENTS)->firstWhere('id', $data->department_id)['department_name']) }}</td>  --}}
                                            <td>
                                                <span class="badge badge-{{ $data->file_name ? 'success' : 'danger' }}">
                                                    {{ $data->file_name ? 'Available' : 'Not Available' }}
                                                </span>
                                                
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Action</button>
                                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-left">
                                                        <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="#" class="dropdown-item js-btn_delete" data-id="{{ $data->id }}"><i class="fa fa-trash"></i> Delete</a>
                                                        <a href="#" class="dropdown-item js-btn_download" data-id="{{ $data->id }}" data-file="{{ $data->file_name }}"><i class="fa fa-download"></i> Download TOR</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>