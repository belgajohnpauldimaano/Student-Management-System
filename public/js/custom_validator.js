function validate_form(){            
        
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
        
        $('#dp_enrollment').text(currencyFormat(parseFloat(payment)));        

        var total_tuition = $('#total_tuition').val();
        result_bal = parseFloat(total_tuition) - parseFloat(payment);
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

    $('#bank_phone').keyup(function() {
        check_bank_phone();
    });

    $("#bank_email").keyup(function(){
        check_bank_email();
    });

    $("#bank_transaction_id").keyup(function(){
        bank_transaction();
    });

    $('#bank_image').change(function(){
        check_b_image();
    });
        
    

    function bank_transaction(){
        var phone = $('#bank_transaction_id').val();
        
        if(phone != ''){
            $('.input-bank_transaction_id').addClass('has-success');
            $('.input-bank_transaction_id').removeClass('has-error');
            $('#js-number').text('You are good to go!');               
        }else{
            $('.input-bank_transaction_id').addClass('has-error');
            $('.input-bank_transaction_id').removeClass('has-success');
            $('#js-bank_transaction_id').text('You must be enter your transaction number.');
        }
    }

    function bank_pay_fee(){
        var payment = $('#bank_pay_fee').val();
        var downpayment = $('#bank_downpayment').val();

        if(payment>=downpayment){
            $('.input-bank_pay_fee').addClass('has-success');
            $('.input-bank_pay_fee').removeClass('has-error');
            $('#js-bank_pay_fee').text('You are good to go!');
        }else if(payment<downpayment){
            $('.input-bank_pay_fee').addClass('has-error');
            $('.input-bank_pay_fee').removeClass('has-success');
            $('#js-bank_pay_fee').text('You have to enter the amount of downpayment or above amount.');
        }
    }
    
    function check_bank_phone(){
        var phone = $('#bank_phone').val();
        var len = jQuery('#bank_phone').html().length
        if(phone.length===13){
            $('.input-bank_phone').addClass('has-success');
            $('.input-bank_phone').removeClass('has-error');
            $('#js-number').text('You are good to go!');               
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
        var image = $('#bank_image').attr("src");
        if(image != 'No file chosen'){
            $('.input-bank_image').addClass('has-success');
            $('.input-bank_image').removeClass('has-error');
            $('#js-bank_image').text('You are good to go!');               
        }else{
            $('.input-bank_image').addClass('has-error');
            $('.input-bank_image').removeClass('has-success');
            $('#js-bank_image').text('You must upload the copy of reciept.');
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