                        <div class="pull-right">
                            {{ $ClassSubjectDetail ? $ClassSubjectDetail->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject</th>
                                    <th>Time</th>
                                    <th>Faculty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($ClassSubjectDetail)
                                    @foreach ($ClassSubjectDetail as $data)
                                        <tr>
                                            <td>{{ $data->subject_code }}</td>
                                            <td>{{ $data->subject }}</td>
                                            <td>{{ $data->class_time_from . ' - ' . $data->class_time_to }}</td>
                                            <td>{{ $data->faculty_name }}</td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update" data-id="{{ $data->id }}">Edit</a></li>
                                                        {{--  <li><a href="#" class="js-btn_manage_subjects" data-id="{{ $data->id }}">Manage Subjects</a></li>  --}}
                                                        <li><a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a></li>
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>