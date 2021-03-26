@extends('control_panel_student.layouts.master')

@section ('content_title')
    Payment Registration
@endsection

@section ('content')    
    <div class="row" id="back_method" style="display: none;">
        <div class="col-md-12">
            {{-- <a href="#" style="margin-top: -1em" class="btn-info btn">
                <i class="fas fa-info"></i>  Instructions
            </a> --}}
        </div>
        <div class="col-md-12">
            <button style="margin-top: -3em" class="btn-success btn float-right">
                <i class="fas fa-arrow-left"></i> back
            </button>
        </div>
    </div>

    <div id="preloader" style="display: none">
        <img class="preloader" src="{{ asset('img/loader.gif')}}" alt="">
    </div>

    {{-- <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div> --}}
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

    
        
   

    // $('#btn-enroll').click(function(e){
    //     e.preventDefault();
    //     $('#paypal-modal').modal({ backdrop : 'static' });
    // })

    

    
        
    </script>
    
@endsection