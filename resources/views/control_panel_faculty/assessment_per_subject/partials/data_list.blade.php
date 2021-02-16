<div class="table-responsive">
    <h5 class="mb-3">
        Class Subject: <span class="text-red"><i>{{ $ClassSubjectDetail->subject->subject }}</i></span>
        {{-- <div class="text-right" style="margin-top: -1em">
            <button id="js-print" class="btn btn-primary btn-sm" 
                data-id='{{$class_detail->id}}' 
                data-sy='{{$class_detail->school_year_id}}'
                data-adviser_id='{{$class_detail->adviser_id}}'
            >
                <i class="far fa-edit"></i> Edit
            </button>
        </div>     --}}
    </h5>
    <div class="float-right">
        {{-- {{ $DiscountFee ? $DiscountFee->links() : '' }} --}}
    </div>
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>Assessment Name</th>
                <th>Period</th>
                <th>Date Publish</th>
                <th>Date Expiration</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a class="btn" href="">
                        <i class="far fa-file fa-2x"></i> sample assessment
                    </a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            {{-- @if ($DiscountFee)
                @foreach ($DiscountFee as $data)
                    <tr>
                        <td>{{ $data->disc_type }}</td>
                        <td>{{ number_format($data->disc_amt ,2) }}</td>
                        <td>{{ $data->apply_to== 1 ? 'Student|Finance' : 'Finance' }}</td>
                        <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td>
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
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif --}}
        </tbody>
    </table>
</div>