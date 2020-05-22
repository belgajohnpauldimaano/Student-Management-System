<div class="modal fade" id="js-registration" tabindex="-1" role="dialog" aria-labelledby="js-registration" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-black" id="js-registration">Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="js-form_subject_details">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-row mb-5" align="center">
                    <div class="col-md-12">
                        <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{  asset('/img/account/photo/blank-user.png') }}" 
                        style="width:150px; height:150px;  border-radius:50%;">
                        <br/><br/>
                        <button type="button" class="btn btn-flat btn-primary btn--update-photo" title="Change photo">
                            Upload a photo
                        </button> 
                        {{-- <input type="file" class="btn--update-photo"id="bank_image" name="bank_image" src="" onchange="readImageURL(this);" accept="*/image">    --}}
                    </div>                                
                </div>                                

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="lrn">Student LRN</label>
                        <input type="text" class="form-control" name="lrn" placeholder="01234567890">
                        <div class="help-block text-red text-center" id="js-lrn">
                        </div>
                        <div class="validation"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="">Registration type</label>
                            <select name="reg_type" id="reg_type" class="form-control">
                                <option value="">--Select--</option>
                                <option value="1">Transferee</option>
                                <option value="2">Freshman</option>
                            </select>
                            <div class="help-block text-red text-center" id="js-reg_type">
                            </div>
                        </div>
                        <div class="validation"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="">Grade</label>
                            <select name="grade_lvl" id="grade_lvl" class="form-control">
                                <option value="">--Select--</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                            <div class="help-block text-red text-center" id="js-grade_lvl">
                            </div>
                        </div>
                        <div class="validation"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">First name</label>
                        <input type="text" class="form-control" name="first_name">
                        <div class="help-block text-red text-center" id="js-first_name">
                        </div>
                        <div class="validation"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Middle name</label>
                        <input type="text" class="form-control" name="middle_name">
                        <div class="help-block text-red text-center" id="js-middle_name">
                        </div>
                        <div class="validation"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Last name</label>
                        <input type="text" class="form-control" name="last_name">
                        <div class="help-block text-red text-center" id="js-last_name">
                        </div>
                        <div class="validation"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Email address</label>
                        <input type="text" class="form-control" name="email" placeholder="youremail@emailprovider.com">
                        <div class="help-block text-red text-center" id="js-email">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Phone number</label>
                        <input type="text" class="form-control" name="phone" value="+639">
                        <div class="help-block text-red text-center" id="js-phone">
                        </div>
                    </div>                                    
                </div>
                    
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">Parent/Guardian</label>
                        <input type="text" class="form-control" name="guardian">
                        <div class="help-block text-red text-center" id="js-guardian">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" >
                        <div class="help-block text-red text-center" id="js-address">
                        </div>
                    </div>
                </div>                
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Date of Birth <i class="fa fa-calendar"></i></label>
                        <div class="input-group date">
                            <input type="text" name="birthdate" class="form-control pull-right" id="birthday">
                        </div>
                        <div class="help-block text-red text-center" id="js-birthdate">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Gender </label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-gender">
                        </div>
                    </div>        
                </div>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>