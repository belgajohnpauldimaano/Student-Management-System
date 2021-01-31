<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_tuition_fee">
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
                        <input type="number" class="form-control" name="tuition_fee" value="{{ $payroll ? $payroll->tuition_amt : '' }}">
                        <div class="help-block text-red text-center" id="js-tuition_fee">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Employee Type</label>
                        <select name="grades" id="grades" class="form-control">
                            {{-- <option value="">Select Employee Name</option> --}}
                            <option value="1">Faculty</option>
                            <option value="2">Admission</option>
                            <option value="3">Finance</option>
                            <option value="4">Registrar</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelvl">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Employee Name</label>
                        <select name="grades" id="grades" class="form-control">
                            <option value="">Select Employee Name</option>
                            <option value="1">Elementary</option>
                            <option value="2">Highschool</option>
                            <option value="3">College</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelvl">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tuition fee</label>
                        <input type="number" class="form-control" name="tuition_fee" value="{{ $payroll ? $payroll->tuition_amt : '' }}">
                        <div class="help-block text-red text-center" id="js-tuition_fee">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Upload Payroll</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="payroll" id="payroll">
                                <label class="custom-file-label" id="btn-upload-tor" for="payroll">Choose file</label>
                            </div>
                            {{-- <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div> --}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Set as Current Tuition Fee</label>
                        <select name="current_sy" id="current_sy" class="form-control">
                            <option value="1" {{ $payroll ? ($payroll->current == 0 ? 'selected' : '')  : 'selected' }}>Yes</option>
                            <option value="0" {{ $payroll ? ($payroll->current == 0 ? 'selected' : '')  : '' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-current_sy">
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