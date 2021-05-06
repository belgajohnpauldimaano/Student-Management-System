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
    <div class="form-group col-md-5 input-father_contact">
        <label for="father_contact">Contact No.</label>
        <input type="text" class="form-control form-control-sm" id="father_contact" name="father_contact">
        <div class="help-block text-red text-left" id="js-father_contact">
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
    <div class="form-group col-md-5 input-mother_contact">
        <label for="mother_contact">Contact No.</label>
        <input type="text" class="form-control form-control-sm" id="mother_contact" name="mother_contact">
        <div class="help-block text-red text-left" id="js-mother_contact">
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
    <div class="form-group col-md-5 input-guardian_contact">
        <label for="guardian_contact">Contact No.</label>
        <input type="text" class="form-control form-control-sm" id="guardian_contact" name="guardian_contact">
        <div class="help-block text-red text-left" id="js-guardian_contact">
        </div>
    </div>
    <div class="col-md-12"></div>
    <div class="form-group col-md-4 input-no_siblings">
        <label for="">No. of your siblings (do not include yourself)</label>
        <select name="no_siblings" id="no_siblings" class="form-control form-control-sm">
            <option value="">Select No. of your siblings</option>
            @for ( $x = 0 ; $x < 15; $x++)
               <option>{{ $x }}</option>
            @endfor
        </select>
        <div class="help-block text-red text-left" id="js-no_siblings">
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @php
                    $scholar_type = [
                        "Employee's Child",
                        "With High Honors",
                        "With Highest Honors",
                        "ESC Grantee",
                        "Sibling Discount"
                    ];
                @endphp
                @foreach($scholar_type as $key => $checkbox)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="schoolar_type[]" class="form-check-input" id="check-box-{{$key}}">
                        <label class="form-check-label" for="check-box-{{$key}}">{{$checkbox}}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-row mt-2">
    <div class="form-group col-md-8">
        <label for=""><small>NAME OF BROTHER'S & SISTER(S) WHO ARE CURRENTLY ENROLLED</small></label>
        <input type="text" name="sibling_name" id="sibling_name" class="form-control form-control-sm">
    </div>
    <div class="form-group col-md-4 input-sibling_grade_level">
        <label for="">Grade Level</label>
        <select name="sibling_grade_level" id="sibling_grade_level" class="form-control form-control-sm">
            <option value="">Select Level</option>
            @for ( $x = 1 ; $x < 13; $x++)
               <option>{{ $x }}</option>
            @endfor
        </select>
        <div class="help-block text-red text-left" id="js-sibling_grade_level">
        </div>
    </div>
    <div class="form-group col-md-12 m-0 p-0">
        <button type="button" name="addSibling" id="addSibling" class="btn btn-sm btn-primary float-right mt-1" disabled>
            <i class="fas fa-plus"></i> Add
        </button>
    </div>

    <table class="table table-sm table-condensed mt-3">
        <thead>
            <tr>
                <th width="70%">Name</th>
                <th>Grade Level</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>name</td>
                <td>grade level</td>
            </tr>
        </tbody>
    </table>
</div>