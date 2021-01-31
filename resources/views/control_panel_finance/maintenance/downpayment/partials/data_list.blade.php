<div class="table-responsive">
    <div class="float-right">
        {{ $DownpaymentFee ? $DownpaymentFee->links() : '' }}
    </div>
    <table class="table table-sm table-hover no-margin">
        <thead>
            <tr>
                <th>Downpayment Fee</th>
                <th>Student Category</th>
                <th>Modified</th>
                {{-- <th>Current</th> --}}
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($DownpaymentFee)
                @foreach ($DownpaymentFee as $data)
                    <tr>
                        <td>{{ number_format($data->downpayment_amt, 2) }}</td>
                        <td>{{  $data->grade_level_id ? 'Grade' : ''}} {{$data->grade_level_id == 0 ? '' : $data->grade_level_id }}</td>
                        <td>{{ $data->modified == 1 ? 'Yes' : 'No' }}</td>
                        {{-- <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td> --}}
                        <td>
                            <span class="badge badge-{{ $data->status == 1 ? 'success' : 'danger' }}">
                                {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                            </span>    
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger">Action</button>
                                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}">Edit</a>
                                    <a href="#" class="dropdown-item js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a>
                                    <a href="#" class="dropdown-item js-modify" data-id="{{ $data->id }}" data-modify_title="{{ ( $data->modified ? 'Remove from modify active' : 'Add to modify active' ) }}">{{ ( $data->modified ? 'Remove from modify Active' : 'Add to modify Active' ) }}</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>