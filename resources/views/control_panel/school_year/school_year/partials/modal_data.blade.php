<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_school_year">
                {{ csrf_field() }}
                @if ($SchoolYear)
                    <input type="hidden" name="id" value="{{ $SchoolYear->id }}">
                @endif
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ $SchoolYear ? 'Edit School Year' : 'Add School Year' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">School Year</label>
                        <input type="text" class="form-control" name="school_year" value="{{ $SchoolYear ? $SchoolYear->school_year : '' }}">
                        <div class="help-block text-red text-center" id="js-school_year">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Apply to</label>
                        <select name="apply_to" id="apply_to" class="form-control">
                            <option value="1">Admin Only</option>
                            <option value="2">Admin | Registration for Enrollment</option>
                            <option value="3">Admin | Registration for Enrollment | Payment</option>
                            {{-- <option value="4">Faculty Only</option> --}}
                        </select>
                        <div class="help-block text-red text-center" id="js-apply_to">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Set as Current School Year</label>
                        <select name="current_sy" id="current_sy" class="form-control">
                            <option value="1" {{ $SchoolYear ? ($SchoolYear->current == 0 ? 'selected' : '')  : '' }}>Yes</option>
                            <option value="0" {{ $SchoolYear ? ($SchoolYear->current == 0 ? 'selected' : '')  : 'selected' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-current_sy">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->