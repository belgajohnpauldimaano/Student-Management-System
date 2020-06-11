
    <div class="modal fade modal-change-pw-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form--change-password">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                            Change Password
                        </h4>
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
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div class="modal fade modal-update-profile" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form--update-profile">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                            Update Profile
                        </h4>
                    </div>
                    <div class="modal-body">   
                        <div class="form-group gender">
                            <label for="">Are you ESC?</label>
                            <select name="isEsc" id="isEsc" class="form-control">
                                <option value="0" <?php echo e($Profile ? $Profile->isEsc == 0 ? 'selected' : '' : 'selected'); ?>>--Select--</option>
                                <option value="1" <?php echo e($Profile ? $Profile->isEsc == 1 ? 'selected' : '' : ''); ?>>Yes</option>
                                <option value="2" <?php echo e($Profile ? $Profile->isEsc == 2 ? 'selected' : '' : ''); ?>>No</option>
                            </select>
                            <div class="help-block text-left" id="js-isEsc"></div>
                        </div>        
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
                            <label for="">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="" <?php echo e($Profile ? $Profile->isEsc == 0 ? 'selected' : '' : ''); ?>>Select a gender</option>
                                <option value="2" <?php echo e($Profile ? $Profile->gender == 1 ? 'selected' : '' : ''); ?>>Female</option>
                                <option value="1" <?php echo e($Profile ? $Profile->gender == 2 ? 'selected' : '' : ''); ?>>Male</option>
                            </select>
                            <div class="help-block text-left" id="js-contact_number"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="9561234567">
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
                        <div class="form-group">
                            <label for="">Permanent Address</label>
                            <input type="text" class="form-control" name="p_address" id="p_address">
                            <div class="help-block text-left" id="js-p_address"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Father's name</label>
                            <input type="text" class="form-control" name="father_name" id="father_name">
                            <div class="help-block text-left" id="js-father_name"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Mother's name</label>
                            <input type="text" class="form-control" name="mother_name" id="mother_name">
                            <div class="help-block text-left" id="js-mother_name"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->