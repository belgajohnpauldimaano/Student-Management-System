                        <div class="pull-right">
                            {{ $attendance ? $attendance->links() : '' }}
                        </div>
                        <table class="table no-margin table-hover">
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
                                        <td>{{ $item['is_applied'] == 1 ? 'Yes' : 'No' }}</td>    
                                        <td>{{ $item['status'] == 1 ? 'Active' : 'Inactive' }}</td>                                                                                
                                        <td width="15%">
                                            <div class="input-group-btn pull-left text-left">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                    <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#" class="js-btn_apply" 
                                                                data-id="{{ $item['id'] }}"
                                                                data-sy="{{ $item['school_year_id'] }}"
                                                                data-school_year="{{ $item['school_year'] }}"
                                                                data-toggle_title="{{ ( $item['is_applied'] == '1' ? 'Not Apply' : 'Apply' ) }}">
                                                                {{ ( $item['is_applied'] == '1' ? 'Not Apply' : 'Apply' ) }}
                                                            </a>
                                                        </li>
                                                        <li><a href="#" class="js-btn_update_sy" data-id="{{ $item['id'] }}">Edit</a></li>
                                                        <li><a href="#" class="js-btn_deactivate" data-id="{{ $item['id'] }}">Deactivate</a></li>
                                                    </ul>
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