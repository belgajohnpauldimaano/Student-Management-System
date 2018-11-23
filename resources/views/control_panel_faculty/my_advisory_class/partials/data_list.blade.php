                        
                        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>

                        <table class="table no-margin">
                                <thead>
                                    <tr>
                                        
                                        <th>Student Name</th>
                                        {{--  <th>Subject ID</th>  --}}
                                        
                                    {{--  @if ($ClassSubjectDetail->grade_level >= 11) 
                                        <th>First Semister</th>
                                        <th>Second Semister</th>
                                    @elseif($ClassSubjectDetail->grade_level <= 10)  --}}
                                    @foreach ($AdvisorySubject as $sub)
                                     <th><center>{{$sub->subject}}</center></th>
                                     
                                    {{--  @endif  --}}
                                        
                                    @endforeach

                                        <th>Final Grading</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($EnrollmentMale)
                                        @if ($ClassSubjectDetail->grading_status == 2)
                                            @foreach ($EnrollmentMale as $key => $data)
                                                <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $data->student_name }}</td>
                                                    <td>
                                                        <center>{{$data->fir_g}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$data->sec_g}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$data->thi_g}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$data->fou_g}}</center>
                                                    </td>
                                                    <td>
                                                        <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                                            <strong>
                                                                    <center>
                                                                        <?php
                                                                            $g_ctr = 0;
                                                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                            $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                            $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                        ?>
                                                                        {{ ($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                                                    </center>
                                                            </strong>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($EnrollmentMale as $key => $data)
                                                <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $data->student_name }}</td>
                                                    {{--  <td>{{ $data->student_enrolled_subject_id }}</td>  --}}
                                                    <td>
                                                        <div class="input-group" data-grading="{{ base64_encode('first') }}">
                                                            <input type="number" {{ $data->fir_g_status ? "readonly='readonly'" : '' }} class="input-sm txt-grade_input form-control grade-input-{{ $data->student_enrolled_subject_id }}" value="{{ round($data->fir_g) }}" id="first_grading_{{ $data->student_enrolled_subject_id }}">
                                                            {{--  <span class="input-group-btn">
                                                                <button class="btn btn-sm btn-primary btn-flat btn--save-grade" data-grading="first" {{ $data->fir_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                            </span>  --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group" data-grading="{{ base64_encode('second') }}">
                                                            <input type="number" {{ $data->sec_g_status ? "readonly='readonly'" : '' }}  class="input-sm txt-grade_input form-control" value="{{ round($data->sec_g) }}" id="second_grading_{{ $data->student_enrolled_subject_id }}">
                                                            {{--  <span class="input-group-btn">
                                                                <button  class="btn btn-sm bg-purple btn-flat btn--save-grade" data-grading="second" {{ $data->sec_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                            </span>  --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group" data-grading="{{base64_encode('third')}}">
                                                            <input type="number" {{ $data->thi_g_status ? "readonly='readonly'" : '' }} class="input-sm txt-grade_input form-control" value="{{ round($data->thi_g) }}" id="third_grading_{{ $data->student_enrolled_subject_id }}">
                                                            {{--  <span class="input-group-btn">
                                                                <button class="btn btn-sm bg-orange btn-flat btn--save-grade" data-grading="third" {{ $data->thi_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                            </span>  --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group" data-grading="{{base64_encode('fourth')}}">
                                                        <input type="number" {{ $data->fou_g_status ? "readonly='readonly'" : '' }} class="input-sm txt-grade_input form-control" value="{{ round($data->fou_g) }}" id="fourth_grading_{{ $data->student_enrolled_subject_id }}">
                                                            {{--  <span class="input-group-btn">
                                                                <button class="btn btn-sm bg-green btn-flat btn--save-grade" data-grading="fourth" {{ $data->fou_g_status ? "disabled='disabled'" : '' }} title="Save grade and finalize"><i class="fa fa-check"></i> Save</button>
                                                            </span>  --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                                            <strong>
                                                                <?php
                                                                    $g_ctr = 0;
                                                                    $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                                    $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                                    $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                                    $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                                ?>
                                                                {{ ($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                                            </strong>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </tbody>
                        </table>