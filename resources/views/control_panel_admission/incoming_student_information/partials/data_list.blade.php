<div class="pull-right">
    {{ $StudentInformation ? $StudentInformation->links() : '' }}
</div>                             
<table class="table no-margin table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Student type</th>
            <th>Student level</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($StudentInformation as $item)
            <tr>
                <td>{{$item->student_name}}</td>
                <td>{{$item->student_type == '1' ? 'Transferee' : 'Freshman'}}</td>
                <td>Grade {{$item->grade_level_id}}</td>
                <td>
                    <span class="label label-{{$item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                        {{$item->approval}}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary btn-view-modal" data-id="{{$item->student_id}}">View</button>
                    <button class="btn btn-sm btn-success btn-approve" data-id="{{$item->student_id}}">
                        Approve
                    </button>
                </td>
            </tr>
        @endforeach                                            
    </tbody>
</table>