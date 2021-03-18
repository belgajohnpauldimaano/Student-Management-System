$('.btn--update-photo').click(function(){
    $('.btn-upload-photo').click();
})

getSchoolYear();

function getSchoolYear()
{
    $.ajax({
        url : "/fetch-schoolyear",
        type : 'POST',
        data: {
            '_token' : $('input[name=_token]').val()
        },
        success     : function (res) {
            // $('#div-strand').html(res);
            $('#js_sy').empty();
            $('#sy').empty();

            let year  = CryptoJSAesJson.decrypt(res.school_year.toString(), res.data);
            let year_data_id  = CryptoJSAesJson.decrypt(res.school_year_id.toString(), res.data);
            let sy_list = CryptoJSAesJson.decrypt(res.school_year_list.toString(), res.data);

            $('#js_sy').append(`<h4 for="sy"><small>SY:</small> ` + year + `</h4>`);
            $('#sy').val(year_data_id);

            var school_years = sy_list;
            var len = school_years.length;

            $("#last_sy_attended").empty();
            for( var i = 0; i<len; i++){
                var id = school_years[i]['id'];
                var name = school_years[i]['school_year'];
                $("#last_sy_attended").append("<option value='"+id+"'>"+name+"</option>");
            }
            for (var x = 8 - 1; x >= 0; x--)
            {
                $("#last_sy_attended").append("<option>201"+x+"-201"+(x+1)+"</option>");
            }

            getModal();
        }
    });
}


function getModal() {
    
    $('.btn-enroll').click(function (e) {
        e.preventDefault();
        
        $('#js-registration').modal({
            backdrop: 'static',
            keyboard: false
        })
    })
}

$('#birthday').datepicker({
    autoclose: true
})
$("#terms").change(function (e) {
    e.preventDefault();
    if(this.checked) {
        $(".btn-submit-registration").prop('disabled', false);
    }else{
        $(".btn-submit-registration").prop('disabled', true);
    }                        
});

// $(document).on("change", "input[name='grade_level']", function (e) {
$("input[name='grade_level']").change(function(e) {
  e.preventDefault();
    let gradeLvl =  $(this).val();
  
    $('#div-strand').empty();
    if(gradeLvl == '11')
    {
      $.ajax({
          url : "/fetch-strand",
          type : 'POST',
          data: {
              '_token' : $('input[name=_token]').val()
          },
          success     : function (res) {
            $('#div-strand').html(res);
          }
      });
      
    }
});


$(document).on("change", "input[name='student_img']", function () {
    readImageURL(this)
});

