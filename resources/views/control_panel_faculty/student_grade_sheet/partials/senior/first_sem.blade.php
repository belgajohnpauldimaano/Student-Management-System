<div class="row">
<div class="col-md-12 m-auto">
        <button class="btn btn-primary float-right mb-1" id="js-btn_print_sem1" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
        <table class="table no-margin table-sm table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                   
                    <th >First Quarter</th>
                    <th >Second Quarter</th>
                    <th style="text-align:center">Final Grading</th>
                </tr>
            </thead>
            <tbody>
               
                    @if ($EnrollmentMale)
                        @if ($ClassSubjectDetail->grading_status == 2)
                            @foreach ($EnrollmentMale as $key => $data)
                                <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $data->student_name }}</td>
                                    <td>
                                        <center>{{$data->fir_g}}</center>
                                    </td>
                                    <td>
                                        <center>{{$data->sec_g}}</center>
                                    </td>
                                    
                                    <td>
                                        <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                            <strong>
                                                    <center>
                                                        @php
                                                            $g_ctr = 0;
                                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                            $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                            $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                        @endphp
                                                        {{ ($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                                    </center>
                                            </strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="7">
                                        <b>Male</b>
                                    </td>
                                </tr>
                            @foreach ($EnrollmentMale as $key => $data)
                                <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $data->student_name }}</td>
                                    
                                    <td>
                                        <div class="input-group input-group-sm" data-grading="{{ base64_encode('first') }}">
                                            <input style ="text-align: center" type="number" {{ $data->fir_g_status ? "readonly='readonly'" : '' }} class="input-sm txt-grade_input form-control grade-input-{{ $data->student_enrolled_subject_id }}" 
                                            value="{{ $data->fir_g <= 0.00 ? "" : round($data->fir_g) }}" id="first_grading_{{ $data->student_enrolled_subject_id }}">
                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="{{ $ClassSubjectDetail->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm" data-grading="{{ base64_encode('second') }}">
                                            <input style ="text-align: center" type="number" {{ $data->sec_g_status ? "readonly='readonly'" : '' }}  class="input-sm txt-grade_input form-control" 
                                            value="{{ $data->fir_g <= 0.00 ? "" : round($data->sec_g) }}" id="second_grading_{{ $data->student_enrolled_subject_id }}">
                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="{{ $ClassSubjectDetail->id }}">
                                        </div>
                                    </td>
                                   
                                    <td>
                                        <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                            <strong>
                                                <center>
                                                @php
                                                    $g_ctr = 0;
                                                    $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                    $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                    $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                    $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                @endphp
                                                {{ ($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                                </center>
                                            </strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    <tr>
                        <td colspan="7">
                            <b>Female</b>
                        </td>
                    </tr>
                    @if ($EnrollmentFemale)
                        @if ($ClassSubjectDetail->grading_status == 2)
                            @foreach ($EnrollmentFemale as $key => $data)
                                <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $data->student_name }}</td>
                                    <td>
                                        <center>{{$data->fir_g}}</center>
                                    </td>
                                    <td>
                                        <center>{{$data->sec_g}}</center>
                                    </td>
                                    
                                    <td>
                                        <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                            <strong>
                                                    <center>
                                                        @php
                                                            $g_ctr = 0;
                                                            $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                            $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                            $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                            $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                        @endphp
                                                        {{ ($g_ctr ? (($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                                    </center>
                                            </strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($EnrollmentFemale as $key => $data)
                                <tr data-student_enrolled_subject_id="{{ base64_encode($data->student_enrolled_subject_id) }}" data-student_id="{{ base64_encode($data->id) }}" data-enrollment_id="{{ base64_encode($data->enrollment_id) }}">
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $data->student_name }}</td>                                                                
                                    <td>
                                        <div class="input-group input-group-sm" data-grading="{{ base64_encode('first') }}">
                                            <input style ="text-align: center" type="number" {{ $data->fir_g_status ? "readonly='readonly'" : '' }} class="input-sm txt-grade_input form-control grade-input-{{ $data->student_enrolled_subject_id }}" 
                                            value="{{ $data->fir_g <= 0.00 ? "" : round($data->fir_g) }}" id="first_grading_{{ $data->student_enrolled_subject_id }}">
                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="{{ $ClassSubjectDetail->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm" data-grading="{{ base64_encode('second') }}">
                                            <input style ="text-align: center" type="number" {{ $data->sec_g_status ? "readonly='readonly'" : '' }}  class="input-sm txt-grade_input form-control" 
                                            value="{{ $data->sec_g <= 0.00 ? "" : round($data->sec_g) }}" id="second_grading_{{ $data->student_enrolled_subject_id }}">
                                            <input id="classSubjectDetailID" name="classSubjectDetailID" type="hidden" value="{{ $ClassSubjectDetail->id }}">
                                            
                                        </div>
                                    </td>
                                   
                                    <td>
                                        <span class="text-red final-ratings_{{ $data->student_enrolled_subject_id }}">
                                            <strong>
                                                <center>
                                                @php
                                                    $g_ctr = 0;
                                                    $g_ctr += $data->fir_g > 0 ? 1 : 0;
                                                    $g_ctr += $data->sec_g > 0 ? 1 : 0;
                                                    $g_ctr += $data->thi_g > 0 ? 1 : 0;
                                                    $g_ctr += $data->fou_g > 0 ? 1 : 0;
                                                @endphp
                                                {{ ($g_ctr ? round(($data->fir_g + $data->sec_g + $data->thi_g + $data->fou_g) / $g_ctr) : 0)  }}
                                                </center>
                                            </strong>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                {{--  @endif  --}}
            </tbody>
        </table>
</div>
</div>