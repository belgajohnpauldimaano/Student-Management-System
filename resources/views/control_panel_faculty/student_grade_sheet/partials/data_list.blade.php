                        <h4>Subject : <span class="text-red"><i>{{ $ClassSubjectDetail->subject }}</i></span> Time : <span class="text-red"><i>{{ strftime('%r',strtotime($ClassSubjectDetail->class_time_from)) . ' - ' . strftime('%r',strtotime($ClassSubjectDetail->class_time_to)) }}</i></span> Days : <span class="text-red"><i>{{ $ClassSubjectDetail->class_days }}</i></span></h4>
                        <h4>Grade & Section : <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                        <div class="pull-right">
                            {{ $Enrollment ? $Enrollment->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    {{--  <th>Subject ID</th>  --}}
                                    <th>First Grading</th>
                                    <th>Second Grading</th>
                                    <th>Third Grading</th>
                                    <th>Fourth Grading</th>
                                    <th>Final Grading</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Enrollment)
                                    @foreach ($Enrollment as $key => $data)
                                        <tr data-student_enrolled_subject_id="{{ $data->student_enrolled_subject_id }}" data-student_id="{{ $data->id }}" data-enrollment_id="{{ $data->enrollment_id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->student_name }}</td>
                                            {{--  <td>{{ $data->student_enrolled_subject_id }}</td>  --}}
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" {{ $data->fir_g_status ? "readonly='readonly'" : '' }} class="input-sm form-control grade-input-{{ $data->student_enrolled_subject_id }}" value="{{ $data->fir_g }}" id="first_grading_{{ $data->student_enrolled_subject_id }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-flat btn--save-grade" data-grading="first" {{ $data->fir_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" {{ $data->sec_g_status ? "readonly='readonly'" : '' }}  class="input-sm form-control" value="{{ $data->sec_g }}" id="second_grading_{{ $data->student_enrolled_subject_id }}">
                                                    <span class="input-group-btn">
                                                        <button  class="btn btn-sm bg-purple btn-flat btn--save-grade" data-grading="second" {{ $data->sec_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" {{ $data->thi_g_status ? "readonly='readonly'" : '' }} class="input-sm form-control" value="{{ $data->thi_g }}" id="third_grading_{{ $data->student_enrolled_subject_id }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm bg-orange btn-flat btn--save-grade" data-grading="third" {{ $data->thi_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                <input type="number" {{ $data->fou_g_status ? "readonly='readonly'" : '' }} class="input-sm form-control" value="{{ $data->fou_g }}" id="fourth_grading_{{ $data->student_enrolled_subject_id }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm bg-green btn-flat btn--save-grade" data-grading="fourth" {{ $data->fou_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-red">
                                                    <strong>
                                                        {{ (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / 4)  }}
                                                    </strong>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>