function readImageURL(input) {
    $('#img--user_photo')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

$('body').on('submit', '#js-registration_form', function (e) {
    e.preventDefault();
    validate_form();    
    var formData = new FormData($(this)[0]);
    // alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-primary btn-flat";
    alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
    alertify.confirm('<i style="color: #0069d9" class="fas fa-question-circle"></i> Confirmation', 
    'Are you sure you want to register now? Please make sure your input are all correct. Thank you', function(){ 

        if(
            $('#lrn').val() != '' && $('#reg_type').val() != '' && $('#grade_lvl').val() != '' &&
            $('#first_name').val() != '' && $('#middle_name').val() != '' && $('#last_name').val() != '' && 
            $("#student_email").val() != '' && $('#phone').val().length == 13 && $('#guardian').val() != '' &&
            $('#address').val() != '' && $('#birthday').val() != '' && $('#gender').val() != '' && $('#student_img').val() != '' &&
            $('#mother_name').val() != '' && $('#father_name').val() != '' && $('#p_address').val() != '' &&
            $('#gwa').val() != '' && $('#last_sy_attended').val() != '' && $('#school_address').val() != '' && 
            $("input[name='school_type']").is(':checked') && $('#school_name').val() != '' &&  $('#citizenship').val() != '' && $('#religion').val() != '' && 
            $('#age').val() != '' && $('#place_of_birth').val() != '' && $('#fb_acct').val() != ''  && $("input[name='grade_level']").is(':checked') 
        )
        {
            $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : "/registration/save",
                    data        : formData,
                    processData : false,
                    contentType : false,
                    success     : function (res) {
                        $('.help-block').html('');
                        if (res.res_code == 1)
                        {
                            alertify.alert('<i style="color: red" class="fas fa-exclamation-triangle fa-lg"></i> Reminder',
                                ''+res.res_msg+'', function(){
                                    $('.input-lrn').addClass('has-error');
                                    $('.input-lrn').removeClass('has-success');
                                    $('#js-lrn').css('color', 'red').text('You must enter your LRN.');
                            });                                    
                        }
                        else
                        {
                            alertify.alert('<i style="color: green" class="fas fa-check-circle fa-lg"></i> Confirmation',
                            "Your information successfully submitted. Please wait the confirmation from Admission Office. Thank you!", function(){
                                $('#js-registration_form')[0].reset();                                    
                                var source = $("#default-img").val();
                                $('#img--user_photo').attr('src', source);
                                $('#div-strand').empty();
                                $('#js-registration').modal('hide');
                            });
                        }
                    }
                }); 
        }else{

                alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please fill out all fields! Thank you", function(){   
                    check_lrn();  
                    check_regtype();  
                    check_grade_lvl();     
                    check_first_name();  
                    check_middle_name();
                    check_last_name();
                    check_email();
                    check_phone();
                    check_guardian();
                    check_gender();
                    check_birthday();
                    check_address();
                    check_image();
                    check_p_address();
                    check_father_name();
                    check_mother_name();
                    check_fb_acct();
                    check_place_of_birth();
                    check_input_age();
                    check_religion();
                    check_citizenship();
                    check_school_name();
                    check_school_type();
                    check_school_address();
                    check_last_sy_attended();
                    check_gwa();
                    check_father_occupation();
                    check_mother_occupation();
                    check_father_fb_acct();
                    check_mother_fb_acct();
                    check_guardian_fb_acct();
                    check_no_siblings();
                    check_is_esc();
                });
        }   
    }, function(){  
        check_lrn();  
        check_regtype();  
        check_grade_lvl();     
        check_first_name();  
        check_middle_name();
        check_last_name();
        check_email();
        check_phone();
        check_guardian();
        check_gender();
        check_birthday();
        check_address();
        check_image();
        check_p_address();
        check_father_name();
        check_mother_name();
        check_fb_acct();
        check_place_of_birth();
        check_input_age();
        check_religion();
        check_citizenship();
        check_school_name();
        check_school_type();
        check_school_address();
        check_last_sy_attended();
        check_gwa();
        check_father_occupation();
        check_mother_occupation();
        check_father_fb_acct();
        check_mother_fb_acct();
        check_guardian_fb_acct();
        check_no_siblings();
        check_is_esc();
    });
});
            

