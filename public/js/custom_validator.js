        validate_form();        

        function validate_form(){            
            
            $('#pay_fee').change(function (){
                check_payfee();
            });

            $('#pay_fee').keyup(function() {
                check_payfee();
            });

            $('#phone').keyup(function() {
                check_phone();
            });

            $("#email").keyup(function(){
                check_email();
            });

            

            // function isValidEmailAddress(emailAddress) {
            //     var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            //     return pattern.test(emailAddress);
            // }
            

            $('.btn-reset').on('click', function(){
                location.reload();
            });

            $('.btn-success-close').on('click', function(){
                location.reload();
            });
        }
        // online-bank
        // check_payfee();
        // check_phone();
        // check_email();

        function check_payfee(){
            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }   

            var payment = $('#pay_fee').val();
            var downpayment = $('#downpayment').val();
            var previous_balance = $('#previous_balance').val();
            var discount = $('#e_discount').val();
            
            $('#dp_enrollment').text(currencyFormat(parseFloat(payment)));        
            var total_tuition = $('#total_tuition').val();
            var result_bal = 0;

            if(previous_balance){  
                result_bal = parseFloat(previous_balance) - parseFloat(payment);
            }else{
                if(discount){
                    result_bal = parseFloat(total_tuition) - parseFloat(payment) - parseFloat(discount);
                }else{
                    result_bal = parseFloat(total_tuition) - parseFloat(payment);
                }
                
            }
            
            document.getElementById('result_current_bal').value = (result_bal);
            
            $('#current_balance').text(currencyFormat(result_bal));

            if(payment>=downpayment){
                $('.input-payment').addClass('has-success');
                $('.input-payment').removeClass('has-error');
                $('#js-pay_fee').text('You are good to go!');
            }else if(payment<downpayment){
                $('.input-payment').addClass('has-error');
                $('.input-payment').removeClass('has-success');
                $('#js-pay_fee').text('You have to enter the amount of downpayment or above amount.');
            }
        }
        
        function check_phone(){
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
        }

        function check_email(){
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
        }
        // deposit-bank
       
        $('#bank_pay_fee').keyup(function() {
            bank_pay_fee();
        });

        $('#bank_pay_fee').change(function (){
            bank_pay_fee();
        });

        $('#bank_phone').keyup(function() {
            check_bank_phone();
        });

        $("#bank_email").keyup(function(){
            check_bank_email();
        });

        $("#bank_transaction_id").keyup(function(){
            bank_transaction();
        });

        $('#bank_image').on('change', function(){
            check_b_image();
        });

        $('#bank').on('change', function(){
            check_bank();
        });
            
        function check_bank(){
            var bank = $('#bank').val();
            
            if(bank != ''){
                $('.input-bank').addClass('has-success');
                $('.input-bank').removeClass('has-error');
                $('#js-bank').text('You are good to go!');               
            }else{
                $('.input-bank').addClass('has-error');
                $('.input-bank').removeClass('has-success');
                $('#js-bank').text('You must be enter your transaction number.');
            }
        }
        

        function bank_transaction(){
            var phone = $('#bank_transaction_id').val();
            
            if(phone != ''){
                $('.input-bank_transaction_id').addClass('has-success');
                $('.input-bank_transaction_id').removeClass('has-error');
                $('#js-bank_transaction_id').text('You are good to go!');               
            }else{
                $('.input-bank_transaction_id').addClass('has-error');
                $('.input-bank_transaction_id').removeClass('has-success');
                $('#js-bank_transaction_id').text('You must be enter your transaction number.');
            }
        }

        function bank_pay_fee(){
            var payment = $('#bank_pay_fee').val();
            var downpayment = $('#bank_downpayment').val();
            var bank_previous_balance = $('#bank_previous_balance').val();
            var bank_tution = $('#bank_tution').val();
            var discount = $('#bank_discount').val();

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 
                     
            if(bank_previous_balance){
                result_bal = parseFloat(bank_previous_balance) - parseFloat(payment);
            }else{
                if(discount){
                    result_bal = parseFloat(bank_tution) - parseFloat(payment) - discount;
                }else{
                    result_bal = parseFloat(total_tuition) - parseFloat(payment);
                }
            }

            document.getElementById('bank_balance').value = (result_bal);
           
            if(payment>=downpayment){
                $('.input-bank_pay_fee').addClass('has-success');
                $('.input-bank_pay_fee').removeClass('has-error');
                $('#js-bank_pay_fee').text('Here is your balance now '+currencyFormat(result_bal)+' and You are good to go! ');
            }else if(payment<downpayment){
                $('.input-bank_pay_fee').addClass('has-error');
                $('.input-bank_pay_fee').removeClass('has-success');
                $('#js-bank_pay_fee').text('Here is your balance now '+currencyFormat(result_bal)+' and You have to enter the amount of downpayment or above amount.');
            }
        
        }
        
        function check_bank_phone(){
            var phone = $('#bank_phone').val();
            var len = jQuery('#bank_phone').html().length
            if(phone.length===13){
                $('.input-bank_phone').addClass('has-success');
                $('.input-bank_phone').removeClass('has-error');
                $('#js-bank_phone').text('You are good to go!');               
            }else{
                $('.input-bank_phone').addClass('has-error');
                $('.input-bank_phone').removeClass('has-success');
                $('#js-bank_phone').text('You must be enter your phone number.');
            }
        }

        function check_bank_email(){
            var email = $("#bank_email").val();

            if(email != 0)
            {
                if(isValidEmailAddress(email))
                {
                    $('.input-bank_email').addClass('has-success');
                    $('.input-bank_email').removeClass('has-error');
                    $('#js-bank_email').text('You are good to go!'); 
                } else {
                    $('.input-bank_email').addClass('has-error');
                    $('.input-bank_email').removeClass('has-success');
                    $('#js-bank_email').text('invalid email address.');
                }
            } else {
                $('.input-bank_email').addClass('has-error');
                $('.input-bank_email').removeClass('has-success');
                $('#js-bank_email').text('You must be enter your email address.');       
            }
        }
        
        function check_b_image(){
            var image = $('#bank_image').val();

            if(image != ''){
                
                $('.input-bank_image').addClass('has-success');
                $('.input-bank_image').removeClass('has-error');
                $('#js-bank_image').text('You are good to go!');               
            }else{
                $('.input-bank_image').addClass('has-error');
                $('.input-bank_image').removeClass('has-success');
                $('#js-bank_image').text('You must upload the copy of reciept.');
            }
        }

        function readImageURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-receipt')
                        .attr('src', e.target.result)
                        .width(150)
                        ;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        


        // gcash

        // deposit-bank
       
        $('#gcash_pay_fee').keyup(function() {
            gcash_pay_fee();
        });

        $('#gcash_pay_fee').change(function (){
            gcash_pay_fee();
        });

        $('#gcash_phone').keyup(function() {
            check_gcash_phone();
        });

        $("#gcash_email").keyup(function(){
            check_gcash_email();
        });

        $("#gcash_transaction_id").keyup(function(){
            gcash_transaction();
        });

        $('#gcash_image').change(function(){
            check_g_image();
        });
            
        

        function gcash_transaction(){
            var phone = $('#gcash_transaction_id').val();
            
            if(phone != ''){
                $('.input-gcash_transaction_id').addClass('has-success');
                $('.input-gcash_transaction_id').removeClass('has-error');
                $('#js-gcash_transaction_id').text('You are good to go!');               
            }else{
                $('.input-gcash_transaction_id').addClass('has-error');
                $('.input-gcash_transaction_id').removeClass('has-success');
                $('#js-gcash_transaction_id').text('You must be enter your transaction number.');
            }
        }

        function gcash_pay_fee(){
            var payment = $('#gcash_pay_fee').val();
            var downpayment = $('#gcash_downpayment').val();
            var gcash_previous_balance = $('#gcash_previous_balance').val();
            var gcash_tution = $('#gcash_tution_total').val();
            var discount = $('#gcash_discount').val();

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 
                     
            if(gcash_previous_balance != null){
                result_bal = parseFloat(gcash_previous_balance) - parseFloat(payment);
            }else{
                if(discount){
                    result_bal = parseFloat(gcash_tution) - parseFloat(payment) - discount;
                }else{
                    result_bal = parseFloat(gcash_tution) - parseFloat(payment);
                }
                
            }

            document.getElementById('gcash_balance').value = (result_bal);

            if(payment>=downpayment){
                $('.input-gcash_pay_fee').addClass('has-success');
                $('.input-gcash_pay_fee').removeClass('has-error');
                $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You are good to go!');
            }else if(payment<downpayment){
                $('.input-gcash_pay_fee').addClass('has-error');
                $('.input-gcash_pay_fee').removeClass('has-success');
                $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You have to enter the amount of downpayment or above amount.');
            }
        }
        
        function check_gcash_phone(){
            var phone = $('#gcash_phone').val();
            var len = jQuery('#gcash_phone').html().length
            if(phone.length===13){
                $('.input-gcash_phone').addClass('has-success');
                $('.input-gcash_phone').removeClass('has-error');
                $('#js-gcash_phone').text('You are good to go!');               
            }else{
                $('.input-gcash_phone').addClass('has-error');
                $('.input-gcash_phone').removeClass('has-success');
                $('#js-gcash_phone').text('You must be enter your phone number.');
            }
        }

        function check_gcash_email(){
            var email = $("#gcash_email").val();

            if(email != 0)
            {
                if(isValidEmailAddress(email))
                {
                    $('.input-gcash_email').addClass('has-success');
                    $('.input-gcash_email').removeClass('has-error');
                    $('#js-gcash_email').text('You are good to go!'); 
                } else {
                    $('.input-gcash_email').addClass('has-error');
                    $('.input-gcash_email').removeClass('has-success');
                    $('#js-gcash_email').text('invalid email address.');
                }
            } else {
                $('.input-gcash_email').addClass('has-error');
                $('.input-gcash_email').removeClass('has-success');
                $('#js-gcash_email').text('You must be enter your email address.');       
            }
        }
        
        function check_g_image(){
            var image = $('#gcash_image').val();

            if(image != ''){
                $('.input-gcash_image').addClass('has-success');
                $('.input-gcash_image').removeClass('has-error');
                $('#js-gcash_image').text('You are good to go!');               
            }else{
                $('.input-gcash_image').addClass('has-error');
                $('.input-gcash_image').removeClass('has-success');
                $('#js-gcash_image').text('You must upload the copy of reciept.');
            }
        }        

        function readImageURLGcash(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-receipt-gcash')
                        .attr('src', e.target.result)
                        .width(150)
                        ;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }

    $('body').on('change','#payment_category', function(){
        var payment_category = $('#payment_category').val();
        if(payment_category==1){
            $('#form_method').addClass('has-success');
            $('#form_method').removeClass('has-error');
            $('#js-payment_category').html('<i class="fa fa-check"></i> You chose Credit card/Debit card'); 
        }else if(payment_category==2){
            $('#form_method').addClass('has-success');
            $('#form_method').removeClass('has-error');
            $('#js-payment_category').html('<i class="fa fa-check"></i> You chose Bank Deposit'); 
        }else if(payment_category==3){
            $('#form_method').addClass('has-success');
            $('#form_method').removeClass('has-error');
            $('#js-payment_category').html('<i class="fa fa-check"></i> You chose Gcash Deposit'); 
        }else if(payment_category==0){
            $('#form_method').addClass('has-error');
            $('#form_method').removeClass('has-success');
            $('#js-payment_category').html('<i class="fa fa-times-circle-o"></i> Choose your preferred method');       
        }
         
    });

    
    
    

    
    
    

    $('#back_method').on('click', function(){
        $("#selector_payment").fadeIn();
        $('#selector_payment').show();        
        $('#back_method').css('display','none');
        $('#deposit').css('display','none');
        $('#online').css('display','none');
        $('#gcash').css('display','none');
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

    validate_Profile_keyup();
    function validate_Profile_keyup(){
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
    }
    
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

    // checkbox
    checkbox_button();
    function checkbox_button(){    
        var  checkTutionfee = $('.checkTution').val();
        if( checkTutionfee != 1){  
            $("#terms").change(function() {
                if(this.checked) {
                    $("#btn-enroll").prop('disabled', false);
                }else{
                    $("#btn-enroll").prop('disabled', true);
                }                        
            });   
            
            $("#bank_terms").change(function() {
                if(this.checked) {
                    $(".btn-bank-enroll").prop('disabled', false);
                }else{
                    $(".btn-bank-enroll").prop('disabled', true);
                }
            });

            $("#gcash_terms").change(function() {
                if(this.checked) {
                    $(".btn-gcash-enroll").prop('disabled', false);
                }else{
                    $(".btn-gcash-enroll").prop('disabled', true);
                }
            });
        }
    }
        
   

    // $('#btn-enroll').click(function(e){
    //     e.preventDefault();
    //     $('#paypal-modal').modal({ backdrop : 'static' });
    // })

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
                            $('#display__contact_number').text((res.Profile.contact_number != null ? res.Profile.contact_number : '+639'));
                            $('#display__email').text((res.Profile.email != null ? res.Profile.email : ''));
                            $('#display__address').text((res.Profile.address != null ? res.Profile.address : ''));
                            $('#display__birthday').text((res.Profile.birthdate != null ?  bday.getDate() + ' ' + bday.toLocaleString('en-US', {month: "long"}) + ' ' + bday.getFullYear()  : ''));
                            // {{--  $('#display__age').text((res.Profile.age != null ? res.Profile.age : ''));  --}}
                            $('#display__current_address').text((res.Profile.c_address != null ? res.Profile.c_address : ''));
                            $('#display__permanent_address').text((res.Profile.p_address != null ? res.Profile.p_address : ''));
                            $('#display__father_name').text((res.Profile.father_name != null ? res.Profile.father_name : ''));
                            $('#display__mother_name').text((res.Profile.mother_name != null ? res.Profile.mother_name : ''));
                            $('#display__gender').text((res.Profile.gender == 1 ? 'Male' : 'Female'));
                            $('#display__esc').text((res.Profile.isEsc));
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

    $('#btn-success-alert').click(function(e){
        e.preventDefault();
        var value = $(this).data('value');
        alertify.defaults.theme.ok = "btn btn-primary btn-flat";
        alertify
        .alert('Confirmation', value, function(){
            alertify.message('OK');
            location.reload();
        });
    });