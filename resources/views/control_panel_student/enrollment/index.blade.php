@extends('control_panel_student.layouts.master')

@section ('styles') 
    <style>
        .loader {
            display: block;
            margin: 20px auto 0;
            vertical-align: middle;
        }

        #preloader {
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.63);
            z-index: 11000;
            position: fixed;
            display: block;
        }

        .preloader {
            position: absolute;
            margin: 0 auto;
            left: 1%;
            right: 1%;
            top: 47%;
            width: 100px;
            height: 100px;
            background: center center no-repeat none;
            background-size: 65px 65px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
        }

         /* Styles the thumbnail */

    a.lightbox img {
        height: 150px;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
        /* margin: 94px 20px 20px 20px; */
    }

    /* Styles the lightbox, removes it from sight and adds the fade-in transition */

    .lightbox-target {
        position: fixed;
        top: -100%;
        width: 100%;
        background: rgba(0,0,0,.7);
        width: 100%;
        opacity: 0;
        -webkit-transition: opacity .5s ease-in-out;
        -moz-transition: opacity .5s ease-in-out;
        -o-transition: opacity .5s ease-in-out;
        transition: opacity .5s ease-in-out;
        overflow: hidden;
    }

    /* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */

    .lightbox-target img {
        margin: auto;
        /* position: absolute; */
        top: 0;
        left:0;
        right:0;
        bottom: 0;
        max-height: 0%;
        max-width: 0%;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
        box-sizing: border-box;
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    /* Styles the close link, adds the slide down transition */

    a.lightbox-close {
        display: block;
        width:50px;
        height:50px;
        box-sizing: border-box;
        background: white;
        color: black;
        text-decoration: none;
        position: absolute;
        top: -80px;
        right: 0;
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    /* Provides part of the "X" to eliminate an image from the close link */

    a.lightbox-close:before {
        content: "";
        display: block;
        height: 30px;
        width: 1px;
        background: black;
        position: absolute;
        left: 26px;
        top:10px;
        -webkit-transform:rotate(45deg);
        -moz-transform:rotate(45deg);
        -o-transform:rotate(45deg);
        transform:rotate(45deg);
    }

    /* Provides part of the "X" to eliminate an image from the close link */

    a.lightbox-close:after {
        content: "";
        display: block;
        height: 30px;
        width: 1px;
        background: black;
        position: absolute;
        left: 26px;
        top:10px;
        -webkit-transform:rotate(-45deg);
        -moz-transform:rotate(-45deg);
        -o-transform:rotate(-45deg);
        transform:rotate(-45deg);
    }

    /* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */

    .lightbox-target:target {
        opacity: 1;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 2000;
    }

    .lightbox-target:target img {
        max-height: 100%;
        max-width: 100%;
    }

    .lightbox-target:target a.lightbox-close {
        top: 0px;
       
    }

    .overlay-paid {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: aliceblue;
        font-weight: 600;
        font-size: 50px;
        background-color: rgba(0, 0, 0, 0.5);
        top: -20px;
        }
    </style>
@endsection

@section ('content_title')
    Online/Register Payment    
@endsection

@section ('content')    
    <div class="row" id="back_method" style="display: none;">
        <div class="col-md-6">
            {{-- <a href="#" style="margin-top: -1em" class="btn-info btn">
                <i class="fas fa-info"></i>  Instructions
            </a> --}}
        </div>
        <div class="col-md-6">
            <button style="margin-top: -3em" class="btn-success btn pull-right">
            <i class="fas fa-arrow-left"></i> back
            </button>
        </div>
    </div>

    <div id="preloader" style="display: none">
        <img class="preloader" src="{{ asset('img/loader.gif')}}" alt="">
    </div>
    <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
    <div class="js-data-container" style="margin-top: 10px;">
        @if($GradeSheet == 0)
            @include('control_panel_student.enrollment.partials.data_list_error')
        @else
            @include('control_panel_student.enrollment.partials.data_list')
        @endif
    </div>
    
    
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    {{-- <script src="{{ asset('js/custom_validator.js') }}"></script> --}}
    <script>
        $('.select2').select2();

        $('#btn-success-alert').click(function(e){
            e.preventDefault();
            var value = $(this).data('value');
            alertify.defaults.theme.ok = "btn btn-primary btn-flat";
            alertify
            .alert('Confirmation', value, function(){
                // alertify.message('OK');
                // location.reload();
            });
        });
        
        $('#btn-success-alert').trigger('click');
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
                    data        : {_token: '{{ csrf_token() }}', search_sy: $('#search_sy').val()},
                    success     : function (res) {

                        $('#search_class_subject').html(res);
                    }
                })
            })
        });

        $(document).ready(function(){                   
            $('#modal-alert').modal({ backdrop : 'static' });   
        });
        
        //  
        $('body').on('submit', '.js-bank-form', function (e) {
            e.preventDefault();
            var downpayment_0 = $('.hasDownpayment').val();
            var payment = $('#bank_pay_fee').val();
            var downpayment = downpayment_bank_fee;
            set_downpayment = 0;

            var balance = $('#bank_previous_balance').val();
            
            if(parseFloat(payment) > parseFloat(balance)){
                if(parseFloat(balance) == 0){
                    alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"You're current balance is 0 and if you're status not yet paid please contact our finance department. Thank you", function(){   
                    });
                }else{
                    alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please, Do not enter higher amount than your current balance fee. Thank you", function(){   
                    });
                }  
            }else if(parseFloat(payment) <= parseFloat(balance)){
                if(downpayment_0 != null){
                    set_downpayment = 1;

                    var formData = new FormData($(this)[0]);
                            alertify.defaults.transition = "slide";
                            alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                            alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                            alertify.confirm('Confirmation', 'Are you sure you want to submit? Please double check your information. Thank you', function(){  
                                $.ajax({
                                    url         : "{{ route('student.enrollment.save_data') }}",
                                    type        : 'POST',
                                    data        : formData,
                                    processData : false,
                                    contentType : false,
                                    beforeSend: function() {                    
                                        if(
                                            $('#bank_email').val() != '' && 
                                            $('#bank_phone').val() != '' && 
                                            $('#bank').val() != '' && 
                                            $('#bank_pay_fee').val() != '' && 
                                            $('#bank_transaction_id').val() != '' && 
                                            $('#bank_image').val() != ""
                                            && set_downpayment != 0
                                        )
                                        {  
                                            $('#preloader').show();
                                        }
                                        else{
                                            $('.help-block').html('');
                                            bank_pay_fee();
                                            check_bank_phone();
                                            check_bank_email();
                                            bank_transaction();
                                            check_b_image();
                                            check_bank();
                                        }
                                    },
                                    success     : function (res) {
                                        $('.help-block').html('');                    
                                        $('#preloader').hide();                      
                                        
                                        if (res.res_code == 1){
                                            // for (var err in res.res_error_msg)
                                            // {
                                            //     $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                                            // }
                                            alertify.alert(''+
                                            '<i style="color: red" class="fas fa-exclamation-triangle fa-lg"></i> Reminder',
                                            ''+res.res_msg+'', function(){
                                                $('.input-bank_transaction_id').addClass('has-error');
                                                $('.input-bank_transaction_id').removeClass('has-success');
                                                $('#js-bank_transaction_id').css('color', 'red').text('the reference number/transaction ID is already used! Please contact the Finance. Thank you');
                                            }); 
                                        }else{   
                                            if(
                                                $('#bank_email').val() != '' && 
                                                $('#bank_phone').val() != '' && 
                                                $('#bank').val() != '' && 
                                                $('#bank_pay_fee').val() != '' && 
                                                $('#bank_transaction_id').val() != '' && 
                                                $('#bank_image').val() != ""
                                                && set_downpayment != 0
                                            )
                                            {  
                                                $('#preloader').hide();
                                                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                                                alertify
                                                .alert('Confirmation', res.res_msg, function(){
                                                    alertify.message('OK');
                                                    location.reload();
                                                });
                                            }
                                            else{
                                                $('.help-block').html('');
                                                bank_pay_fee();
                                                check_bank_phone();
                                                check_bank_email();
                                                bank_transaction();
                                                check_b_image();
                                                check_bank();
                                            }
                                        }
                                        
                                    }
                                });   
                            }, function(){  
                            }); 
                }else{
                    if(downpayment != 0){
                        if(payment < downpayment){
                            // alert('payment is smaller than the selected downpayment')
                            alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please fill the payment fee bigger amount than the selected downpayment! Thank you", function(){   
                            });
                        }else if(payment >= downpayment){
                            // alert('good') 
                            set_downpayment = downpayment_0;   
                            
                            var formData = new FormData($(this)[0]);
                            alertify.defaults.transition = "slide";
                            alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                            alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                            alertify.confirm('Confirmation', 'Are you sure you want to submit? Please double check your information. Thank you', function(){  
                                $.ajax({
                                    url         : "{{ route('student.enrollment.save_data') }}",
                                    type        : 'POST',
                                    data        : formData,
                                    processData : false,
                                    contentType : false,
                                    beforeSend: function() {                    
                                        if(
                                            $('#bank_email').val() != '' && 
                                            $('#bank_phone').val() != '' && 
                                            $('#bank').val() != '' && 
                                            $('#bank_pay_fee').val() != '' && 
                                            $('#bank_transaction_id').val() != '' && 
                                            $('#bank_image').val() != ""
                                            && set_downpayment != 0
                                        )
                                        {  
                                            $('#preloader').show();
                                        }
                                        else{
                                            $('.help-block').html('');
                                            bank_pay_fee();
                                            check_bank_phone();
                                            check_bank_email();
                                            bank_transaction();
                                            check_b_image();
                                            check_bank();
                                        }
                                    },
                                    success     : function (res) {
                                        $('.help-block').html('');                    
                                        $('#preloader').hide();                      
                                        
                                        if (res.res_code == 1){
                                            // for (var err in res.res_error_msg)
                                            // {
                                            //     $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                                            // }
                                            alertify.alert(''+
                                            '<i style="color: red" class="fas fa-exclamation-triangle fa-lg"></i> Reminder',
                                            ''+res.res_msg+'', function(){
                                                $('.input-bank_transaction_id').addClass('has-error');
                                                $('.input-bank_transaction_id').removeClass('has-success');
                                                $('#js-bank_transaction_id').css('color', 'red').text('the reference number/transaction ID is already used! Please contact the Finance. Thank you');
                                            }); 
                                        }else{   
                                            if(
                                                $('#bank_email').val() != '' && 
                                                $('#bank_phone').val() != '' && 
                                                $('#bank').val() != '' && 
                                                $('#bank_pay_fee').val() != '' && 
                                                $('#bank_transaction_id').val() != '' && 
                                                $('#bank_image').val() != ""
                                                && set_downpayment != 0
                                            )
                                            {  
                                                $('#preloader').hide();
                                                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                                                alertify
                                                .alert('Confirmation', res.res_msg, function(){
                                                    alertify.message('OK');
                                                    location.reload();
                                                });
                                            }
                                            else{
                                                $('.help-block').html('');
                                                bank_pay_fee();
                                                check_bank_phone();
                                                check_bank_email();
                                                bank_transaction();
                                                check_b_image();
                                                check_bank();
                                            }
                                        }
                                        
                                    }
                                });   
                            }, function(){  
                            }); 
                        }
                    }
                    else{
                        alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please select the preferred downpayment fee! Thank you", function(){   
                        });
                    }
                
                }
            }
        });

        $('body').on('submit', '#js-gcash-form', function (e) {
            e.preventDefault();
            var downpayment_0 = $('.hasDownpayment').val();
            var payment = $('#gcash_pay_fee').val();
            var downpayment = downpayment_g_fee;
            set_downpayment = 0;

            var balance = $('#gcash_previous_balance').val();
            
            if(parseFloat(payment) > parseFloat(balance)){
                if(parseFloat(balance) == 0){
                    alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"You're current balance is 0 and if you're status not yet paid please contact our finance department. Thank you", function(){   
                    });
                }else{
                    alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please, Do not enter higher amount than your current balance fee. Thank you", function(){   
                    });
                }  
            }else if(parseFloat(payment) <= parseFloat(balance)){            
                if(downpayment_0 != null){
                    set_downpayment = 1;

                    var formData = new FormData($(this)[0]);            
                            alertify.defaults.transition = "slide";
                            alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                            alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                            alertify.confirm('Confirmation', 'Are you sure you want to submit? Please double check your information. Thank you', function(){  
                                $.ajax({
                                    url         : "{{ route('student.enrollment.save') }}",
                                    type        : 'POST',
                                    data        : formData,
                                    processData : false,
                                    contentType : false,
                                    beforeSend: function() {                    
                                        if(
                                            $('#gcash_email').val() != '' && 
                                            $('#gcash_phone').val() != '' && 
                                            $('#gcash_pay_fee').val() != '' && 
                                            $('#gcash_transaction_id').val() != '' && 
                                            $('#gcash_image').val() != ""
                                            && set_downpayment != 0
                                        )
                                        {  
                                            $('#preloader').show();
                                        }
                                        else{
                                            $('.help-block').html('');
                                            gcash_pay_fee();
                                            check_gcash_phone();
                                            check_gcash_email();
                                            gcash_transaction();
                                            check_g_image();                        
                                        }
                                    },
                                    success     : function (res) {
                                        $('.help-block').html('');                    
                                        $('#preloader').hide();                      
                                        
                                        if (res.res_code == 1){
                                            // for (var err in res.res_error_msg)
                                            // {
                                            //     $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                                            // }
                                            alertify.alert(''+
                                            '<i style="color: red" class="fas fa-exclamation-triangle fa-lg"></i> Reminder',
                                            ''+res.res_msg+'', function(){
                                                $('.input-gcash_transaction_id').addClass('has-error');
                                                $('.input-gcash_transaction_id').removeClass('has-success');
                                                $('#js-gcash_transaction_id').css('color', 'red').text('the reference number/transaction ID is already used! Please contact the Finance. Thank you');
                                            });   
                                        }else{   
                                            if(
                                                $('#gcash_email').val() != '' && 
                                                $('#gcash_phone').val() != '' && 
                                                $('#gcash_pay_fee').val() != '' && 
                                                $('#gcash_transaction_id').val() != '' && 
                                                $('#gcash_image').val() != ""
                                                && set_downpayment != 0
                                            )
                                            {  
                                                $('#preloader').hide();

                                                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                                                alertify
                                                .alert('Confirmation', res.res_msg, function(){
                                                    alertify.message('OK');
                                                    location.reload();
                                                });
                                            }
                                            else{
                                                $('.help-block').html('');
                                                gcash_pay_fee();
                                                check_gcash_phone();
                                                check_gcash_email();
                                                gcash_transaction();
                                                check_g_image();
                                            }
                                        }
                                        
                                    }
                                });           
                            }, function(){  
                            });

        
                }else{
                    if(downpayment != 0){
                        if(payment < downpayment){
                            // alert('payment is smaller than the selected downpayment')
                            alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please fill the payment fee bigger amount than the selected downpayment! Thank you", function(){   
                            });
                        }else if(payment >= downpayment){
                            // alert('good') 
                            set_downpayment = downpayment_0;     
                            
                            var formData = new FormData($(this)[0]);            
                            alertify.defaults.transition = "slide";
                            alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                            alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                            alertify.confirm('Confirmation', 'Are you sure you want to submit? Please double check your information. Thank you', function(){  
                                $.ajax({
                                    url         : "{{ route('student.enrollment.save') }}",
                                    type        : 'POST',
                                    data        : formData,
                                    processData : false,
                                    contentType : false,
                                    beforeSend: function() {                    
                                        if(
                                            $('#gcash_email').val() != '' && 
                                            $('#gcash_phone').val() != '' && 
                                            $('#gcash_pay_fee').val() != '' && 
                                            $('#gcash_transaction_id').val() != '' && 
                                            $('#gcash_image').val() != ""
                                            && set_downpayment != 0
                                        )
                                        {  
                                            $('#preloader').show();
                                        }
                                        else{
                                            $('.help-block').html('');
                                            gcash_pay_fee();
                                            check_gcash_phone();
                                            check_gcash_email();
                                            gcash_transaction();
                                            check_g_image();                        
                                        }
                                    },
                                    success     : function (res) {
                                        $('.help-block').html('');                    
                                        $('#preloader').hide();                      
                                        
                                        if (res.res_code == 1){
                                            // for (var err in res.res_error_msg)
                                            // {
                                            //     $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                                            // }

                                            alertify.alert(''+
                                            '<i style="color: red" class="fas fa-exclamation-triangle fa-lg"></i> Reminder',
                                            ''+res.res_msg+'', function(){
                                                $('.input-gcash_transaction_id').addClass('has-error');
                                                $('.input-gcash_transaction_id').removeClass('has-success');
                                                $('#js-gcash_transaction_id').css('color', 'red').text('the reference number/transaction ID is already used! Please contact the Finance. Thank you');
                                            });   
                                        }else{   
                                            if(
                                                $('#gcash_email').val() != '' && 
                                                $('#gcash_phone').val() != '' && 
                                                $('#gcash_pay_fee').val() != '' && 
                                                $('#gcash_transaction_id').val() != '' && 
                                                $('#gcash_image').val() != ""
                                                && set_downpayment != 0
                                            )
                                            {  
                                                $('#preloader').hide();

                                                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                                                alertify
                                                .alert('Confirmation', res.res_msg, function(){
                                                    alertify.message('OK');
                                                    location.reload();
                                                });
                                            }
                                            else{
                                                $('.help-block').html('');
                                                gcash_pay_fee();
                                                check_gcash_phone();
                                                check_gcash_email();
                                                gcash_transaction();
                                                check_g_image();
                                            }
                                        }
                                        
                                    }
                                });           
                            }, function(){  
                            });
                        }
                    }
                    else{
                        alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please select the preferred downpayment fee! Thank you", function(){   
                        });
                    }
                
                }
            }

              
        });
        // $('.btnpaypal').click(function(){
        //     loader_overlay();
        // })
        alertify.defaults.theme.ok = "btn btn-primary btn-flat";
        $('body').on('submit', '#js-checkout-form', function (e) {
            e.preventDefault();    

            var downpayment_0 = $('.hasDownpayment').val();
            var payment = $('#pay_fee').val();
            var downpayment = downpayment_fee;
            var balance = $('#previous_balance').val();
            
            set_downpayment = 0;
           
            if(parseFloat(payment) > parseFloat(balance)){
                if(parseFloat(balance) == 0){
                    alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"You're current balance is 0 and if you're status not yet paid please contact our finance department. Thank you", function(){   
                    });
                }else{
                    alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please, Do not enter higher amount than your current balance fee. Thank you", function(){   
                    });
                }                
            }else if(parseFloat(balance) >= parseFloat(payment)){
                if(downpayment_0 != null){
                    set_downpayment = 1;
                    // alert('none')
                    var formData = new FormData($(this)[0]);
                    alertify.defaults.transition = "slide";
                    alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                    alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                    alertify.confirm('Confirmation', 'Are you sure you want to submit? Please double check your information. Thank you', function(){  
                        $.ajax({
                            url         : "{{ route('student.create-payment.paypal') }}",
                            type        : 'POST',
                            data        : formData,
                            processData : false,
                            contentType : false,   
                            beforeSend: function() {

                                if($('#pay_fee').val() != '' && $('#phone').val() != '' && $('#email').val() != ''){ 
                                    $('#preloader').show();
                                }
                                else{
                                    $('.help-block').html('');
                                    check_payfee();
                                    check_phone();
                                    check_email();   
                                }
                                // loader_overlay();
                            },                 
                            success     : function (res) {                            
                                if (res.res_code == 1)
                                {
                                    for (var err in res.res_error_msg)
                                    {
                                        $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                                    }
                                }
                                else
                                {
                                    if($('#pay_fee').val() != '' && $('#phone').val() != '' && $('#email').val() != ''){ 
                                    // $('#preloader').show();
                                        window.location.href = res;
                                    }else{
                                        $('.help-block').html('');
                                        check_payfee();
                                        check_phone();
                                        check_email();   
                                    }
                                    
                                }   
                            }
                        }); 
                    }, function(){  
                    });   
                            
                }else{
                    if(downpayment != 0){
                        
                        if(payment < downpayment){
                            // alert('payment is smaller than the selected downpayment')                        
                            alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please fill the payment fee bigger amount than the selected downpayment! Thank you", function(){   
                            });

                        }else if(payment >= downpayment){
                        //    alert('good') 
                            set_downpayment = downpayment_0;

                            var formData = new FormData($(this)[0]);
                            alertify.defaults.transition = "slide";
                            alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                            alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                            alertify.confirm('Confirmation', 'Are you sure you want to submit? Please double check your information. Thank you', function(){  
                                $.ajax({
                                    url         : "{{ route('student.create-payment.paypal') }}",
                                    type        : 'POST',
                                    data        : formData,
                                    processData : false,
                                    contentType : false,   
                                    beforeSend: function() {

                                        if($('#pay_fee').val() != '' && $('#phone').val() != '' && $('#email').val() != '' && set_downpayment != 0){ 
                                            $('#preloader').show();
                                        }
                                        else{
                                            $('.help-block').html('');
                                            check_payfee();
                                            check_phone();
                                            check_email();   
                                        }
                                        // loader_overlay();
                                    },                 
                                    success     : function (res) {                            
                                        if (res.res_code == 1)
                                        {
                                            for (var err in res.res_error_msg)
                                            {
                                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                                            }
                                        }
                                        else
                                        {
                                            if($('#pay_fee').val() != '' && $('#phone').val() != '' && $('#email').val() != '' && set_downpayment != 0){ 
                                            // $('#preloader').show();
                                                window.location.href = res;
                                            }else{
                                                $('.help-block').html('');
                                                check_payfee();
                                                check_phone();
                                                check_email();   
                                            }
                                            
                                        }   
                                    }
                                }); 
                            }, function(){  
                            });   
                        }
                    }else{
                        alertify.alert('<i style="color: red" class="fas fa-exclamation-circle"></i> Error',"Please select the preferred downpayment fee! Thank you", function(){   
                        });
                    }                
                }           
            }
        });

        $('body').on('click', '.btn-transaction-history', function (e) {
            e.preventDefault();
             
            var id = $(this).data('id');
            var school_year_id = $(this).data('school_year_id');
            $.ajax({
                url : "{{ route('student.transaction_history.modal_account') }}",
                type : 'POST',
                data : { _token : '{{ csrf_token() }}', id : id,  school_year_id : school_year_id},
                success : function (res) {
                    $('.js-modal_holder').html(res);
                    $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                    $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                                                         
                        
                    });
                }
            });
        });

        var $getEvent = '';
        
        $('.birthday').datepicker({
            autoclose: true
        })  

        function getProfiledata(){
            $.ajax({
                    url : "{{ route('student.my_account.fetch_profile') }}",
                    type : 'POST',
                    data        : {_token: '{{ csrf_token() }}'},
                    success     : function (res) {
                        const bday = new Date(res.Profile.birthdate)
                        $('.help-block').html('');
                        if(res.Profile.first_name == null || res.Profile.middle_name ==null || res.Profile.last_name ==null ||
                         res.Profile.contact_number == null || res.Profile.email == null || res.Profile.p_address == null || res.Profile.c_address == null ||
                         bday == null || res.Profile.father_name == null || res.Profile.mother_name == null || res.Profile.gender == null){
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
                            $('#isEsc').val(res.Profile.isEsc);

                            // if(res.Profile.photo != ''){
                            //     var profile_src =  res.Profile.photo;
                            //     $('#img--user_photo').attr('src', 'https://127.0.0.1:8000/img/account/photo/'+profile_src);
                            // }else{
                            //     $('#img--user_photo').attr('src', 'https://127.0.0.1:8000/img/account/photo/blank-user.gif');
                            // }
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
                // $('.modal-update-profile').modal({ backdrop : 'static' });
                if(payment_category==1){
                    getProfiledata();
                    
                    $("#online").fadeIn();
                    $('#selector_payment').hide();
                    $('#online').css('display','block');
                    $('#deposit').css('display','none');
                    $('#back_method').css('display','block');
                    $('#js-payment_category').html('');

                    
                }else if(payment_category==2){
                    getProfiledata();
                    
                    $("#deposit").fadeIn();
                    $('#selector_payment').hide();
                    $('#back_method').css('display','block');
                    $('#online').css('display','none');
                    $('#deposit').css('display','block');
                    $('#js-payment_category').html('');

                }else if(payment_category==3){
                    getProfiledata();
                    
                    $("#gcash").fadeIn();
                    $('#selector_payment').hide();
                    $('#back_method').css('display','block');
                    $('#online').css('display','none');
                    $('#gcash').css('display','block');
                    $('#js-payment_category').html('');

                }else if(payment_category==0){
                    // alert('sorry')
                    $('#form_method').addClass('has-error');
                    $('#form_method').removeClass('has-success');
                    $('#js-payment_category').html('<i class="fa fa-times-circle-o"></i> Choose your desire method');       
                }
            });

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

    validate_form();
        
        
        function validate_form(){     
            
            downpayment_fee = 0;
            
            $('.downpaymentSelected').click( function(){
                downpayment = [];
                // var downpayment_fee = $(this).data('fee');
                $('input[name="downpayment[]"]:checked').each(function () {                
                    downpayment.push({
                        fee: $(this).data('fee')
                    });
                });
                $.each(downpayment, function (index, value) {                
                    downpayment_fee = parseFloat(value.fee);
                }); 

                $('.check-downpayment').addClass('has-success').css('color', '#00a65a');
                $('.check-downpayment').removeClass('has-error');
                $('#js-downpayment').text('You are good to go!').css('color', '#00a65a');;
                // alert(downpayment_fee)
            })
            
            $('#pay_fee').change(function (){
                check_payfee();
                var payment = $('#pay_fee').val();
                var downpayment = downpayment_fee;
                if(downpayment)
                {
                    // alert('true')
                    if(payment>=downpayment){
                        $('.input-payment').addClass('has-success');
                        $('.input-payment').removeClass('has-error');
                        $('#js-pay_fee').text('You are good to go!');
                    }else if(payment<downpayment){
                        $('.input-payment').addClass('has-error');
                        $('.input-payment').removeClass('has-success');
                        $('#js-pay_fee').text('You have to enter the amount of downpayment or above amount.');
                    }
                }else{
                    // alert('false')
                    if(payment >=downpayment){
                        $('.input-payment').addClass('has-success');
                        $('.input-payment').removeClass('has-error');
                        $('#js-pay_fee').text('You are good to go!');
                    }else if(payment<downpayment){
                        $('.input-payment').addClass('has-error');
                        $('.input-payment').removeClass('has-success');
                        $('#js-pay_fee').text('You have to enter the amount of downpayment or above amount.');
                    }
                }
            });

            

            $('#pay_fee').keyup(function() {
                check_payfee();
                var payment = $('#pay_fee').val();
                var downpayment = downpayment_fee;
                // var fee = $(this).data('fee');                

                if(downpayment)
                {
                    // alert('true')
                    if(payment>=downpayment){
                        $('.input-payment').addClass('has-success');
                        $('.input-payment').removeClass('has-error');
                        $('#js-pay_fee').text('You are good to go!');
                    }else if(payment<downpayment){
                        $('.input-payment').addClass('has-error');
                        $('.input-payment').removeClass('has-success');
                        $('#js-pay_fee').text('You have to enter the amount of downpayment or above amount.');
                    }
                }else{
                    // alert('false')
                    if(payment != ''){
                        if($('.hasDownpayment').val() != 0){
                            if(downpayment == 0){
                                $('.check-downpayment').addClass('has-error').css('color', 'red');
                                $('.check-downpayment').removeClass('has-success');
                                $('.js-downpayment').css('color', 'red').text('You have to select which downpayment you preferred.');
    
                                $('.input-payment').addClass('has-error');
                                $('.input-payment').removeClass('has-success');
                                $('#js-pay_fee').text('You have to select which downpayment you preferred.');
                            }else{
                                $('.input-payment').addClass('has-success');
                                $('.input-payment').removeClass('has-error');
                                $('#js-pay_fee').text('You are good to go!');
    
                                $('.check-downpayment').addClass('has-success').css('color', '#00a65a');;
                                $('.check-downpayment').removeClass('has-error');
                                $('#js-downpayment').text('You are good to go!').css('color', '#00a65a');;
                            }
                        }else{
                            $('.input-payment').addClass('has-success');
                            $('.input-payment').removeClass('has-error');
                            $('#js-pay_fee').text('You are good to go!');
                        }                      
                        
                    }else if(payment<downpayment){
                        $('.input-payment').addClass('has-error');
                        $('.input-payment').removeClass('has-success');
                        $('#js-pay_fee').text('You have to enter the amount of downpayment or above amount.');
                    }
                }
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

        disc_total = 0;
        function total_fees(){
            disc_total = 0;
            less_total = 0;
            downpayment_total = 0;
            total = 0;  
            grandTotal = 0;
            disc = [];
            $('#disc_amt').html("");

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 

            $('input[name="discount[]"]:checked').each(function () {                
                disc.push({
                    type: $(this).data('type'),
                    fee: $(this).data('fee')
                });
            });
            $.each(disc, function (index, value) {
                
                disc_total += parseFloat(value.fee);

                $item = '<div class="col-md-6">'+ value.type +'</div><div class="col-md-6" style="padding-right: 0" align="right">₱ '+ currencyFormat(value.fee) + '</div>';

                $('#disc_amt').append($item);
                
            }); 

            current_bal = $('#result_current_bal').val();
            total_tuition = $('#total_tuition').val();
            total_fee = total_tuition - disc_total;
            grandTotal = current_bal - disc_total;             
            
            // $('#current_balance').text(currencyFormat(grandTotal));
            $('#total_fee').text(currencyFormat(total_fee));
            // $('#result_current_bal').val(grandTotal);
            // document.getElementById('result_current_bal').value = (grandTotal);
            
            // alert(grandTotal);
        }

        $('.discountSelected').on('click', function (e) {
           total_fees();
           check_payfee();
        });
        

        function check_payfee(){
            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }   

            var payment = $('#pay_fee').val();
            var downpayment = $('.downpaymentSelected').val();
            var previous_balance = $('#previous_balance').val();
            // var discount = $('#e_discount').val();
            
                    
            var total_tuition = $('#total_tuition').val();
            var result_bal = 0;

            if(previous_balance){  
                result_bal = parseFloat(previous_balance) - parseFloat(payment) - disc_total;
            }else{                
                result_bal = parseFloat(total_tuition) - parseFloat(payment) - disc_total;                
            }
            result_online_charge = 0;

            if(payment>=parseInt(1000) && payment<=parseInt(9999)){
                result_online_charge =  (parseFloat(payment) * parseFloat(0.035)) + 17;
            }else if(payment>=parseInt(10000) && payment<=parseInt(12999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 18;
            }else if(payment>=parseInt(13000) && payment<=parseInt(17999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 19;
            }else if(payment>=parseInt(18000) && payment<=parseInt(22999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 20;
            }else if(payment>=parseInt(23000) && payment<=parseInt(27999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 21;
            }else if(payment>=parseInt(28000) && payment<=parseInt(32999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 22;
            }else if(payment>=parseInt(33000) && payment<=parseInt(38999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 23;
            }else if(payment>=parseInt(39000) && payment<=parseInt(43999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 24;
            }else if(payment>=parseInt(44000) && payment<=parseInt(48999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 25;
            }else if(payment>=parseInt(49000) && payment<=parseInt(55999)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 26;
            }else if(payment>=parseInt(1) && payment<parseInt(1000)){
                result_online_charge =  (parseFloat(payment) * 0.035) + 16;
            }

            total_payment_charge = parseFloat(payment) + parseFloat(result_online_charge);

            if(payment == 0){
                document.getElementById('result_current_bal').value = (0);   
                document.getElementById('result_payment_charge').value = (0); 
                document.getElementById('result_total_payment_charge').value = (0);                                           
                $('#current_balance').text(currencyFormat(0));
                $('#payment_charge').text(currencyFormat(0));
                $('#dp_enrollment').text(currencyFormat(parseFloat(0)));
                $('#total_payment_charge').text(currencyFormat(parseFloat(0)));  
            }else{
                document.getElementById('result_current_bal').value = (result_bal);
                document.getElementById('result_payment_charge').value = (result_online_charge);  
                document.getElementById('result_total_payment_charge').value = (total_payment_charge); 
                $('#dp_enrollment').text(currencyFormat(parseFloat(payment)));
                $('#current_balance').text(currencyFormat(result_bal)); 
                $('#payment_charge').text(currencyFormat(result_online_charge));   
                $('#total_payment_charge').text(currencyFormat(parseFloat(total_payment_charge)));                  
            }
            
            total_fees();           
                
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

        downpayment_bank_fee = 0;
            
        $('.downpaymentBankSelected').click( function(){
            downpayment = [];
            // var downpayment_fee = $(this).data('fee');
            $('input[name="downpayment[]"]:checked').each(function () {                
                downpayment.push({
                    fee: $(this).data('fee')
                });
            });
            $.each(downpayment, function (index, value) {                
                downpayment_bank_fee = parseFloat(value.fee);
            }); 
            $('.bank-downpayment').addClass('has-success').css('color', '#00a65a');
            $('.bank-downpayment').removeClass('has-error');
            $('#js-bank_downpayment').text('You are good to go!').css('color', '#00a65a');;
            // alert(downpayment_fee)

            if($('#bank_pay_fee').val() != ''){
                bank_pay_fee();
            }
        })
       
        $('#bank_pay_fee').keyup(function() {
            bank_pay_fee();   
            var payment = $('#bank_pay_fee').val();
            var downpayment = downpayment_bank_fee;
            // var fee = $(this).data('fee');                
            if(downpayment)
            {
                // alert('true')
                if(payment>=downpayment){
                    $('.input-bank_pay_fee').addClass('has-success');
                    $('.input-bank_pay_fee').removeClass('has-error');
                    $('#js-bank_pay_fee').text('You are good to go!');
                }else if(payment<downpayment){
                    $('.input-bank_pay_fee').addClass('has-error');
                    $('.input-bank_pay_fee').removeClass('has-success');
                    $('#js-bank_pay_fee').text('You have to enter the amount of downpayment or above amount.');
                }
            }else{
                // alert('false')
                // if(payment != ''){
                    if($('.hasDownpayment').val() != 0){
                        if(downpayment == 0){
                            $('.bank-downpayment').addClass('has-error').css('color', 'red');
                            $('.bank-downpayment').removeClass('has-success');
                            $('#js-bank_downpayment').css('color', 'red').text('You have to select which downpayment you preferred.');

                            $('.input-bank_pay_fee').addClass('has-error');
                            $('.input-bank_pay_fee').removeClass('has-success');
                            $('#js-bank_pay_fee').text('You have to select which downpayment you preferred.');
                        }else{
                            $('.input-bank_pay_fee').addClass('has-success');
                            $('.input-bank_pay_fee').removeClass('has-error');
                            $('#js-bank_pay_fee').text('You are good to go!');

                            $('.bank-downpayment').addClass('has-success').css('color', '#00a65a');;
                            $('.bank-downpayment').removeClass('has-error');
                            $('#js-bank_downpayment').text('You are good to go!').css('color', '#00a65a');;
                        }
                    }else{
                        // $('.input-bank_pay_fee').addClass('has-success');
                        // $('.input-bank_pay_fee').removeClass('has-error');
                        // $('#js-bank_pay_fee').text('You are good to go!');
                    }                      
                    
                // }else if(payment<downpayment){
                //     $('.bank-downpayment').addClass('has-error');
                //     $('.bank-downpayment').removeClass('has-success');
                //     $('#js-bank_pay_fee').text('You have to enter the amount of downpayment or above amount.');
                // }
            }  
            
            
        });

        $('#bank_pay_fee').change(function (){
            bank_pay_fee();
            var payment = $('#pay_fee').val();
            var downpayment = downpayment_bank_fee;
            // if(downpayment)
            // {
            //     // alert('true')
            //     if(payment>=downpayment){
            //         $('.input-bank_pay_fee').addClass('has-success');
            //         $('.input-bank_pay_fee').removeClass('has-error');
            //         // $('#js-bank_pay_fee').text('You are good to go!');
            //         $('#js-bank_pay_fee').text('Here is your balance now '+currencyFormat(result_bal)+' and You are good to go! ');
            //     }else if(payment<downpayment){
            //         $('.input-bank_pay_fee').addClass('has-error');
            //         $('.input-bank_pay_fee').removeClass('has-success');
            //         // $('#js-bank_pay_fee').text('You have to enter the amount of downpayment or above amount.');
            //         $('#js-bank_pay_fee').text('Here is your balance now '+currencyFormat(result_bal)+' and You are good to go! ');
            //     }
            // }else{
            //     // alert('false')
            //     if(payment >= ''){
            //         $('.input-bank_pay_fee').addClass('has-success');
            //         $('.input-bank_pay_fee').removeClass('has-error');
            //         // $('#js-bank_pay_fee').text('You are good to go!');
            //         $('#js-bank_pay_fee').text('Here is your balance now '+currencyFormat(result_bal)+' and You are good to go! ');
            //     }else if(payment<downpayment){
            //         $('.input-bank_pay_fee').addClass('has-error');
            //         $('.input-bank_pay_fee').removeClass('has-success');
            //         // $('#js-bank_pay_fee').text('You have to enter the amount of downpayment or above amount.');
            //         $('#js-bank_pay_fee').text('Here is your balance now '+currencyFormat(result_bal)+' and You are good to go! ');
            //     }
            // }
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

        discount_total = 0;
        function total_bank_fees(){
            discount_total = 0;
            less_total = 0;
            downpayment_total = 0;
            total = 0;  
            grandTotal = 0;
            disc = [];
            // $('#disc_amt').html("");

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 

            $('.discountBankSelected:checked').each(function () {                
                disc.push({
                    type: $(this).data('type'),
                    fee: $(this).data('fee')
                });
            });
            $.each(disc, function (index, value) {                
                discount_total += parseFloat(value.fee);
                // $item = '<div class="col-md-6">'+ value.type +'</div><div class="col-md-6" style="padding-right: 0" align="right">₱ '+ currencyFormat(value.fee) + '</div>';
                // $('#disc_amt').append($item);                
            }); 

            current_bal = $('#bank_balance').val();
            total_tuition = $('#bank_tution').val();
            total_fee = total_tuition - discount_total;
            // grandTotal = current_bal - disc_total;             
            
            // $('#total_fee').text(currencyFormat(total_fee));
        }

        $('.discountBankSelected').on('click', function (e) {
            total_bank_fees();
            bank_pay_fee();
        });

        function bank_pay_fee(){
            var payment = $('#bank_pay_fee').val();
            var downpayment = downpayment_bank_fee;
            var bank_previous_balance = $('#bank_previous_balance').val();
            var bank_tution = $('#bank_tution').val();
            // var discount = $('#bank_discount').val();

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 
                     
            if(bank_previous_balance){
                result_bal = parseFloat(bank_previous_balance) - parseFloat(payment) - discount_total;
            }else{
                result_bal = parseFloat(total_tuition) - parseFloat(payment) - discount_total;
            }

            if(payment == 0){
                document.getElementById('bank_balance').value = (0);  
                result_bal = 0;                     
            }else{
                document.getElementById('bank_balance').value = (result_bal);         
            }
            total_bank_fees();    
            
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

        downpayment_g_fee = 0;
            
        $('.downpaymentgSelected').click( function(){
            downpayment = [];
            // var downpayment_fee = $(this).data('fee');
            $('.downpaymentgSelected:checked').each(function () {                
                downpayment.push({
                    fee: $(this).data('fee')
                });
            });
            $.each(downpayment, function (index, value) {                
                downpayment_g_fee = parseFloat(value.fee);
            }); 
            
            $('.gcash-downpayment').addClass('has-success').css('color', '#00a65a');
            $('.gcash-downpayment').removeClass('has-error');
            $('#js-gcash_downpayment').text('You are good to go!').css('color', '#00a65a');;
            
            if($('#gcash_pay_fee').val() != ''){
                gcash_pay_fee();
            }
        })
       
        $('#gcash_pay_fee').keyup(function() {
            gcash_pay_fee();

            var payment = $('#gcash_pay_fee').val();
            var downpayment = downpayment_g_fee;
            
            if(downpayment){
                if(payment>=downpayment){
                    $('.input-gcash_pay_fee').addClass('has-success');
                    $('.input-gcash_pay_fee').removeClass('has-error');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You are good to go!');
                }else if(payment<downpayment){
                    $('.input-gcash_pay_fee').addClass('has-error');
                    $('.input-gcash_pay_fee').removeClass('has-success');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You have to enter the amount of downpayment or above amount.');
                }
            }else{
                if(payment != ''){
                    if($('.hasDownpayment').val() != 0){
                        if(downpayment == 0){
                            $('.bank-downpayment').addClass('has-error').css('color', 'red');
                            $('.bank-downpayment').removeClass('has-success');
                            $('#js-bank_downpayment').css('color', 'red').text('You have to select which downpayment you preferred.');

                            $('.input-bank_pay_fee').addClass('has-error');
                            $('.input-bank_pay_fee').removeClass('has-success');
                            $('#js-bank_pay_fee').text('You have to select which downpayment you preferred.');
                        }else{
                            $('.input-bank_pay_fee').addClass('has-success');
                            $('.input-bank_pay_fee').removeClass('has-error');
                            $('#js-bank_pay_fee').text('You are good to go!');

                            $('.bank-downpayment').addClass('has-success').css('color', '#00a65a');;
                            $('.bank-downpayment').removeClass('has-error');
                            $('#js-bank_downpayment').text('You are good to go!').css('color', '#00a65a');;
                        }
                    }else{
                        $('.input-gcash_pay_fee').addClass('has-success');
                        $('.input-gcash_pay_fee').removeClass('has-error');
                        $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You are good to go!');
                    }    
                    
                }else if(payment<downpayment){
                    $('.input-gcash_pay_fee').addClass('has-error');
                    $('.input-gcash_pay_fee').removeClass('has-success');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You have to enter the amount of downpayment or above amount.');
                }
            }
            
        });

        $('#gcash_pay_fee').change(function (){
            gcash_pay_fee();

            var payment = $('#gcash_pay_fee').val();
            var downpayment = $('#gcash_downpayment').val();
            
            if(downpayment){
                if(payment>=downpayment){
                    $('.input-gcash_pay_fee').addClass('has-success');
                    $('.input-gcash_pay_fee').removeClass('has-error');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You are good to go!');
                }else if(payment<downpayment){
                    $('.input-gcash_pay_fee').addClass('has-error');
                    $('.input-gcash_pay_fee').removeClass('has-success');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You have to enter the amount of downpayment or above amount.');
                }
            }else{
                if(payment != ''){
                    $('.input-gcash_pay_fee').addClass('has-success');
                    $('.input-gcash_pay_fee').removeClass('has-error');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+result_bal+' You are good to go!');
                }else if(payment<downpayment){
                    $('.input-gcash_pay_fee').addClass('has-error');
                    $('.input-gcash_pay_fee').removeClass('has-success');
                    $('#js-gcash_pay_fee').text('Here is you balance now '+result_bal+' You have to enter the amount of downpayment or above amount.');
                }
            }
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

        gdiscount_total = 0;
        function total_gcash_fees(){
            gdiscount_total = 0;
            less_total = 0;
            downpayment_total = 0;
            total = 0;  
            grandTotal = 0;
            disc = [];
            // $('#disc_amt').html("");

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 

            $('.discountGcashSelected:checked').each(function () {                
                disc.push({
                    type: $(this).data('type'),
                    fee: $(this).data('fee')
                });
            });
            $.each(disc, function (index, value) {                
                gdiscount_total += parseFloat(value.fee);
                // $item = '<div class="col-md-6">'+ value.type +'</div><div class="col-md-6" style="padding-right: 0" align="right">₱ '+ currencyFormat(value.fee) + '</div>';
                // $('#disc_amt').append($item);                
            }); 

            current_bal = $('#gcash_balance').val();
            total_tuition = $('#gcash_tution_total').val();
            total_fee = total_tuition - discount_total;
            // grandTotal = current_bal - disc_total;             
            
            // $('#total_fee').text(currencyFormat(total_fee));
        }

        $('.discountGcashSelected').on('click', function (e) {
            total_gcash_fees();
            gcash_pay_fee();
        });

        function gcash_pay_fee(){
            var payment = $('#gcash_pay_fee').val();
            var downpayment = downpayment_g_fee;
            var gcash_previous_balance = $('#gcash_previous_balance').val();
            var gcash_tution = $('#gcash_tution_total').val();
            // var discount = $('#gcash_discount').val();

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 
                     
            if(gcash_previous_balance != null){
                result_bal = parseFloat(gcash_previous_balance) - parseFloat(payment) - gdiscount_total;
            }else{
                result_bal = parseFloat(gcash_tution) - parseFloat(payment) - gdiscount_total;
            }
            
            if(payment == 0){
                document.getElementById('gcash_balance').value = (0);  
                result_bal = 0;                     
            }else{
                document.getElementById('gcash_balance').value = (result_bal);
            }
            total_gcash_fees();
            

            if(payment>=downpayment){
                function currencyFormat(num) {
                    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                }
                   
                $('.input-gcash_pay_fee').addClass('has-success');
                $('.input-gcash_pay_fee').removeClass('has-error');
                $('#js-gcash_pay_fee').text('Here is you balance now '+currencyFormat(result_bal)+' You are good to go!');
            }else if(payment<downpayment){
                function currencyFormat(num) {
                    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                } 
                   
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

    

    
        
    </script>
    
@endsection