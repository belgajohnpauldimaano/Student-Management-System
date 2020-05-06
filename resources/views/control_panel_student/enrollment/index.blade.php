@extends('control_panel_student.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Enrollment
    
@endsection

@section ('content')    
<button style="display: none; margin-top: -2.4em" id="back_method" class="btn-success btn pull-right">
    <i class="fas fa-arrow-left"></i> back
</button>
    <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
    <div class="js-data-container" style="margin-top: 10px;">
        @include('control_panel_student.enrollment.partials.data_list')
    </div>
    @include('control_panel_student.enrollment.partials.modal_profile')
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        
        validate_form()
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('student.enrollment.index') }}",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                }
            });
        }
        $(function () {
            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#search_class_subject').val()) {
                    alert('Please select a subject');
                    return;
                }
                fetch_data();
            });
            $('body').on('change', '#search_sy', function () {
                $.ajax({
                    url : "{{ route('faculty.subject_class.list_class_subject_details') }}",
                    type : 'POST',
                    {{--  dataType    : 'JSON',  --}}
                    data        : {_token: '{{ csrf_token() }}', search_sy: $('#search_sy').val()},
                    success     : function (res) {

                        $('#search_class_subject').html(res);
                    }
                })
            })
        });

        $('body').on('submit', '#js-enrollment_transaction_form', function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url         : "{{ route('student.enrollment.save_data') }}",
                type        : 'POST',
                data        : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    $('.help-block').html('');
                    if (res.res_code == 1)
                    {
                        for (var err in res.res_error_msg)
                        {
                            $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                        }
                    }
                    else
                    {
                        // $('.js-modal_holder .modal').modal('hide');
                        show_toast_alert({
                            heading : 'Success',
                            message : res.res_msg,
                            type    : 'success'
                        });

                        // fetch_data();
                    }
                }
            });
        });

        function validate_form(){            
        
        $('#pay_fee').keyup(function() {
            var payment = $('#pay_fee').val();
            var downpayment = $('#downpayment').val();
            $('#dp_enrollment').text(payment);

            if(payment>=downpayment){
                $('.input-payment').addClass('has-success');
                $('.input-payment').removeClass('has-error');
                $('#js-pay_fee').text('You are good to go!');
            }else if(payment<downpayment){
                $('.input-payment').addClass('has-error');
                $('.input-payment').removeClass('has-success');
                $('#js-pay_fee').text('You have to enter the amount of downpayment.');
            }
        });

        $('#phone').keyup(function() {
            var phone = $('#phone').val();
            var len = jQuery('#phone').html().length
            if(phone.length===13){
                $('.input-phone').addClass('has-success');
                $('.input-phone').removeClass('has-error');
                $('#js-number').text('You are good to go!');               
            }else{
                $('.input-phone').addClass('has-error');
                $('.input-phone').removeClass('has-success');
                $('#js-number').text('You must be enter your phone number.');
            }
        });

        $("#email").keyup(function(){
            var email = $("#email").val();

            if(email != 0)
            {
                if(isValidEmailAddress(email))
                {
                    $('.input-email').addClass('has-success');
                    $('.input-email').removeClass('has-error');
                    $('#js-email').text('You are good to go!'); 
                } else {
                    $('.input-email').addClass('has-error');
                    $('.input-email').removeClass('has-success');
                    $('#js-email').text('invalid email address.');
                }
            } else {
                $('.input-email').addClass('has-error');
                $('.input-email').removeClass('has-success');
                $('#js-email').text('You must be enter your email address.');       
            }

        });

        // function isValidEmailAddress(emailAddress) {
        //     var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        //     return pattern.test(emailAddress);
        // }
        

        $('.btn-reset').on('click', function(){
            location.reload();
        });
    }

    $('body').on('change','#payment_category', function(){
        var payment_category = $('#payment_category').val();
        if(payment_category==1){
            $('#form_method').addClass('has-success');
            $('#form_method').removeClass('has-error');
            $('#js-payment_category').html('<i class="fa fa-check"></i> Choose your desire method'); 
        }else if(payment_category==2){
            $('#form_method').addClass('has-success');
            $('#form_method').removeClass('has-error');
            $('#js-payment_category').html('<i class="fa fa-check"></i> Choose your desire method'); 
        }else if(payment_category==0){
            $('#form_method').addClass('has-error');
            $('#form_method').removeClass('has-success');
            $('#js-payment_category').html('<i class="fa fa-times-circle-o"></i> Choose your desire method');       
        }
         
    });

    var $getEvent = '';
    

    function getProfiledata(){
      $.ajax({
            url : "{{ route('student.my_account.fetch_profile') }}",
            type : 'POST',
            data        : {_token: '{{ csrf_token() }}'},
            success     : function (res) {
                const bday = new Date(res.Profile.birthdate)
                $('.help-block').html('');
                if(res.Profile.first_name == null || res.Profile.middle_name ==null || res.Profile.last_name ==null || res.Profile.contact_number == null || res.Profile.email == null || res.Profile.p_address == null || bday == null || res.Profile.father_name == null || res.Profile.mother_name == null || res.Profile.gender == null){
                    $getEvent = 'true';
                    $('.modal-update-profile').modal({ backdrop : 'static' });
                    $('#first_name').val(res.Profile.first_name);
                    $('#middle_name').val(res.Profile.middle_name);
                    $('#last_name').val(res.Profile.last_name);
                    $('#contact_number').val(res.Profile.contact_number != null ? res.Profile.contact_number : '+639');
                    $('#profile_email').val(res.Profile.email);
                    $('#c_address').val(res.Profile.c_address);
                    $('#p_address').val(res.Profile.p_address);
                    $('#birthday').val((bday.getMonth() + 1).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false}) + `/` + bday.getDate().toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false}) +`/` + bday.getFullYear());
                    $('#father_name').val(res.Profile.father_name);     
                    $('#mother_name').val(res.Profile.mother_name);    
                    $('#gender').val(res.Profile.gender);
                    $('.birthday').datepicker({
                        autoclose: true
                    })                     
                }
                else
                {
                    $getEvent = 'false';
                }
                
            }
        })
    }
    
    $('#btn_method').on('click', function(e){
        e.preventDefault(e);
        var payment_category = $('#payment_category').val();
        
        if(payment_category==1){
            // getProfiledata();
            
            $("#online").fadeIn();
            $('#selector_payment').hide();
            $('#online').css('display','block');
            $('#deposit').css('display','none');
            $('#back_method').css('display','block');
            $('#js-payment_category').html('');
        }else if(payment_category==2){
            // getProfiledata();
            
            $("#deposit").fadeIn();
            $('#selector_payment').hide();
            $('#back_method').css('display','block');
            $('#online').css('display','none');
            $('#deposit').css('display','block');
            $('#js-payment_category').html('');
        }else if(payment_category==0){
            // alert('sorry')
            $('#form_method').addClass('has-error');
            $('#form_method').removeClass('has-success');
            $('#js-payment_category').html('<i class="fa fa-times-circle-o"></i> Choose your desire method');       
        }
    });

    $('#back_method').on('click', function(){
        $("#selector_payment").fadeIn();
        $('#selector_payment').show();        
        $('#back_method').css('display','none');
        $('#deposit').css('display','none');
        $('#online').css('display','none');
    });

    //photo 
    $('body').on('click', '.btn--update-photo', function (e) {
        $('#user--photo').click()
    })
    $('body').on('change', '#user--photo', function (e) {
        readURL($(this))
        $('body').on('submit', '#form_user_photo_uploader', function (frm) {
          frm.preventDefault();  
        })  
    })

    $('#form_user_photo_uploader').hide();
    function readURL(input) {
        var url = input[0].value;        	
        
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input[0].files && input[0].files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img--user_photo').attr('src', e.target.result);
                
                var formData = new FormData($('#form_user_photo_uploader')[0]);
                formData.append('user_photo', $('#user--photo'));
                formData.append('_token', '{{ csrf_token() }}');
                console.log(formData)
                $.ajax({
                    url : "{{ route('student.my_account.change_my_photo') }}",
                    type : 'POST',
                    data : formData,
                    processData : false,
                    contentType : false,
                    success     : function (res) {
                        console.log(res)
                    }
                })
            }
            reader.readAsDataURL(input[0].files[0]);
        }else{
            $('#img--user_photo').attr('src', '/assets/no_preview.png');
        }
    }

    $('.close').click(function(){
        $('#warning-modal').fadeIn('2000');
        $('#warning-modal').addClass('has-error');
        $('#js-warning-modal').html('<i class="fa fa-times-circle-o"></i> Please, input all the blank fields it is required before you proceed to enrollment procedure.');     
    })

    $('#contact_number').keyup(function() {
        if($('#contact_number').val().length===13){
            $('.phone').addClass('has-success');
            $('.phone').removeClass('has-error');
            $('#js-contact_number').text('You are good to go!'); 
        }else{                
            $('.phone').addClass('has-error');
            $('.phone').removeClass('has-success');
        }
    });

    $('#first_name').keyup(function() {
        if($('#first_name').val() == ''){
            $('.first').addClass('has-error');
            $('.first').removeClass('has-success');
        }else{                
            $('.first').addClass('has-success');
            $('.first').removeClass('has-error');
            $('#js-first_name').text('You are good to go!'); 
        }
    });
    
    $('#middle_name').keyup(function() {
        if($('#middle_name').val() == ''){
            $('.middle').addClass('has-error'); 
            $('.middle').removeClass('has-success');
        }else{                
            $('.middle').addClass('has-success');
            $('.middle').removeClass('has-error');
            $('#js-middle_name').text('You are good to go!'); 
        }   
    });

    $('#last_name').keyup(function() {
        if($('#last_name').val() == ''){
            $('.last').addClass('has-error');
            $('.last').removeClass('has-success');
        }else{                
            $('.last').addClass('has-success');
            $('.last').removeClass('has-error');
            $('#js-last_name').text('You are good to go!'); 
        }
    });

    $('#gender').keyup(function() {
        if($('#gender').val() == ''){
            $('.gender').addClass('has-error');
            $('.gender').removeClass('has-success');
        }else{                
            $('.gender').addClass('has-success');
            $('.gender').removeClass('has-error');
            $('#js-gender').text('You are good to go!'); 
        }
    });
    
    $("#profile_email").keyup(function(){
            var email = $("#profile_email").val();

            if(email != 0)
            {
                if(isValidEmailAddress(email))
                {
                    $('.e_add').addClass('has-success');
                    $('.e_add').removeClass('has-error');
                    $('#js-profile_email').text('You are good to go!'); 
                } else {
                    $('.e_add').addClass('has-error');
                    $('.e_add').removeClass('has-success');
                    // $('#js-profile_email').text('You are good to go!'); 
                }
            } else {
                $('.e_add').addClass('has-error');
                $('.e_add').removeClass('has-success');
                  
            }

    });

    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }

    $('#birthday').keyup(function() {
        if($('#birthday').val() == ''){
            $('.b_day').addClass('has-error');
            $('.b_day').removeClass('has-success');
        }else{                
            $('.b_day').addClass('has-success');
            $('.b_day').removeClass('has-error');
            $('#js-birthday').text('You are good to go!'); 
        }   
    });
    $('#c_address').keyup(function() {
        if($('#c_address').val() == ''){
            $('.c_add').addClass('has-error');
            $('.c_add').removeClass('has-success');
        }else{                
            $('.c_add').addClass('has-success');
            $('.c_add').removeClass('has-error');
            $('#js-c_address').text('You are good to go!');
        }  
    });
    $('#p_address').keyup(function() {
        if($('#p_address').val() == ''){
            $('.p_add').addClass('has-error');
            $('.p_add').removeClass('has-success');
        }else{                
            $('.p_add').addClass('has-success');
            $('.p_add').removeClass('has-error');
            $('#js-p_address').text('You are good to go!');
        }   
    });
    $('#father_name').keyup(function() {
        if($('#father_name').val() == ''){
            $('.f_name').addClass('has-error');
            $('.f_name').removeClass('has-success');
        }else{                
            $('.f_name').addClass('has-success');
            $('.f_name').removeClass('has-error');
            $('#js-father_name').text('You are good to go!');
        }  
    });
    $('#mother_name').keyup(function() {
        if($('#mother_name').val() == ''){
            $('.m_name').addClass('has-error');
            $('.m_name').removeClass('has-success');
        }else{                
            $('.m_name').addClass('has-success');
            $('.m_name').removeClass('has-error');
            $('#js-mother_name').text('You are good to go!');
        }
    });
    
    function validateProfile(){
       
        if($('#contact_number').val().length===13){
            $('.phone').addClass('has-success');
            $('.phone').removeClass('has-error');
        }else{                
            $('.phone').addClass('has-error');
            $('.phone').removeClass('has-success');
        }
        
        if($('#first_name').val() == ''){
            $('.first').addClass('has-error');
            $('.first').removeClass('has-success');
        }else{                
            $('.first').addClass('has-success');
            $('.first').removeClass('has-error');
        }
        
        if($('#middle_name').val() == ''){
            $('.middle').addClass('has-error'); 
            $('.middle').removeClass('has-success');
        }else{                
            $('.middle').addClass('has-success');
            $('.middle').removeClass('has-error');
        }               
        
        if($('#last_name').val() == ''){
            $('.last').addClass('has-error');
            $('.last').removeClass('has-success');
        }else{                
            $('.last').addClass('has-success');
            $('.last').removeClass('has-error');
        }
        
        if($('#gender').val() == ''){
            $('.gender').addClass('has-error');
            $('.gender').removeClass('has-success');
        }else{                
            $('.gender').addClass('has-success');
            $('.gender').removeClass('has-error');
        }
        
        if($('#profile_email').val() == ''){
            $('.e_add').addClass('has-error');
            $('.e_add').removeClass('has-success');
        }else{                
            $('.e_add').addClass('has-success');
            $('.e_add').removeClass('has-error');
        }
        
        if($('#birthday').val() == ''){
            $('.b_day').addClass('has-error');
            $('.b_day').removeClass('has-success');
        }else{                
            $('.b_day').addClass('has-success');
            $('.b_day').removeClass('has-error');
        }   

        if($('#c_address').val() == ''){
            $('.c_add').addClass('has-error');
            $('.c_add').removeClass('has-success');
        }else{                
            $('.c_add').addClass('has-success');
            $('.c_add').removeClass('has-error');
        }  

        if($('#p_address').val() == ''){
            $('.p_add').addClass('has-error');
            $('.p_add').removeClass('has-success');
        }else{                
            $('.p_add').addClass('has-success');
            $('.p_add').removeClass('has-error');
        }   

        if($('#father_name').val() == ''){
            $('.f_name').addClass('has-error');
            $('.f_name').removeClass('has-success');
        }else{                
            $('.f_name').addClass('has-success');
            $('.f_name').removeClass('has-error');
        }  

        if($('#mother_name').val() == ''){
            $('.m_name').addClass('has-error');
            $('.m_name').removeClass('has-success');
        }else{                
            $('.m_name').addClass('has-success');
            $('.m_name').removeClass('has-error');
        }
    }


    $('body').on('submit', '#form--update-profile', function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url : "{{ route('student.my_account.update_profile') }}",
            type : 'POST',
            data        : formData,
            processData : false,
            contentType : false,
            success     : function (res) {
                $('.help-block').html('');

                validateProfile();
                
                if (res.res_code == 1)
                {
                    for (var err in res.res_error_msg)
                    {
                        $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                    }
                }
                else
                {
                    $.ajax({
                        url : "{{ route('student.my_account.fetch_profile') }}",
                        type : 'POST',
                        dataType : 'JSON',
                        data        : {_token: '{{ csrf_token() }}'},
                        success     : function (res) {
                            console.log(res)
                            let bday = ''
                            if (res.Profile.birthdate) {
                                bday = new Date(res.Profile.birthdate)
                            }
                            $('#display__full_name').text((res.Profile.first_name != null ? res.Profile.first_name : '') + ' ' + (res.Profile.middle_name != null ? res.Profile.middle_name : '') + ' '  + (res.Profile.last_name != null ? res.Profile.last_name : ''));
                            $('#display__contact_number').text((res.Profile.contact_number != null ? res.Profile.contact_number : ''));
                            $('#display__email').text((res.Profile.email != null ? res.Profile.email : ''));
                            $('#display__address').text((res.Profile.address != null ? res.Profile.address : ''));
                            $('#display__birthday').text((res.Profile.birthdate != null ?  bday.getDate() + ' ' + bday.toLocaleString('en-US', {month: "long"}) + ' ' + bday.getFullYear()  : ''));
                            // {{--  $('#display__age').text((res.Profile.age != null ? res.Profile.age : ''));  --}}
                            $('#display__current_address').text((res.Profile.c_address != null ? res.Profile.c_address : ''));
                            $('#display__permanent_address').text((res.Profile.p_address != null ? res.Profile.p_address : ''));
                            $('#display__father_name').text((res.Profile.father_name != null ? res.Profile.father_name : ''));
                            $('#display__mother_name').text((res.Profile.mother_name != null ? res.Profile.mother_name : ''));
                            $('#display__gender').text((res.Profile.gender == 1 ? 'Male' : 'Female'));
                        }
                    })
                    $('.modal-update-profile').modal('hide');
                }
                
                show_toast_alert({
                    heading : res.res_code == 1 ? 'Error' : 'Success',
                    message : res.res_msg,
                    type    : res.res_code == 1 ? 'error' : 'success'
                });
            }
        });
    })
    </script>
@endsection