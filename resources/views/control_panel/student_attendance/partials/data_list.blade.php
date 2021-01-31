                        <div class="float-right">
                            {{ $attendance ? $attendance->links() : '' }}
                        </div>
                        <table class="table table-sm no-margin table-hover">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Student No. of Days (Junior)</th>
                                    <th>Student No. of Days (Senior 1st sem)</th>
                                    <th>Student No. of Days (Senior 2nd sem)</th>
                                    <th>Applied</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendance_data as $item)
                                    <tr>
                                        <td>{{ $item['school_year'] }}</td>
                                        <td>
                                            <table width="60%">
                                                <tr>
                                                    @foreach ($item['attendance_data']->days_of_school as $key => $data)
                                                        {{$data}}
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                             <table width="60%">
                                                <tr>
                                                    @foreach ($item['s1_attendance']->days_of_school as $key => $data)
                                                        {{$data}}
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="60%">
                                                <tr>
                                                    @foreach ($item['s2_attendance']->days_of_school as $key => $data)
                                                        {{$data}}
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <span class="label {{ $item['is_applied'] == 1 ? 'label-success' : 'label-warning' }}">
                                                {{ $item['is_applied'] == 1 ? 'Applied' : 'Not Yet' }}
                                            </span>
                                        </td>    
                                        <td>
                                            <span class="badge {{ $item['status'] == 1 ? 'bg-green' : 'bg-red' }}">
                                                {{ $item['status'] == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>                                                                                
                                        <td width="15%">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger">Action</button>
                                                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="#" class="js-btn_apply dropdown-item" 
                                                        data-id="{{ $item['id'] }}"
                                                        data-sy="{{ $item['school_year_id'] }}"
                                                        data-school_year="{{ $item['school_year'] }}"
                                                        data-toggle_title="{{ ( $item['is_applied'] == '1' ? 'Not Apply' : 'Apply' ) }}">
                                                        {{ ( $item['is_applied'] == '1' ? 'Not Apply' : 'Apply' ) }}
                                                    </a>
                                                    <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $item['id'] }}">Edit</a>
                                                    <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $item['id'] }}">Deactivate</a>
                                                </div>
                                            </div>
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