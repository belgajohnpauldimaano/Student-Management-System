                                                
<div class="table-responsive">                        
    <div class="pull-right">
        {{ $IncomingStudentApproved ? $IncomingStudentApproved->links() : '' }}
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
            @foreach ($IncomingStudentApproved as $item)
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
                        <a class="btn btn-sm btn-primary btn-view-modal" data-id="{{$item->student_id}}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-sm btn-success btn-approve" data-id="{{$item->student_id}}"><i class="fas fa-thumbs-up"></i></a>
                        <a class="btn btn-sm btn-danger btn-disapprove" data-id="{{$item->student_id}}"><i class="fas fa-thumbs-down"></i></a>
                        {{-- <div class="input-group-btn pull-left text-left">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                            <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="btn-view-modal" data-id="{{$item->student_id}}"><i class="fas fa-eye"></i> View</a></li>
                                <li><a href="#" class="btn-approve" data-id="{{$item->student_id}}"><i class="fas fa-thumbs-up"></i> Re-approve</a></li>
                                <li><a href="#" class="btn-disapprove"  data-id="{{$item->student_id}}"><i class="fas fa-thumbs-down"></i> Disapprove</a></li>
                            </ul>
                        </div>                                                         --}}
                    </td>
                </tr>
            @endforeach   
        </tbody>
    </table>
</div>
                               
                        
                        