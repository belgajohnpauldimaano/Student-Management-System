<div class="modal fade" id="js-registration">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-black" id="js-registration">
                <i class="fas fa-edit"></i>  Student Application Form
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="js-registration_form" method="post">
            {{ csrf_field() }}
            <div class="modal-body" style="color: black!important">
              
              <div class="form-row mb-5 ">
                    <div class="col-lg-8 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
                    {{-- <div class="col-md-8"> --}}
                        <div class="form-group input-sy">
                            <div id="js_sy"></div>
                            <input type="hidden" class="form-control form-control-sm" id="sy" name="sy" value="">
                            <div class="help-block text-red text-left" id="js-sy">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group input-grade_lvl col-md-6">
                                    <label for="">I am Incoming</label>
                                    <br/>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input grade_level" type="radio" name="grade_level" id="js-transferee_level7" value="7">
                                        <label class="form-check-label" for="js-transferee_level7">Grade 7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input grade_level" type="radio" name="grade_level" id="js-transferee_level11" value="11">
                                        <label class="form-check-label" for="js-transferee_level11">Grade 11</label>
                                    </div>                                
                                </div>
                                <div class="form-group col-md-6" id="div-strand"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group input-grade_lvl">
                                <label for="">Transferee</label>
                                <br/>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input grade_level" type="radio" name="grade_level" id="js-grade_level8" value="8">
                                    <label class="form-check-label" for="js-grade_level8">Grade 8</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input grade_level" type="radio" name="grade_level" id="js-grade_level9" value="8">
                                    <label class="form-check-label" for="js-grade_level9">Grade 9</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input grade_level" type="radio" name="grade_level" id="js-grade_level10" value="10">
                                    <label class="form-check-label" for="js-grade_level10">Grade 10</label>
                                </div>
                                <div class="help-block text-red text-left" id="js-grade_level"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group input-lrn">
                                    <label for="lrn">LRN</label>
                                    <input type="number" class="form-control form-control-sm" id="lrn" name="lrn" placeholder="01234567890">
                                    <div class="help-block text-red text-left" id="js-lrn">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input-fb_acct">
                                    <label for="">FB/Messenger Account</label>
                                    <input type="text" class="form-control form-control-sm" id="fb_acct" name="fb_acct">
                                    <div class="help-block text-red text-left" id="js-fb_acct">
                                    </div>
                                </div> 
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-lg-4 align-items-stretch order-1 order-lg-2 text-center" style="border: 2px dashed #ccc">

                        <p class="mt-2" ><i><small>Kindly upload Passport Size 2x2 with name tag</small></i></p>
                        <img class="mt-0 profile-user-img img-responsive img-circle" id="img--user_photo" src="{{  asset('/img/account/photo/blank-user.gif') }}" 
                        style="width:150px; height:150px;  border-radius:50%; ">
                        <br/><br/>
                        <button type="button" class="btn btn-sm btn-flat btn-primary btn--update-photo" title="Change photo">
                            Upload a photo
                        </button> 
                        <br/>
                        
                        <input type="file" class="btn-upload-photo" style="display: none" id="student_img" name="student_img" accept="*/image">
                         <input type="hidden" id="default-img" value={{asset('/img/account/photo/blank-user.gif')}} />   
                         <div class="help-block text-red text-center" id="js-student_img">
                        </div>
                    </div>
                                                   
                </div>                                

                <h6 style="margin-bottom: -.5em"><b>PERSONAL DATA</b> <i>(Note: Kindly input all information inside the box.)</i></h6>
                <hr>
                <div class="form-row">
                     <div class="form-group col-md-4 input-last_name">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control form-control-sm" id="last_name" name="last_name">
                        <div class="help-block text-red text-left" id="js-last_name">
                        </div>
                        
                    </div>
                    <div class="form-group col-md-4 input-first_name">
                        <label for="">Given Name</label>
                        <input type="text" class="form-control form-control-sm" id="first_name" name="first_name">
                        <div class="help-block text-red text-left" id="js-first_name">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-middle_name">
                        <label for="">Middle Name</label>
                        <input type="text" class="form-control form-control-sm" id="middle_name" name="middle_name">
                        <div class="help-block text-red text-left" id="js-middle_name">
                        </div>
                    </div>
                    <div class="form-group col-md-12 input-p_address">
                        <label for="p_address">Permanent Address (House No. Brgy./Street Municipality Province)</label>
                        <input type="text" class="form-control form-control-sm" id="p_address" name="p_address" >
                        <div class="help-block text-red text-left" id="js-p_address">
                        </div>
                    </div>
                    <div class="form-group col-md-12 input-address">
                        <label for="">Current Address (House No. Brgy./Street Municipality Province)</label>
                        <input type="text" class="form-control form-control-sm" id="address" name="address" >
                        <div class="help-block text-red text-left" id="js-address">
                        </div>
                    </div>
                    <div class="form-group col-md-3 input-birthday">
                        <label for="">Date of Birth <i class="fa fa-calendar"></i></label>
                        <div class="input-group date">
                            <input type="text" name="birthdate" class="form-control form-control-sm pull-right" id="birthday">
                        </div>
                        <div class="help-block text-red text-left" id="js-birthdate">
                        </div>
                    </div>
                    <div class="form-group col-md-7 input-place_of_birth">
                        <label for="">Place of Birth</label>
                        <input type="text" class="form-control form-control-sm" id="place_of_birth" name="place_of_birth">
                        <div class="help-block text-red text-left" id="js-place_of_birth">
                        </div>
                    </div>
                    <div class="form-group col-md-2 input-age">
                        <label for="">Age</label>
                        <input type="text" class="form-control form-control-sm" id="age" name="age">
                        <div class="help-block text-red text-left" id="js-age">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-gender">
                        <label for="">Gender </label>
                        <select name="gender" id="gender" class="form-control form-control-sm">
                            <option value="">Select gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        <div class="help-block text-red text-left" id="js-gender">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-religion">
                        <label for="">Religion</label>
                        <input type="text" class="form-control form-control-sm" id="religion" name="religion">
                        <div class="help-block text-red text-left" id="js-religion">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-citizenship">
                        <label for="">Citizenship</label>
                        <input type="text" class="form-control form-control-sm" id="citizenship" name="citizenship">
                        <div class="help-block text-red text-left" id="js-citizenship">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4  input-student_email">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control form-control-sm" id="student_email" name="student_email" placeholder="youremail@emailprovider.com">
                        <div class="help-block text-red text-left" id="js-student_email">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-phone">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="+639">
                        <div class="help-block text-red text-left" id="js-phone">
                        </div>
                    </div>                                    
                </div>
                    
                <h6 class="mt-2" style="margin-bottom: -.5em"><b>EDUCATIONAL DATA</b></h6>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-9 input-school_name">
                        <label for="email">Name of School</label>
                        <input type="text" class="form-control form-control-sm" id="school_name" name="school_name" >
                        <div class="help-block text-red text-left" id="js-school_name">
                        </div>
                    </div>
                    <div class="form-group col-md-3 text-right input-school_type">
                        <label for="">&nbsp;</label>
                        <br/>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="school_type" id="js-private" value="Private">
                            <label class="form-check-label" for="js-private">Private</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="school_type" id="js-public" value="Public">
                            <label class="form-check-label" for="js-public">Public</label>
                        </div>
                        <div class="help-block text-red text-left" id="js-school_type">
                        </div>
                    </div>
                    <div class="form-group col-md-12 input-school_address">
                        <label for="school_address">School Address</label>
                        <input type="text" class="form-control form-control-sm" id="school_address" name="school_address">
                        <div class="help-block text-red text-left" id="js-school_address">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-last_sy_attended">
                        <label for="">Last School Year Attended:</label>
                        <select name="last_sy_attended" id="last_sy_attended" class="form-control form-control-sm">
                        </select>
                        <div class="help-block text-red text-left" id="js-last_sy_attended">
                        </div>
                    </div>
                    <div class="form-group col-md-4 input-gwa">
                        <label for="">Average (GWA):</label>
                        <input type="text" class="form-control form-control-sm col-md-3" id="gwa" name="gwa">
                        <div class="help-block text-red text-left" id="js-gwa">
                        </div>
                    </div>
                    <div class="form-group col-md-9 text-right input-gwa">
                        <label for="">For <b>TRANSFEREE</b>: <i>If from private school, are you an ESC grantee?</i></label>
                    </div>
                    <div class="form-group col-md-3 text-right input-is_esc">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_esc" id="js-yes" value="1">
                            <label class="form-check-label" for="js-yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_esc" id="js-no" value="0">
                            <label class="form-check-label" for="js-no">No</label>
                        </div>
                        <div class="help-block text-red text-left" id="js-is_esc">
                        </div>
                    </div>
                </div>

                <h6 class="mt-2" style="margin-bottom: -.5em"><b>FAMILY DATA</b></h6>
                <hr>
                <div class="form-row">
                    
                    <div class="form-group col-md-12 input-father_name">
                        <label for="father_name">Father's Name (Last Name, First Name Middle Name)</label>
                        <input type="text" class="form-control form-control-sm" id="father_name" name="father_name">
                        <div class="help-block text-red text-left" id="js-father_name">
                        </div>
                    </div>

                    <div class="form-group col-md-7 input-father_occupation">
                        <label for="father_occupation">Occupation</label>
                        <input type="text" class="form-control form-control-sm" id="father_occupation" name="father_occupation">
                        <div class="help-block text-red text-left" id="js-father_occupation">
                        </div>
                    </div>

                    <div class="form-group col-md-5 input-father_fb_acct">
                        <label for="father_fb_acct">FB/Messenger Acct</label>
                        <input type="text" class="form-control form-control-sm" id="father_fb_acct" name="father_fb_acct">
                        <div class="help-block text-red text-left" id="js-father_fb_acct">
                        </div>
                    </div>
                
                    <div class="form-group col-md-12 input-mother_name">
                        <label for="mother_name">Mother's Name  (Last Name, First Name Middle Name)</label>
                        <input type="text" class="form-control form-control-sm" id="mother_name" name="mother_name">
                        <div class="help-block text-red text-left" id="js-mother_name">
                        </div>
                    </div>

                    <div class="form-group col-md-7 input-mother_occupation">
                        <label for="mother_occupation">Occupation</label>
                        <input type="text" class="form-control form-control-sm" id="mother_occupation" name="mother_occupation">
                        <div class="help-block text-red text-left" id="js-mother_occupation">
                        </div>
                    </div>

                    <div class="form-group col-md-5 input-mother_fb_acct">
                        <label for="mother_fb_acct">FB/Messenger Acct</label>
                        <input type="text" class="form-control form-control-sm" id="mother_fb_acct" name="mother_fb_acct">
                        <div class="help-block text-red text-left" id="js-mother_fb_acct">
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 input-guardian mt-2">
                        <label>In the absence of your parent, write the name of your guardian</label>
                    </div>
                    <div class="form-group col-md-8 input-guardian" style="magin-top:-1.5em">
                        <label for="guardian">Parent/Guardian (Last Name, First Name Middle Name)</label>
                        <input type="text" class="form-control form-control-sm" id="guardian" name="guardian">
                        <div class="help-block text-red text-left" id="js-guardian">
                        </div>
                    </div>

                    <div class="form-group col-md-4 input-guardian_fb_acct">
                        <label for="guardian_fb_acct">FB/Messenger Acct</label>
                        <input type="text" class="form-control form-control-sm" id="guardian_fb_acct" name="guardian_fb_acct">
                        <div class="help-block text-red text-left" id="js-guardian_fb_acct">
                        </div>
                    </div>
                     <div class="form-group col-md-4 input-no_siblings">
                        <label for="">No. of your siblings (do not include yourself)</label>
                        <select name="no_siblings" id="no_siblings" class="form-control form-control-sm">
                            <option value="0">Select No. of your siblings</option>
                            @for ( $x = 0 ; $x < 15; $x++)
                               <option>{{ $x }}</option>
                            @endfor
                        </select>
                        <div class="help-block text-red text-left" id="js-no_siblings">
                        </div>
                    </div>
                </div>    
                
                <hr>
                <div class="col-12" align="justify">
                    {{-- <p class="mb-2" style="margin-bottom:0px;"><b>Liability Waiver</b></p> --}}
                    <input type="checkbox" name="terms" id="terms" class="form-check-input" value="1" style="margin-left:0px; margin-top:8px;">
                    <label for="terms" class="form-check-label" style="margin-left:20px;">
                        <i>
                            I hereby declare that all information provided in this application form and all supporting documents are true and
                            correct. I fully understand that any misinterpretation of failure to disclose pertinent information on my part as 
                            required herein, may cause the disapproval of this application. In the event that the application is approved, it is
                            deemed that I shall accept and abide by the policies, procedures and conditions set by <b>ST. John's Academy Inc</b>.
                        </i>
                    </label>
                </div>
                {{-- <div class="row">
                    <div class="col-md-6 mt-2 text-center">
                        <div class="">
                            <canvas style="border: 2px dashed #ccc" id="signature-pad" class="signature-pad" width=300 height=100></canvas>
                        </div>
                        <div class="form-group col-md-12 input-father_occupation">
                            <input type="text" class="form-control form-control-sm" id="father_occupation" name="father_occupation">
                            <label><i>Signature of Application over printed name</i></label>
                            <div class="help-block text-red text-left" id="js-father_occupation"></div>
                            <button class="btn btn-sm btn-danger" id="clear">Clear Signature</button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2 text-center">
                        <div class="mt-4 pt-1">
                            <canvas style="border: 2px dashed #ccc" id="signature-pad" class="signature-pad" width=300 height=100></canvas>
                            <label><i>Signature of Parent/Guardian</i></label>
                            <div class="help-block text-red text-left" id="js-father_occupation"></div>
                            <button class="btn btn-sm btn-danger" id="clear">Clear Signature</button>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" disabled class="btn btn-primary btn-submit-registration">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>