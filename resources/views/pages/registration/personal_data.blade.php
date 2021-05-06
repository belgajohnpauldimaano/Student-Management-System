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
        {{-- <select name="gender" id="gender" class="form-control form-control-sm">
            <option value="">Select gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
        </select> --}}
        <br/>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="js-male" value="1">
            <label class="form-check-label" for="js-male">Male</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="js-female" value="2">
            <label class="form-check-label" for="js-female">Female</label>
        </div>
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