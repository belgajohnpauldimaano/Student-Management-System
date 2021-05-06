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
                                <div class="form-group input-grade_lvl col-md-5">
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
                                <div class="form-group col-md-7 input-strand" id="div-strand"></div>
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
                    
                    <div class="col-lg-4 align-items-stretch order-1 order-lg-2 text-center">
                        <div style="border: 2px dashed #ccc" class="p-3">
                            <p><i><small>Kindly upload Passport Size 2x2 with name tag</small></i></p>
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
                                                   
                </div>                                

                <h6 style="margin-bottom: -.5em"><b>PERSONAL DATA</b> <i>(Note: Kindly input all information inside the box.)</i></h6>
                <hr>
                @include('pages.registration.personal_data')
                    
                <h6 class="mt-2" style="margin-bottom: -.5em"><b>EDUCATIONAL DATA</b></h6>
                <hr>
                @include('pages.registration.educational_data')

                <h6 class="mt-2" style="margin-bottom: -.5em"><b>FAMILY DATA</b></h6>
                <hr>
                @include('pages.registration.family_data')
                
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