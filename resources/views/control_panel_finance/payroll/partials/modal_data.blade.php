<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_payroll">
                {{ csrf_field() }}
                @if ($payroll)
                    <input type="hidden" name="id" value="{{ $payroll->id }}">
                @endif
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ $payroll ? 'Edit Payroll' : 'Add Payroll' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Date of Payroll</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="payroll_date" class="form-control pull-right" id="datepicker"
                                value="{{ $payroll ? $payroll->payroll_date : '' }}">
                                
                        </div>
                        <div class="help-block text-red text-center" id="js-payroll_date"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Employee Type</label>
                        <select name="emp_category" id="emp_category" class="form-control">
                            {{-- <option value="">Select Employee Name</option> --}}
                            <option value="1" {{ $payroll ? ($payroll->employee_type == 1 ? 'selected' : '')  : '' }}>Faculty</option>
                            <option value="2" {{ $payroll ? ($payroll->employee_type == 2 ? 'selected' : '')  : '' }}>Admission</option>
                            <option value="3" {{ $payroll ? ($payroll->employee_type == 3 ? 'selected' : '')  : '' }}>Finance</option>
                            <option value="4" {{ $payroll ? ($payroll->employee_type == 4 ? 'selected' : '')  : '' }}>Registrar</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-emp_category">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Employee Name</label>
                        <select name="employee_name" id="employee_name" class="form-control select2" style="width: 100%;">
                                <option value="0">Select Employee</option>
                            @foreach ($emp_data as $data)
                                <option value="{{ $payroll ? ($payroll->employee_id == $data->id ? 'selected' : '') : $data->id }}" {{ $payroll ? ($payroll->employee_id == $data->id ? 'selected' : '') : $data->id }}>
                                    {{ $data->full_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="help-block text-red text-center" id="js-employee_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Upload Payroll</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="payroll" id="payroll">
                                <label class="custom-file-label" id="btn-upload-payroll" for="payroll">
                                    {{-- @forelse ($payroll->documents as $item)
                                      {{ decrypt($item->path_name)}}
                                    @empty
                                        Choose file
                                    @endforelse --}}
                                    Choose file
                                </label>
                            </div>
                            {{-- <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div> --}}                           
                        </div>
                         <div class="help-block text-red text-center" id="js-payroll"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Set as Active</label>
                        
                        <select name="active" id="active" class="form-control">
                            <option value="1" {{ $payroll ? ($payroll->status == 1 ? 'selected' : '')  : 'selected' }}>Yes</option>
                            <option value="0" {{ $payroll ? ($payroll->status == 0 ? 'selected' : '')  : '' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-active">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->