validate_form();

            function validate_form(){            

                $('#lrn').keyup(function() {
                    check_lrn();
                });

                $('#lrn').focusin(function() {
                    check_lrn();
                });

                $('#reg_type').change(function() {
                    check_regtype();
                });

                $('#reg_type').focusin(function() {
                    check_regtype();
                });

                // $('#grade_lvl').change(function() {
                $(document).on("change","input[name='grade_level']", function(e) {
                    check_grade_lvl();
                });

                $("input[name='grade_level']").focusin(function() {
                    check_grade_lvl();
                });

                $('#first_name').keyup(function() {
                    check_first_name();
                });

                $('#first_name').focusin(function() {
                    check_first_name();
                });

                $('#middle_name').keyup(function() {
                    check_middle_name();
                });

                $('#middle_name').focusin(function() {
                    check_middle_name();
                });

                $('#last_name').keyup(function() {
                    check_last_name();
                });

                $('#last_name').focusin(function() {
                    check_last_name();
                });

                $('#student_email').keyup(function() {
                    check_email();
                });

                $('#student_email').focusin(function() {
                    check_email();
                });

                $('#phone').keyup(function() {
                    check_phone();
                });

                $('#phone').focusin(function() {
                    check_phone();
                });

                $('#guardian').keyup(function() {
                    check_guardian()
                });

                $('#guardian').focusin(function() {
                    check_guardian()
                });

                $('#gender').change(function() {
                    check_gender()
                });

                $('#gender').focusin(function() {
                    check_gender()
                });

                $('#birthday').change(function() {
                    check_birthday()
                });

                $('#birthday').focusin(function() {
                    check_birthday()
                });

                $('#address').keyup(function() {
                    check_address()
                });

                $('#address').focusin(function() {
                    check_address()
                });

                $('.btn--update-photo').focusin(function(){
                    check_image();
                });

                $('#student_img').change(function(){
                    check_image();
                });

                $('#p_address').focusin(function (){
                    check_p_address();
                })

                $('#p_address').keyup(function (){
                    check_p_address();
                })

                $('#father_name').focusin(function (){
                    check_father_name();
                })

                $('#father_name').keyup(function (){
                    check_father_name();
                })

                $('#mother_name').focusin(function (){
                    check_mother_name();
                })

                $('#mother_name').keyup(function (){
                    check_mother_name();
                })

                $('#fb_acct').keyup(function (){
                    check_fb_acct();
                })
                $('#fb_acct').focusin(function (){
                    check_fb_acct();
                })
                // 
                $('#place_of_birth').keyup(function (){
                    check_place_of_birth();
                })
                $('#place_of_birth').focusin(function (){
                    check_place_of_birth();
                })

                $('#age').keyup(function (){
                    check_input_age();
                })
                 $('#age').focusin(function (){
                    check_input_age();
                })

                $('#religion').keyup(function (){
                    check_religion();
                })
                $('#religion').focusin(function (){
                    check_religion();
                })

                $('#citizenship').keyup(function (){
                    check_citizenship();
                })
                $('#citizenship').focusin(function (){
                    check_citizenship();
                })

                $('#school_name').keyup(function (){
                    check_school_name();
                })
                $('#school_name').focusin(function (){
                    check_school_name();
                })

                $("input[name='school_type']").change(function (){
                    check_school_type();
                })
                $("input[name='school_type']").focusin(function (){
                    check_school_type();
                })

                $('#school_address').keyup(function (){
                    check_school_address();
                })
                $('#school_address').focusin(function (){
                    check_school_address();
                })

                $('#last_sy_attended').keyup(function (){
                    check_last_sy_attended();
                })
                $('#last_sy_attended').focusin(function (){
                    check_last_sy_attended();
                })

                $('#gwa').keyup(function (){
                    check_gwa();
                })
                $('#gwa').focusin(function (){
                    check_gwa();
                })

                $('#father_occupation').keyup(function (){
                    check_father_occupation();
                })
                $('#father_occupation').focusin(function (){
                    check_father_occupation();
                })

                $('#mother_occupation').keyup(function (){
                    check_mother_occupation();
                })
                $('#mother_occupation').focusin(function (){
                    check_mother_occupation();
                })

                $('#father_fb_acct').keyup(function (){
                    check_father_fb_acct();
                })
                 $('#father_fb_acct').focusin(function (){
                    check_father_fb_acct();
                })

                $('#mother_fb_acct').keyup(function (){
                    check_mother_fb_acct();
                })
                 $('#mother_fb_acct').focusin(function (){
                    check_mother_fb_acct();
                })

                // $("input[name='is_esc']").change(function(){
                $(document).on("change","input[name='is_esc']", function(e) {
                    check_is_esc();
                });

                $(document).on("focusin","input[name='is_esc']", function(e) {
                    check_is_esc();
                });
                
                $('#guardian_fb_acct').keyup(function (){
                    check_guardian_fb_acct();
                })

                
                $('#guardian_fb_acct').focusin(function (){
                    check_guardian_fb_acct();
                })
                
                $('#no_siblings').change(function(){
                    check_no_siblings();
                });

                $('#no_siblings').focusin(function(){
                    check_no_siblings();
                });

                // 
                

            }

            
                function check_lrn(){
                    var x = $('#lrn').val();

                    if(x != ''){
                        $('.input-lrn').addClass('has-success');
                        $('.input-lrn').removeClass('has-error');
                        $('#js-lrn').text('Reminder: Double check your LRN!').css('color', 'green');               
                    }else{
                        $('.input-lrn').addClass('has-error');
                        $('.input-lrn').removeClass('has-success');
                        $('#js-lrn').css('color', 'red').text('You must enter your LRN.');
                    }
                }

                function check_regtype(){
                    var x = $('#reg_type').val();

                    if(x != ''){
                        $('.input-reg_type').addClass('has-success');
                        $('.input-reg_type').removeClass('has-error');
                        $('#js-reg_type').text('').css('color', 'green');               
                    }else{
                        $('.input-reg_type').addClass('has-error');
                        $('.input-reg_type').removeClass('has-success');
                        $('#js-reg_type').css('color', 'red').text('You must select your registration type.');
                    }
                }

                function check_grade_lvl(){
                    // alert(gradeLvl
                    var x = $("input[name='grade_level']").is(':checked');
                    if(x)
                    {
                        // if(x!='')
                            $('.input-grade_lvl').addClass('has-success');
                            $('.input-grade_lvl').removeClass('has-error');
                            $('#js-grade_level').text('').css('color', 'green');               
                    }
                    else
                    {
                        $('.input-grade_lvl').addClass('has-error');
                        $('.input-grade_lvl').removeClass('has-success');
                        $('#js-grade_level').css('color', 'red').text('You must select your incoming grade level.');
                    }
                }

                function check_fb_acct(){
                    var x = $('#fb_acct').val();

                    if(x != ''){
                        $('.input-fb_acct').addClass('has-success');
                        $('.input-fb_acct').removeClass('has-error');
                        $('#js-fb_acct').text('').css('color', 'green');               
                    }else{
                        $('.input-fb_acct').addClass('has-error');
                        $('.input-fb_acct').removeClass('has-success');
                        $('#js-fb_acct').css('color', 'red').text('You must enter your fb/Messenger acct.');
                    }
                }
                //
                function check_place_of_birth(){
                    var x = $('#place_of_birth').val();

                    if(x != ''){
                        $('.input-place_of_birth').addClass('has-success');
                        $('.input-place_of_birth').removeClass('has-error');
                        $('#js-place_of_birth').text('').css('color', 'green');               
                    }else{
                        $('.input-place_of_birth').addClass('has-error');
                        $('.input-place_of_birth').removeClass('has-success');
                        $('#js-place_of_birth').css('color', 'red').text('You must enter your place of birth.');
                    }
                }

                function check_input_age(){
                    var x = $('#age').val();

                    if(x != ''){
                        $('.input-age').addClass('has-success');
                        $('.input-age').removeClass('has-error');
                        $('#js-age').text('').css('color', 'green');               
                    }else{
                        $('.input-age').addClass('has-error');
                        $('.input-age').removeClass('has-success');
                        $('#js-age').css('color', 'red').text('You must enter your age.');
                    }
                }

                function check_religion(){
                    var x = $('#religion').val();

                    if(x != ''){
                        $('.input-religion').addClass('has-success');
                        $('.input-religion').removeClass('has-error');
                        $('#js-religion').text('').css('color', 'green');               
                    }else{
                        $('.input-religion').addClass('has-error');
                        $('.input-religion').removeClass('has-success');
                        $('#js-religion').css('color', 'red').text('You must enter your religion.');
                    }
                }

                function check_citizenship(){
                    var x = $('#citizenship').val();

                    if(x != ''){
                        $('.input-citizenship').addClass('has-success');
                        $('.input-citizenship').removeClass('has-error');
                        $('#js-citizenship').text('').css('color', 'green');               
                    }else{
                        $('.input-citizenship').addClass('has-error');
                        $('.input-citizenship').removeClass('has-success');
                        $('#js-citizenship').css('color', 'red').text('You must enter your citizenship.');
                    }
                }      

                function check_school_name(){
                    var x = $('#school_name').val();

                    if(x != ''){
                        $('.input-school_name').addClass('has-success');
                        $('.input-school_name').removeClass('has-error');
                        $('#js-school_name').text('').css('color', 'green');               
                    }else{
                        $('.input-school_name').addClass('has-error');
                        $('.input-school_name').removeClass('has-success');
                        $('#js-school_name').css('color', 'red').text('You must enter your school name.');
                    }
                }   

                function check_school_type(){
                    var x = $("input[name='school_type']").is(':checked');
                    if(x)
                    {
                        $('.input-school_type').addClass('has-success');
                        $('.input-school_type').removeClass('has-error');
                        $('#js-school_type').text('').css('color', 'green');               
                    }else{
                        $('.input-school_type').addClass('has-error');
                        $('.input-school_type').removeClass('has-success');
                        $('#js-school_type').css('color', 'red').text('You must enter your school type.');
                    }
                    
                }   

                function check_school_address(){
                    var x = $('#school_address').val();

                    if(x != ''){
                        $('.input-school_address').addClass('has-success');
                        $('.input-school_address').removeClass('has-error');
                        $('#js-school_address').text('').css('color', 'green');               
                    }else{
                        $('.input-school_address').addClass('has-error');
                        $('.input-school_address').removeClass('has-success');
                        $('#js-school_address').css('color', 'red').text('You must enter your school address.');
                    }
                } 

                function check_last_sy_attended(){
                    var x = $('#last_sy_attended').val();

                    if(x != ''){
                        $('.input-last_sy_attended').addClass('has-success');
                        $('.input-last_sy_attended').removeClass('has-error');
                        $('#js-last_sy_attended').text('').css('color', 'green');               
                    }else{
                        $('.input-last_sy_attended').addClass('has-error');
                        $('.input-last_sy_attended').removeClass('has-success');
                        $('#js-last_sy_attended').css('color', 'red').text('You must enter your last year attended.');
                    }
                }      

                function check_gwa(){
                    var x = $('#gwa').val();

                    if(x != ''){
                        $('.input-gwa').addClass('has-success');
                        $('.input-gwa').removeClass('has-error');
                        $('#js-gwa').text('').css('color', 'green');               
                    }else{
                        $('.input-gwa').addClass('has-error');
                        $('.input-gwa').removeClass('has-success');
                        $('#js-gwa').css('color', 'red').text('You must enter your average (GWA).');
                    }
                }    

                function check_is_esc(){
                    
                    var x = $("input[name='is_esc']").is(':checked');
                    if(x)
                    {
                        $('.input-is_esc').addClass('has-success');
                        $('.input-is_esc').removeClass('has-error');
                        $('#js-is_esc').text('').css('color', 'green');
                    }
                    else
                    {
                        $('.input-is_esc').addClass('has-error');
                        $('.input-is_esc').removeClass('has-success');
                        $('#js-is_esc').css('color', 'red').text('You must select the esc.');
                    }
                }

                function check_father_occupation(){
                    var x = $('#father_occupation').val();

                    if(x != ''){
                        $('.input-father_occupation').addClass('has-success');
                        $('.input-father_occupation').removeClass('has-error');
                        $('#js-father_occupation').text('').css('color', 'green');               
                    }else{
                        $('.input-father_occupation').addClass('has-error');
                        $('.input-father_occupation').removeClass('has-success');
                        $('#js-father_occupation').css('color', 'red').text("You must enter your father's occupation.");
                    }
                }

                function check_mother_occupation(){
                    var x = $('#mother_occupation').val();

                    if(x != ''){
                        $('.input-mother_occupation').addClass('has-success');
                        $('.input-mother_occupation').removeClass('has-error');
                        $('#js-mother_occupation').text('').css('color', 'green');               
                    }else{
                        $('.input-mother_occupation').addClass('has-error');
                        $('.input-mother_occupation').removeClass('has-success');
                        $('#js-mother_occupation').css('color', 'red').text("You must enter your mother's occupation.");
                    }
                }

                function check_father_fb_acct(){
                    var x = $('#father_fb_acct').val();

                    if(x != ''){
                        $('.input-father_fb_acct').addClass('has-success');
                        $('.input-father_fb_acct').removeClass('has-error');
                        $('#js-father_fb_acct').text('').css('color', 'green');               
                    }else{
                        $('.input-father_fb_acct').addClass('has-error');
                        $('.input-father_fb_acct').removeClass('has-success');
                        $('#js-father_fb_acct').css('color', 'red').text("You must enter your father's fb/messenger account.");
                    }
                }

                function check_mother_fb_acct(){
                    var x = $('#mother_fb_acct').val();

                    if(x != ''){
                        $('.input-mother_fb_acct').addClass('has-success');
                        $('.input-mother_fb_acct').removeClass('has-error');
                        $('#js-mother_fb_acct').text('').css('color', 'green');               
                    }else{
                        $('.input-mother_fb_acct').addClass('has-error');
                        $('.input-mother_fb_acct').removeClass('has-success');
                        $('#js-mother_fb_acct').css('color', 'red').text("You must enter your mother's fb/messenger account.");
                    }
                }

                function check_guardian_fb_acct(){
                    var x = $('#guardian_fb_acct').val();

                    if(x != ''){
                        $('.input-guardian_fb_acct').addClass('has-success');
                        $('.input-guardian_fb_acct').removeClass('has-error');
                        $('#js-guardian_fb_acct').text('').css('color', 'green');               
                    }else{
                        $('.input-guardian_fb_acct').addClass('has-error');
                        $('.input-guardian_fb_acct').removeClass('has-success');
                        $('#js-guardian_fb_acct').css('color', 'red').text("You must enter your guardian's fb/messenger account.");
                    }
                }

                function check_no_siblings(){
                    var x = $('#no_siblings').val();

                    if(x != '0'){
                        $('.input-no_siblings').addClass('has-success');
                        $('.input-no_siblings').removeClass('has-error');
                        $('#js-no_siblings').text('').css('color', 'green');               
                    }else{
                        $('.input-no_siblings').addClass('has-error');
                        $('.input-no_siblings').removeClass('has-success');
                        $('#js-no_siblings').css('color', 'red').text("You must select how many siblings you have.");
                    }
                }

                function check_first_name(){
                    var x = $('#first_name').val();

                    if(x != ''){
                        $('.input-first_name').addClass('has-success');
                        $('.input-first_name').removeClass('has-error');
                        $('#js-first_name').text('').css('color', 'green');               
                    }else{
                        $('.input-first_name').addClass('has-error');
                        $('.input-first_name').removeClass('has-success');
                        $('#js-first_name').css('color', 'red').text('You must enter your first name.');
                    }
                }

                function check_middle_name(){
                    var x = $('#middle_name').val();

                    if(x != ''){
                        $('.input-middle_name').addClass('has-success');
                        $('.input-middle_name').removeClass('has-error');
                        $('#js-middle_name').text('').css('color', 'green');               
                    }else{
                        $('.input-middle_name').addClass('has-error');
                        $('.input-middle_name').removeClass('has-success');
                        $('#js-middle_name').css('color', 'red').text('You must enter your middle name.');
                    }
                }

                function check_last_name(){
                    var x = $('#last_name').val();

                    if(x != ''){
                        $('.input-last_name').addClass('has-success');
                        $('.input-last_name').removeClass('has-error');
                        $('#js-last_name').text('').css('color', 'green');               
                    }else{
                        $('.input-last_name').addClass('has-error');
                        $('.input-last_name').removeClass('has-success');
                        $('#js-last_name').css('color', 'red').text('You must enter your last name.');
                    }
                }
                
            function check_email(){
                var email = $("#student_email").val();

                if(email != 0)
                {
                    if(isValidEmailAddress(email))
                    {
                        $('.input-student_email').addClass('has-success');
                        $('.input-student_email').removeClass('has-error');
                        $('#js-student_email').css('color', 'green').text('Double check your email address and you are good to go!'); 
                    } else {
                        $('.input-student_email').addClass('has-error');
                        $('.input-student_email').removeClass('has-success');
                        $('#js-student_email').css('color', 'red').text('invalid email address.');
                    }
                } else {
                    $('.input-student_email').addClass('has-error');
                    $('.input-student_email').removeClass('has-success');
                    $('#js-student_email').css('color', 'red').text('You must enter your email address.');       
                }
            }

            function isValidEmailAddress(emailAddress) {
                var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                return pattern.test(emailAddress);
            }

            function check_phone(){
                var phone = $('#phone').val();
                
                if(phone.length===13){
                    $('.input-phone').addClass('has-success');
                    $('.input-phone').removeClass('has-error');
                    $('#js-phone').css('color', 'green').text('');               
                }else{
                    $('.input-phone').addClass('has-error');
                    $('.input-phone').removeClass('has-success');
                    $('#js-phone').css('color', 'red').text('You must enter your phone number.');
                }
            }


            function check_guardian(){
                var guardian = $('#guardian').val();
                
                if(guardian != ''){
                    $('.input-guardian').addClass('has-success');
                    $('.input-guardian').removeClass('has-error');
                    $('#js-guardian').css('color', 'green').text('');               
                }else{
                    $('.input-guardian').addClass('has-error');
                    $('.input-guardian').removeClass('has-success');
                    $('#js-guardian').css('color', 'red').text("You must enter your guardian's name.");
                }
            }

            function check_father_name(){
                var x = $('#father_name').val();
                
                if(x != ''){
                    $('.input-father_name').addClass('has-success');
                    $('.input-father_name').removeClass('has-error');
                    $('#js-father_name').css('color', 'green').text('');               
                }else{
                    $('.input-father_name').addClass('has-error');
                    $('.input-father_name').removeClass('has-success');
                    $('#js-father_name').css('color', 'red').text("You must enter your father's name.");
                }
            }

            function check_mother_name(){
                var x = $('#mother_name').val();
                
                if(x != ''){
                    $('.input-mother_name').addClass('has-success');
                    $('.input-mother_name').removeClass('has-error');
                    $('#js-mother_name').css('color', 'green').text('');               
                }else{
                    $('.input-mother_name').addClass('has-error');
                    $('.input-mother_name').removeClass('has-success');
                    $('#js-mother_name').css('color', 'red').text("You must enter your mother's name.");
                }
            }

            function check_address(){
                var address = $('#address').val();
                
                if(address != ''){
                    $('.input-address').addClass('has-success');
                    $('.input-address').removeClass('has-error');
                    $('#js-address').css('color', 'green').text('');               
                }else{
                    $('.input-address').addClass('has-error');
                    $('.input-address').removeClass('has-success');
                    $('#js-address').css('color', 'red').text('You must enter your current address.');
                }
            }

            
            function check_p_address(){
                var p_address = $('#p_address').val();
                
                if(p_address != ''){
                    $('.input-p_address').addClass('has-success');
                    $('.input-p_address').removeClass('has-error');
                    $('#js-p_address').css('color', 'green').text('');               
                }else{
                    $('.input-p_address').addClass('has-error');
                    $('.input-p_address').removeClass('has-success');
                    $('#js-p_address').css('color', 'red').text('You must enter your permanent address.');
                }
            }

            function check_birthday(){
                var birthdate = $('#birthday').val();
                
                if(birthdate != ''){
                    $('.input-birthday').addClass('has-success');
                    $('.input-birthday').removeClass('has-error');
                    $('#js-birthdate').css('color', 'green').text('');               
                }else{
                    $('.input-birthday').addClass('has-error');
                    $('.input-birthday').removeClass('has-success');
                    $('#js-birthdate').css('color', 'red').text('You must select your birthdate.');
                }
            }

            function check_gender(){
                    var x = $('#gender').val();

                    if(x != ''){
                        $('.input-gender').addClass('has-success');
                        $('.input-gender').removeClass('has-error');
                        $('#js-gender').text('').css('color', 'green');               
                    }else{
                        $('.input-gender').addClass('has-error');
                        $('.input-gender').removeClass('has-success');
                        $('#js-gender').css('color', 'red').text('You must select your Grave level.');
                    }
                }

                
                function check_image(){
                    var image = $('#student_img').val();

                    if(image != ''){                        
                        $('.btn--update-photo').addClass('has-success');
                        $('.btn--update-photo').removeClass('has-error');
                        $('#js-student_img').css('color', 'green').text('');               
                    }else{
                        $('.btn--update-photo').addClass('has-error');
                        $('.btn--update-photo').removeClass('has-success');
                        $('#js-student_img').css('color', 'red').text('You must upload your 2x2 picture with white background.');
                    }
                }


                

