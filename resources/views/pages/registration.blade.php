<div class="modal fade" id="js-registration">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-black" id="js-registration">
                <i class="fas fa-edit"></i>  ST. John's Academy Inc Registration
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="js-registration_form">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-row mb-5" align="center">
                    <div class="col-md-12">
                        <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{  asset('/img/account/photo/blank-user.gif') }}" 
                        style="width:150px; height:150px;  border-radius:50%;">
                        <br/><br/>
                        <button type="button" class="btn btn-sm btn-flat btn-primary btn--update-photo" title="Change photo">
                            Upload a photo
                        </button> 
                        <br/>
                        <p style="color:red"><i>Kindly upload Passport Size 2x2 with name tag</i></p>
                        <input type="file" class="btn-upload-photo" style="display: none" id="student_img" name="student_img" src=""
                         onchange="readImageURL(this);" accept="*/image">
                         <input type="hidden" id="default-img" value={{asset('/img/account/photo/blank-user.gif')}} />   
                         <div class="help-block text-red text-center" id="js-student_img">
                        </div>
                    </div>                                
                </div>                                

                <div class="form-row">
                    <div class="form-group col-md-4 input-lrn">
                        <label for="lrn">Student LRN</label>
                        <input type="number" class="form-control form-control-sm" id="lrn" name="lrn" placeholder="01234567890">
                        <div class="help-block text-red text-left" id="js-lrn">
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group input-reg_type">
                            <label for="">Registration type</label>
                            <select name="reg_type" id="reg_type" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="1">Transferee</option>
                                <option value="2">Freshman</option>
                            </select>
                            <div class="help-block text-red text-left" id="js-reg_type">
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group input-grade_lvl">
                            <label for="">Incoming Grade level</label>
                            <select name="grade_lvl" id="grade_lvl" class="form-control form-control-sm">
                                <option value="">--Select--</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                            <div class="help-block text-red text-left" id="js-grade_lvl">
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4 input-first_name">
                        <label for="">First name</label>
                        <input type="text" class="form-control form-control-sm" id="first_name" name="first_name">
                        <div class="help-block text-red text-left" id="js-first_name">
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4 input-middle_name">
                        <label for="">Middle name</label>
                        <input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name">
                        <div class="help-block text-red text-left" id="js-middle_name">
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4 input-last_name">
                        <label for="">Last name</label>
                        <input type="text" class="form-control form-control-sm" id="last_name" name="last_name">
                        <div class="help-block text-red text-left" id="js-last_name">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 input-student_email">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control form-control-sm" id="student_email" name="email" placeholder="youremail@emailprovider.com">
                        <div class="help-block text-red text-left" id="js-student_email">
                        </div>
                    </div>
                    <div class="form-group col-md-6 input-phone">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="+639">
                        <div class="help-block text-red text-left" id="js-phone">
                        </div>
                    </div>                                    
                </div>
                    
                <div class="form-row">
                    <div class="form-group col-md-12 input-guardian">
                        <label for="guardian">Parent/Guardian</label>
                        <input type="text" class="form-control form-control-sm" id="guardian" name="guardian">
                        <div class="help-block text-red text-left" id="js-guardian">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12 input-father_name">
                        <label for="father_name">Father's Name</label>
                        <input type="text" class="form-control form-control-sm" id="father_name" name="father_name">
                        <div class="help-block text-red text-left" id="js-father_name">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12 input-mother_name">
                        <label for="mother_name">Mother's Name</label>
                        <input type="text" class="form-control form-control-sm" id="mother_name" name="mother_name">
                        <div class="help-block text-red text-left" id="js-mother_name">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12 input-address">
                        <label for="">Current Address</label>
                        <input type="text" class="form-control form-control-sm" id="address" name="address" >
                        <div class="help-block text-red text-left" id="js-address">
                        </div>
                    </div>
                </div>    
                
                <div class="form-row">
                    <div class="form-group col-md-12 input-p_address">
                        <label for="p_address">Permanent Address</label>
                        <input type="text" class="form-control form-control-sm" id="p_address" name="p_address" >
                        <div class="help-block text-red text-left" id="js-p_address">
                        </div>
                    </div>
                </div>     
                
                <div class="form-row">
                    <div class="form-group col-md-6 input-birthday">
                        <label for="">Date of Birth <i class="fa fa-calendar"></i></label>
                        <div class="input-group date">
                            <input type="text" name="birthdate" class="form-control form-control-sm pull-right" id="birthday">
                        </div>
                        <div class="help-block text-red text-left" id="js-birthdate">
                        </div>
                    </div>
                    <div class="form-group col-md-6 input-gender">
                        <label for="">Gender </label>
                        <select name="gender" id="gender" class="form-control form-control-sm">
                            <option value="">Select gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        <div class="help-block text-red text-left" id="js-gender">
                        </div>
                    </div>        
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>