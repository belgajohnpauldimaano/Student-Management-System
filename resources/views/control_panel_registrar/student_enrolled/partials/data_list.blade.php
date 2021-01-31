    <div class="pull-right">
        {{ $Enrollment ? $Enrollment->links() : '' }}
    </div>

    <table class="table table-sm table-hover no-margin table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Enrollment as  $key => $data)
            <tr>
                <td>{{ $key + 1 }}.</td>
                <td>{{ $data->student->user->username }}</td>
                <td>{{ $data->student->full_name }}</td>
                <td>
                    <span class="badge badge-@if($data->status == 1)success @elseif($data->status == 0)danger @elseif($data->status == 2)warning @endif">
                        @if($data->status == 0) 
                            Inactive
                        @endif
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
                            data-student_id="{{$data->student->id}}" 
                            data-id="{{ $data->id }}" 
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
            @empty
            <tr>
                <th colspan="5">
                    No Data Found.
                </th>
            </tr>
            @endforelse            
        </tbody>
    </table>
