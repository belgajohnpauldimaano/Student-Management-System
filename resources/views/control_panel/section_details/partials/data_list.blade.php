                        <div class="float-right">
                            {{ $SectionDetail ? $SectionDetail->links() : '' }}
                        </div>
                        <table class="table table-sm table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Grade Level</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($SectionDetail)
                                    @foreach ($SectionDetail as $data)
                                        <tr>
                                            <td>{{ $data->section }}</td>
                                            <td>Grade {{ $data->grade_level }}</td>
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
                                                        <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>