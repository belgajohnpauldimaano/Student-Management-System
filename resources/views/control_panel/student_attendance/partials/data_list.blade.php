                        <div class="pull-right">
                            {{-- {{ $SchoolYear ? $SchoolYear->links() : '' }} --}}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Student Attendance</th>
                                    <th>Student Attendance</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendance as $item)
                                    <tr>
                                        <td>{{ $data->school_year_id }}</td>
                                        <td>{{ $data->junior_attendance }}</td>
                                        <td>{{ $data->s1_attendance }}</td>
                                        <td>{{ $data->s2_attendance }}</td>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td>                                            
                                        <td>
                                            {{-- <div class="input-group-btn pull-left text-left">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                    <span class="fa fa-caret-down"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="js-btn_update_sy" data-id="{{ $data->id }}">Edit</a></li>
                                                    <li><a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a></li>
                                                    <li><a href="#" class="js-btn_toggle_current" data-id="{{ $data->id }}" data-toggle_title="{{ ( $data->current ? 'Remove from current active' : 'Add to current active' ) }}">{{ ( $data->current ? 'Remove from current Active' : 'Add to current Active' ) }}</a></li>
                                                </ul>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            <b>No Attendance Record Yet</b>
                                        </td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>