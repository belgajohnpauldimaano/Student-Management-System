{{-- @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)                    --}}
    <div class="pull-right">
        {{-- {{ $Enrollment ? $Enrollment->links() : '' }} --}}
    </div>

    <table class="table no-margin">
        <thead>
            <tr>
                <th>No.</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
{{-- @else
    <div class="pull-right">
        <button type="button" style="margin-right:2px" class="btn btn-flat  btn-danger js-btn_re_enroll_all_student" aria-expanded="true">
            Re-Enroll All
        </button>
        {{ $Enrollment ? $Enrollment->links() : '' }}
    </div>  
    <table class="table no-margin">
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
                            <div class="input-group-btn pull-left text-left">
                                @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)
                                    <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_cancel_enroll_student" data-student_id="{{$data->student_information_id}}" data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Cancel Enroll
                                    </button>
                                    <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_student" data-student_id="{{$data->student_information_id}}" data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Re-Enroll
                                    </button>
                                @else                                                            
                                    <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_cancel_enroll_student" data-student_id="{{$data->student_information_id}}" data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Cancel Enroll
                                    </button>

                                    <button type="button" style="margin-right:2px" class="btn btn-danger js-btn_re_enroll_student" data-student_id="{{$data->student_information_id}}" data-id="{{ $data->enrollment_id }}" aria-expanded="true">
                                        Re-Enroll
                                    </button>
                                @endif
                                 
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endif --}}