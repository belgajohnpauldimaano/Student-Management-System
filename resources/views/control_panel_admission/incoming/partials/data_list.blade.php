                        
<div class="table-responsive">                            
    <div class="active tab-pane" id="js-notyetapproved">     
        <div class="float-right">
            {{ $IncomingStudent ? $IncomingStudent->links() : '' }}
        </div>                             
        <table class="table table-sm no-margin table-bordered table-hover">
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
                @foreach ($IncomingStudent as $item)
                    <tr>
                        <td>{{$item->student_name}}</td>
                        <td>{{$item->student_type == '1' ? 'Transferee' : 'Freshman'}}</td>
                        <td>Grade {{$item->grade_level_id}}</td>
                        <td>
                            <span class="badge badge-{{$item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                                {{$item->approval}}
                            </span>
                        </td>
                        <td width="20%">
                            <a class="btn btn-sm btn-primary btn-view-modal" data-id="{{$item->student_id}}"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-success btn-approve" data-id="{{$item->student_id}}"><i class="fas fa-thumbs-up"></i></a>
                            <a class="btn btn-sm btn-danger btn-disapprove" data-id="{{$item->student_id}}"><i class="fas fa-thumbs-down"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>