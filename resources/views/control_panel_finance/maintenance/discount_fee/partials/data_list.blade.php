<div class="table-responsive">
    <div class="float-right">
        {{ $DiscountFee ? $DiscountFee->links() : '' }}
    </div>
    <table class="table table-sm table-hover no-margin">
        <thead>
            <tr>
                <th>Discount Name</th>
                <th>Discount Fee Amount</th>
                <th>Apply to</th>
                <th>Current</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($DiscountFee)
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
            @endif
        </tbody>
    </table>
</div>