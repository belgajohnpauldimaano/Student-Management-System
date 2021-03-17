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
                        <div class="row">
                            <div class="col-md-12">
                                <!-- checkbox -->
                                
                                <div class="form-group clearfix">
                                    @if($SchoolYear)
                                        @foreach (json_decode($SchoolYear['apply_to'], true) as $key => $item)
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="apply_to_{{ $item['apply_name'] }}" id="checkboxPrimary{{ $key }}" {{ $item['is_apply'] == true ? 'checked' : ''}} value="1">
                                                <label for="checkboxPrimary{{ $key }}" class="text-capitalize">
                                                    {{ $item['apply_name'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="apply_to_admin" id="checkboxPrimary4" value="1">
                                            <label for="checkboxPrimary4">
                                                Admin
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="apply_to_faculty" id="checkboxPrimary2" value="1">
                                            <label for="checkboxPrimary2">
                                                Faculty
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="apply_to_finance" id="checkboxPrimary3" value="1">
                                            <label for="checkboxPrimary3">
                                                Finance
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="apply_to_registration" id="checkboxPrimary1" value="1">
                                            <label for="checkboxPrimary1">
                                                Registration
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        {{-- <select name="apply_to" id="apply_to" class="form-control">
                            <option value="1">Admin Only</option>
                            <option value="2">Admin | Registration for Enrollment</option>
                            <option value="3">Admin | Registration for Enrollment | Payment</option>
                            
                        </select> --}}
                        {{-- <div class="help-block text-red text-center" id="js-apply_to">
                        </div> --}}
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