// $(window).on('load',function(){            
		// 	$('#js_reservation').modal({
		// 			backdrop: 'static',
		// 			keyboard: false
		// 	}, 'show');
        // }); 

        // $grade7_list = "{{ asset('json/grade7_list.json') }}";
        // $.getJSON($grade7_list, function(data){
        //         var company_table = '';
        //         $.each(data, function(key, value){
        //             company_table += '<tr align="center">';
        //             company_table += '<td>'+value.column0+'';
        //             company_table += '<td>'+value.column1+'';
        //             });
               
        //         $("#reservation_grade7 tbody").html("");
        //         $('#reservation_grade7 tbody').append(company_table);
        // });


        // $url_reservatoin = "{{ asset('json/list_reservation.json') }}";
        // $.getJSON($url_reservatoin, function(data){
        //         var company_table = '';
        //         $.each(data, function(key, value){
        //             company_table += '<tr align="center">';
        //             company_table += '<td>'+value.column0+'';
        //             company_table += '<td>'+value.column1+'';
        //             company_table += '<td>'+value.column2+'';
        //         });
               
        //         $("#reservation tbody").html("");
        //         $('#reservation tbody').append(company_table);
        // });

        // $entrance_passer = "{{ asset('json/entrance_passer.json') }}";
        // $.getJSON($entrance_passer, function(data){
        //         var passer_table = '';
        //         $.each(data, function(key, value){
        //             passer_table += '<tr align="center">';
        //             passer_table += '<td style="width: 10%">'+value.column0+'';
        //             passer_table += '<td>'+value.column2+'';
        //         });
               
        //         $("#passer tbody").html("");
        //         $('#passer tbody').append(passer_table);
        // });

        // $waiting_jan2020 = "{{ asset('json/waiting_jan2020.json') }}";
        // $.getJSON($waiting_jan2020, function(data){
        //         var passer_table = '';
        //         $.each(data, function(key, value){
        //             passer_table += '<tr align="center">';
        //             passer_table += '<td style="width: 10%">'+value.column0+'';
        //             passer_table += '<td>'+value.column2+'';
        //         });
               
        //         $("#waiting_jan_2020 tbody").html("");
        //         $('#waiting_jan_2020 tbody').append(passer_table);
        // });

        // $list_feb2020 = "{{ asset('json/list_feb2020.json') }}";
        // $.getJSON($list_feb2020, function(data){
        //         var passer_table = '';
        //         $.each(data, function(key, value){
        //             passer_table += '<tr align="center">';
        //             passer_table += '<td style="width: 10%">'+value.column0+'';
        //             passer_table += '<td>'+value.column2+'';
        //         });
               
        //         $("#list_feb2020 tbody").html("");
        //         $('#list_feb2020 tbody').append(passer_table);
        // });

        // $waiting_feb2020 = "{{ asset('json/waiting_feb2020.json') }}";
        // $.getJSON($waiting_feb2020, function(data){
        //         var passer_table = '';
        //         $.each(data, function(key, value){
        //             passer_table += '<tr align="center">';
        //             passer_table += '<td style="width: 10%">'+value.column0+'';
        //             passer_table += '<td>'+value.column2+'';
        //         });
               
        //         $("#waiting_feb2020 tbody").html("");
        //         $('#waiting_feb2020 tbody').append(passer_table);
        // });

            // signature for application
            // var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            //     backgroundColor: 'rgba(255, 255, 255, 0)',
            //     penColor: 'rgb(0, 0, 0)'
            // });

            // var saveButton = document.getElementById('save');
            // var cancelButton = document.getElementById('clear');

            // saveButton.addEventListener('click', function(event) {
            //     var data = signaturePad.toDataURL();
            //     console.log(data);
            // });

            // cancelButton.addEventListener('click', function(event) {
            //     signaturePad.clear();
            // });

            // var  terms = $('#terms').val();
            // if( terms != 1){  
                
            // } 

        
        // $("input[name='grade_level']").change(function() {
        //     // alert()
        //     let g_level = $("input[name='grade_level']").val();
        //     if(g_level === '11'){
        //         $('.div-strand').removeClass('d-none');
        //     }else{
        //         $('.div-strand').addClass('d-none');
        //     }
        // });  

