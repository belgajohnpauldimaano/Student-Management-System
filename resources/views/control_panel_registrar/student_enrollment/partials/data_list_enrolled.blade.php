@if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)                   
    <div class="float-right">
        <button type="button" style="margin-right:2px" class="btn btn-sm btn-danger mb-2 js-btn_re_enroll_all_student" aria-expanded="true">
            Re-Enroll All (2nd Semester)
        </button>
        {{ $Enrollment ? $Enrollment->links() : '' }}
    </div>
    <table class="table table-sm table-hover no-margin table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($Enrollment)
                @foreach ($Enrollment as $key => $data)
                    <tr>
                        <td> {{ $key + 1 }}.</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ ucwords(($data->full_name)) }}</td>
                        <td>
                            <div class="input-group-btn btn-sm float-left text-left">
                                @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)
                                    <button 
                                        type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-danger js-btn_cancel_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true"
                                    >
                                        Cancel Enroll
                                    </button>
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-primary js-btn_re_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true"
                                    >
                                        Re-Enroll
                                    </button>
                                @else                                
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-danger js-btn_cancel_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true"
                                    >
                                        Cancel Enroll
                                    </button>
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-primary js-btn_re_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true"
                                    >
                                        Re-Enroll
                                    </button>
                                @endif
                                {{-- <button type="button" 
                                    style="margin-right:2px" 
                                    class="btn btn-sm btn-success js-btn_drop_student" 
                                    data-student_id="{{$data->student_information_id}}" 
                                    data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                    Drop
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@else
    <div class="float-right">
        <button type="button" style="margin-right:2px" class="btn btn-sm mb-2 btn-danger js-btn_re_enroll_all_student" aria-expanded="true">
            Re-Enroll All
        </button>
        {{ $Enrollment ? $Enrollment->links() : '' }}
    </div> 
    <table class="table table-sm table-hover no-margin table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($Enrollment)
                @foreach ($Enrollment as  $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}.</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->full_name }}</td>
                        <td>
                            <div class="input-group-btn btn-sm float-left text-left">
                                @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-danger js-btn_cancel_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Cancel Enroll
                                    </button>
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-primary js-btn_re_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Re-Enroll
                                    </button>
                                @else                                                            
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-danger js-btn_cancel_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Cancel Enroll
                                    </button>
                                    <button type="button" 
                                        style="margin-right:2px" 
                                        class="btn btn-sm btn-primary js-btn_re_enroll_student" 
                                        data-student_id="{{$data->student_information_id}}" 
                                        data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Re-Enroll
                                    </button>
                                @endif
                                {{-- <button type="button" 
                                    style="margin-right:2px" 
                                    class="btn btn-sm btn-success js-btn_drop_student" 
                                    data-student_id="{{$data->student_information_id}}" 
                                    data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                    Drop
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endif
 

                            
               