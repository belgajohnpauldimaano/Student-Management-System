<div class="modal fade modal-change-pw-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form--change-password">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Change Password
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" class="form-control" name="old_password">
                    </div>
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
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

<div class="modal fade modal-update-profile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form--update-profile">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">
                        Update Profile
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">First name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name">
                        <div class="help-block text-left" id="js-contact_number"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Middle name</label>
                        <input type="text" class="form-control" name="middle_name" id="middle_name">
                        <div class="help-block text-left" id="js-contact_number"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name">
                        <div class="help-block text-left" id="js-contact_number"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Contact Number</label>
                        <input type="text" class="form-control" name="contact_number" id="contact_number"
                            placeholder="9561234567">
                        <div class="help-block text-left" id="js-contact_number"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="text" class="form-control" name="profile_email" id="profile_email">
                        <div class="help-block text-left" id="js-email"></div>
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <input type="text" name="birthday" id="birthday" class="form-control pull-right">
                        <div class="help-block text-left" id="js-birthday"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Current Address</label>
                        <input type="text" class="form-control" name="c_address" id="c_address">
                        <div class="help-block text-left" id="js-c_address"></div>
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