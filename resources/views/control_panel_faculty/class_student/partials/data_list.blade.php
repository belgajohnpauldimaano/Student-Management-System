<table class="table table-sm no-margin table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Student Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr class="bg-red">
            <td colspan="5"><b>Male</b></td>
        </tr>
        @if ($EnrollmentMale)
            @foreach ($EnrollmentMale as $key => $data)
                <tr>
                        {{-- <td>{{ $data->id }}</td> --}}
                    <td>{{ $key+1 }}.</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->student_name }}</td>     
                    <td>
                        <span class="label label-@if($data->status == 1)success @elseif($data->status == 0)danger @elseif($data->status == 2)warning @endif">
                            {{-- @if($data->status == 0) 
                                Inactive
                            @endif --}}
                            @if($data->status == 1) 
                                Active
                            @endif
                            @if($data->status == 2) 
                                Dropped
                            @endif
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="input-group-btn pull-left text-left">
                            <button 
                                style="margin-right:2px" 
                                class="
                                    btn btn-sm @if($data->status == 1) js-btn_drop @elseif($data->status == 2) js-btn_undrop @endif
                                    btn-@if($data->status == 1)danger @elseif($data->status == 2)success @endif
                                " 
                                data-student_id="{{$data->id}}" 
                                data-id="{{ $data->e_id }}" 
                                data-type="{{$data->status == 1 ? 'drop': 'undrop'}}"
                                aria-expanded="true"
                            >
                                @if($data->status == 1)                             
                                    <i class="fas fa-exclamation-circle"></i> Drop
                                @endif
                                @if($data->status == 2)
                                    <i class="fas fa-check"></i> Undrop
                                @endif
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr class="bg-yellow">
                <td colspan="5"><b>Female</b></td>
            </tr>
            @foreach ($EnrollmentFemale as $key => $data)
                <tr>
                        {{-- <td>{{ $data->id }}</td> --}}
                    <td>{{ $key+1 }}.</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->student_name }}</td>
                    <td>
                        <span class="label label-@if($data->status == 1)success @elseif($data->status == 0)danger @elseif($data->status == 2)warning @endif">
                            {{-- @if($data->status == 0) 
                                Inactive
                            @endif --}}
                            @if($data->status == 1) 
                                Active
                            @endif
                            @if($data->status == 2) 
                                Dropped
                            @endif
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="input-group-btn pull-left text-left">
                            <button 
                                style="margin-right:2px" 
                                class="
                                    btn btn-sm @if($data->status == 1) js-btn_drop @elseif($data->status == 2) js-btn_undrop @endif
                                    btn-@if($data->status == 1)danger @elseif($data->status == 2)success @endif
                                " 
                                data-student_id="{{$data->id}}" 
                                data-id="{{ $data->e_id }}" 
                                data-type="{{$data->status == 1 ? 'drop': 'undrop'}}"
                                aria-expanded="true"
                            >
                                @if($data->status == 1)                             
                                    <i class="fas fa-exclamation-circle"></i> Drop
                                @endif
                                @if($data->status == 2)
                                    <i class="fas fa-check"></i> Undrop
                                @endif
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>