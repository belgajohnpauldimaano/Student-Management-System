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

    </style>
@endsection

@section ('content_title')
    Enrollment    
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
        @include('control_panel_student.enrollment.partials.data_list')
    </div>
    
    
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/custom_validator.js') }}"></script>
    <script>
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
                            for (var err in res.res_error_msg)
                            {
                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                            }
                        }else{   
                            if(
                                $('#bank_email').val() != '' && 
                                $('#bank_phone').val() != '' && 
                                $('#bank').val() != '' && 
                                $('#bank_pay_fee').val() != '' && 
                                $('#bank_transaction_id').val() != '' && 
                                $('#bank_image').val() != ""
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
            
        });

        $('body').on('submit', '#js-gcash-form', function (e) {
            e.preventDefault();
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
                            for (var err in res.res_error_msg)
                            {
                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                            }
                        }else{   
                            if(
                                $('#gcash_email').val() != '' && 
                                $('#gcash_phone').val() != '' && 
                                $('#gcash_pay_fee').val() != '' && 
                                $('#gcash_transaction_id').val() != '' && 
                                $('#gcash_image').val() != ""
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
        });
        // $('.btnpaypal').click(function(){
        //     loader_overlay();
        // })
        
        $('body').on('submit', '#js-checkout-form', function (e) {
            e.preventDefault();    
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
                            window.location.href = res;
                        }   
                    }
                }); 
            }, function(){  
            });        
            
            
            
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

        
    </script>
    
@endsection