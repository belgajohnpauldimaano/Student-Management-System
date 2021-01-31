    <div class="modal fade modal-change-pw-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form--change-password">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Change Password
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">   
                                
                        <div class="form-group">
                            <label for="">First name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name">
                        </div>
                        <div class="form-group">
                            <label for="">Middle name</label>
                            <input type="text" class="form-control" name="middle_name" id="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="">Last name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name">
                        </div>
                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <input type="text" class="form-control" name="contact_number" id="contact_number">
                        </div>
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="form-group">
                            <label>Birthday</label>
                            <input type="text" name="birthday" id="birthday" class="form-control pull-right">
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


    <div class="modal fade modal-trainings_seminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Trainings and Seminars
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form--training-seminar">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="seminar_id" id="seminar_id">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" id="title" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-title"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Date from</label>
                            <input type="text" class="form-control date_picker_input" name="seminar_date_from" id="seminar_date_from" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-seminar_date_from"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Date To</label>
                            <input type="text" class="form-control date_picker_input" name="seminar_date_to" id="seminar_date_to" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-seminar_date_to"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Venue</label>
                            <input type="text" class="form-control" name="venue" id="venue" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-venue"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Sponsor</label>

                            <input type="text" class="form-control" name="sponsor" id="sponsor" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-sponsor"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Facilitator</label>
                            <input type="text" class="form-control" name="facilitator" id="facilitator" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-facilitator"></div>
                        </div>

                        <div class="form-group">
                            <label for="">Seminar Type</label>
                            <select class="form-control" name="seminar_type" id="seminar_type">
                                <option value="0">Select a seminar / training type</option>
                                <option value="1">Local</option>
                                <option value="2">National</option>
                                <option value="3">International</option>
                            </select>
                            <div class="help-block text-red text-center" id="js-seminar_type"></div>
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

    <div class="modal fade modal-education-attainment" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form--education-attainment">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="educ_id" id="educ_id" value="">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Educational Attainment
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">   
                                
                        <div class="form-group">
                            <label for="">Course</label>
                            <input type="text" class="form-control" name="course" id="course" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-course"></div>
                        </div>
                        <div class="form-group">
                            <label for="">School</label>
                            <input type="text" class="form-control" name="school" id="school" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-school"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Date from</label>
                            <input type="text" class="form-control date_picker_input" name="date_from" id="date_from" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-date_from"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Date To</label>
                            <input type="text" class="form-control date_picker_input" name="date_to" id="date_to" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-date_to"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Awards</label>
                            <input type="text" class="form-control" name="awards" id="awards" autocomplete="off">
                            <div class="help-block text-red text-center" id="js-awards"></div>
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