<div class="table-responsive table-hover">  
    <div class="pull-right">
        {{ $ClassDetail ? $ClassDetail->links() : '' }}
    </div>
    <table class="table no-margin table-hover">
        <thead>
            <tr>
                <th>School Year</th>
                <th>Room</th>
                <th>Grade Level</th>
                <th>Section</th>
                <th>Adviser</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($ClassDetail)
                @foreach ($ClassDetail as $data)
                    <tr>
                        <td>{{ $data->school_year }}</td>
                        <td>{{ $data->room_code }}</td>
                        <td>{{ $data->grade_level }}</td>
                        <td>{{ $data->section }}</td>
                        <td>{{ $data->adviser_name }}</td>
                        <td>
                            <span class="badge {{ $data->status == 0 ? 'bg-green' : 'bg-red' }}">
                                {{ $data->status == 0 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-flat btn-primary"  href="{{ route('finance.student_list', $data->id) }}" data-id="{{ $data->id }}" >
                                <i class="fas fa-eye"></i> View List
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>