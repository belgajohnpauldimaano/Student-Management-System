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
        <div class="help-block text-red text-left" id="js-school_address"></div>
    </div>
    <div class="form-group col-md-4 input-last_sy_attended">
        <label for="">Last School Year Attended:</label>
        <select name="last_sy_attended" id="last_sy_attended" class="form-control form-control-sm">
        </select>
        <div class="help-block text-red text-left" id="js-last_sy_attended"></div>
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