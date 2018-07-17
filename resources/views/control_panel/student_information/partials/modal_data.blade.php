<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_subject_details">
                {{ csrf_field() }}
                @if ($StudentInformation)
                    <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                @endif
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $StudentInformation ? 'Edit Registrar Information' : 'Add Registrar Information' }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" value="{{ $StudentInformation ? $StudentInformation->user->username : '' }}">
                        <div class="help-block text-red text-center" id="js-username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">First name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $StudentInformation ? $StudentInformation->first_name : '' }}">
                        <div class="help-block text-red text-center" id="js-first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Middle name</label>
                        <input type="text" class="form-control" name="middle_name" value="{{ $StudentInformation ? $StudentInformation->middle_name : '' }}">
                        <div class="help-block text-red text-center" id="js-middle_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Last name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $StudentInformation ? $StudentInformation->last_name : '' }}">
                        <div class="help-block text-red text-center" id="js-last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Address <small class="text-red">Optional</small></label>
                        <input type="text" class="form-control" name="address" value="{{ $StudentInformation ? $StudentInformation->address : '' }}">
                        <div class="help-block text-red text-center" id="js-address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Birth <small class="text-red">Optional</small></label>
                        {{--  <input type="text" class="form-control" name="birthdate" value="{{ $StudentInformation ? $StudentInformation->birthdate : '' }}">  --}}
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="birthdate" class="form-control pull-right" id="datepicker">
                        </div>
                        <div class="help-block text-red text-center" id="js-birthdate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Gender </label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select gender</option>
                            <option value="1" {{ $StudentInformation ? $StudentInformation->gender == 1 ? 'selected' : '' : '' }}>Male</option>
                            <option value="2" {{ $StudentInformation ? $StudentInformation->gender == 2 ? 'selected' : '' : '' }}>Female</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-gender">
                        </div>
                    </div>

                    @if ($StudentInformation)
                        @if ($StudentInformation->id)
                            <div class="form-group">
                                <label for="">Email address</label>
                                <input type="text" class="form-control" name="email" value="{{ $StudentInformation ? $StudentInformation->user->email : '' }}">
                                <div class="help-block text-red text-center" id="js-email">
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->