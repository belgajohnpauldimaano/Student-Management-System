<div class="float-right">
    {{ $SchoolYear ? $SchoolYear->links() : '' }}
</div>
<table class="table table-hover table-sm no-margin">
    <thead>
        <tr>
            <th>School Year</th>
            <th>Apply To</th>
            <th>Current</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($SchoolYear)
            @foreach ($SchoolYear as $data)
                <tr>
                    <td>{{ $data->school_year }}</td>
                    <td>
                        @foreach (json_decode($data['apply_to'], true) as $key => $item)
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" name="apply_to_{{ $item['apply_name'] }}" onclick="this.checked=!this.checked;" id="checkboxPrimary4" {{ $item['is_apply'] == true ? 'checked' : ''}}>
                                <label for="checkboxPrimary4" class="text-capitalize">
                                    {{ $item['apply_name'] }}
                                </label>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-{{ $data->current == 1 ? 'success' : 'danger' }}">
                            {{ $data->current == 1 ? 'Yes' : 'No' }}
                        </span>
                    </td>
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
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item js-btn_update_sy" data-id="{{ $data->id }}">Edit</a>
                                <a href="#" class="dropdown-item js-btn_toggle_current" data-id="{{ $data->id }}" data-toggle_title="{{ ( $data->current ? 'Remove from current active' : 'Add to current active' ) }}">{{ ( $data->current ? 'Remove from current Active' : 'Add to current Active' ) }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>