<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <h4 class="modal-title">
                        Edit Faculty
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="js-form_faculty" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if ($classSubjectDetailsId)
                            <input type="hidden" name="id" id="id" value="{{ $classSubjectDetailsId }}">
                        @endif
                        <div class="form-group">
                            <select class="form-control select2" name="faculty[]" id="faculty"  multiple="multiple"
                                data-placeholder="Select faculty"
                                style="width: 100%;">
                                    <?php echo $faculties; ?>
                            </select>
                            <div class="help-block text-red text-center" id="js-faculty">
                            </div>
                        </div>

                        <button id="submit_faculty_form" style="margin-bottom: 10px" type="submit" title="delete" 
                            class="btn btn-primary btn-flat btn-sm pull-right">
                                Submit
                        </button>
                    </form>

                    <table id="faculty_table" class="table table-condensed table-bordered">
                        <thead>
                            <tr>    
                                <th class="text-center">Faculty Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($TeacherSubjectCount != 0)
                            @foreach ($TeacherSubjects as $key => $item)                       
                                <tr>
                                    <td class="text-left">
                                        {{ $item->faculty->fullname }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" title="delete" 
                                            data-id="{{ $item->faculty_id }}" 
                                            data-subject_class_id="{{ $classSubjectDetailsId }}"
                                            class="btn btn-danger btn-sm js-btn_delete">
                                                <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>{{ $Adviser->faculty->fullname }}</td>
                            <td class="text-center">
                                <button type="button" title="delete" 
                                    data-id="{{ $Adviser->faculty_id }}" 
                                    data-subject_class_id="{{ $classSubjectDetailsId }}" 
                                    class="btn js-btn_delete btn-danger btn-sm">
                                        <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        @endif
                        </tbody>
                        <tfoot></tfoot>
                    </table>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat close-btn" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-primary btn-flat">Save</button> --}}
                </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