$('#js-contactForm').validate({
    rules: {
        name: "required",
        subject: "required",            
        email: {
            required: true,
            email: true
        },
        mobile: "required",
        message: "required"
    },
    errorElement: "span" ,  
    errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
    },                          
    messages: {
        name: "Please enter your first name",
        email: "Please enter valid email address",
        mobile: "Please enter your mobile/phone number",
        message: "Please enter message",
        subject: "Please enter subject"
    },

    submitHandler: function(form) {
        var dataparam = $('#js-contactForm').serialize();
            alertify.defaults.theme.ok = "btn btn-primary";
            $.ajax({     
                url: "/send-email",
                type: "POST",
                data        : dataparam,
                datatype: 'json',
                beforeSend: function() { 
                    $('#preloader').removeClass('d-none');
                },
                success: function(res) {
                    $('.help-block').html('');
                    if (res.res_code == 1)
                    {
                        alertify.alert('<i style="color: red" class="fas fa-exclamation-triangle fa-lg"></i> Reminder',
                            ''+res.res_msg+'', function(){
                        });                                    
                    }
                    else
                    {
                        alertify.alert('<i style="color: green" class="fas fa-check-circle fa-lg"></i> Confirmation',
                        "Your email successfully submitted. Thank you!", function(){
                            $('#js-contactForm')[0].reset();
                            $('#preloader').addClass('d-none');
                        });                                
                    }
            }
        });
    }                
});