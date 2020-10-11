                        <div class="pull-right">
                            {{ $ClassDetail ? $ClassDetail->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Room</th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($ClassDetail)
                                    @foreach ($ClassDetail as $data)
                                        <tr>
                                            <td>{{ $data->school_year }} </td>
                                            <td>{{ $data->room_code }}</td>
                                            <td>{{ $data->grade_level }}</td>
                                            <td>{{ $data->section }}</td>
                                            <td>{{ $data->status == 0 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('faculty.advisory_class.view') }}?c={{ encrypt($data->id) }}" class="js-btn_view" data-id="{{ encrypt($data->id) }}">
                                                                View
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('faculty.my_advisory_class.index') }}?c={{ encrypt($data->id) }}" class="js-btn_gradesheet" data-id="{{ encrypt($data->id) }}">
                                                                Grade Sheet
                                                            </a>
                                                        </li>

                                                         <li>
                                                            <a href="{{ route('faculty.student_gradesheet.index') }}?c={{ encrypt($data->id) }}" class="js-btn_gradesheet1" data-id="{{ encrypt($data->id) }}">
                                                                Grade Sheet2
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>