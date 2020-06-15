<div class="modal fade modal-update-profile" tabindex="-1" role="dialog" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">            
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        Update Demographic Profile
                    </h4>
                </div>
                
                <div class="modal-body">
                    <div class="form-group" align="center">
                        
                        <img class="profile-user-img img-responsive img-circle" 
                            id="img--user_photo" 
                            src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) ? 
                            asset('/img/account/photo/'.$Profile->photo) : asset('/img/account/photo/blank-user.gif') : 
                            asset('/img/account/photo/blank-user.gif') }}" 
                            alt="User profile picture"
                        />
                        
                        <button type="button" style="margin-top: 5px" class="btn btn-flat btn-success btn--update-photo" title="Change photo">
                            browse
                        </button>

                        <form id="form_user_photo_uploader" >
                            <input type="hidden" name="id" value="{{ $StudentInformation ? $StudentInformation->id : '' }}">
                            <input type="file" id="user--photo" name="user_photo">                            
                            <button style="display: none" type="submit">save</button>
                        </form>   
                    </div>

                    <form id="form--update-profile">
                        {{ csrf_field() }}
                        <div class="form-group" id="warning-modal">
                            <div class="help-block text-center" id="js-warning-modal"></div>
                        </div>  
                        {{-- <div class="form-group gender">
                            <label for="">Are you ESC?</label>
                            <select name="isEsc" id="isEsc" class="form-control">
                                <option value="0" {{ $StudentInformation ? $StudentInformation->isEsc == 0 ? 'selected' : '' : 'selected' }}>--Select--</option>
                                <option value="1" {{ $StudentInformation ? $StudentInformation->isEsc == 1 ? 'selected' : '' : '' }}>Yes</option>
                                <option value="2" {{ $StudentInformation ? $StudentInformation->isEsc == 2 ? 'selected' : '' : '' }}>No</option>
                            </select>
                            <div class="help-block text-left" id="js-isEsc"></div>
                        </div>                --}}
                        <div class="form-group first">
                            <label for="">First name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name">
                            <div class="help-block text-left" id="js-first_name"></div>
                        </div>
                        <div class="form-group middle">
                            <label for="">Middle name</label>
                            <input type="text" class="form-control" name="middle_name" id="middle_name">
                            <div class="help-block text-left" id="js-middle_name"></div>
                        </div>
                        <div class="form-group last">
                            <label for="">Last name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name">
                            <div class="help-block text-left" id="js-last_name"></div>
                        </div>
                        <div class="form-group gender">
                            <label for="">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Select a gender</option>
                                <option value="1" {{ $StudentInformation ? $StudentInformation->gender == 1 ? 'selected' : '' : '' }}>Male</option>
                                <option value="2" {{ $StudentInformation ? $StudentInformation->gender == 2 ? 'selected' : '' : '' }}>Female</option>
                            </select>
                            <div class="help-block text-left" id="js-gender"></div>
                        </div>
                        <div class="form-group phone">
                            <label for="">Contact Number</label>
                            <input type="text" class="form-control" name="contact_number" id="contact_number" value="" placeholder="9561234567">
                            <div class="help-block text-left" id="js-contact_number"></div>
                        </div>
                        <div class="form-group e_add">
                            <label for="">Email Address</label>
                            <input type="text" class="form-control" name="profile_email" id="profile_email">
                            <div class="help-block text-left" id="js-profile_email"></div>
                        </div>
                        <div class="form-group b_day">
                            <label>Birthday</label>
                            <input type="text" name="birthday" class="form-control pull-right birthday" id="birthday">
                            <div class="help-block text-left" id="js-birthday"></div>
                        </div>
                        <div class="form-group c_add">
                            <label for="">Current Address</label>
                            <input type="text" class="form-control" name="c_address" id="c_address">
                            <div class="help-block text-left" id="js-c_address"></div>
                        </div>
                        <div class="form-group p_add">
                            <label for="">Permanent Address</label>
                            <input type="text" class="form-control" name="p_address" id="p_address">
                            <div class="help-block text-left" id="js-p_address"></div>
                        </div>
                        <div class="form-group f_name">
                            <label for="">Father's name</label>
                            <input type="text" class="form-control" name="father_name" id="father_name">
                            <div class="help-block text-left" id="js-father_name"></div>
                        </div>
                        <div class="form-group m_name">
                            <label for="">Mother's name</label>
                            <input type="text" class="form-control" name="mother_name" id="mother_name">
                            <div class="help-block text-left" id="js-mother_name"></div>
                        </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>