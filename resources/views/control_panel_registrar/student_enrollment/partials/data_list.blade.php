<div class="pull-right">
    {{ $StudentInformation ? $StudentInformation->links() : '' }}
</div>
<table class="table no-margin table-sm table-hover">
    <thead>
        <tr>
            <th>Student Number</th>
            <th>Student Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($StudentInformation)
            @foreach ($StudentInformation as $data)
                <tr>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->full_name }}</td>
                    <td>
                        <div class="input-group-btn float-left text-left">
                            <button type="button" class="btn btn-primary js-btn_enroll_student" data-id="{{ $data->id }}" aria-expanded="true">
                                Enroll
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>