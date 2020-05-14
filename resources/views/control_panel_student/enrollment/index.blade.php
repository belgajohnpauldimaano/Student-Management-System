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
        });

        $('body').on('submit', '#js-gcash-form', function (e) {
            e.preventDefault();
            
            var formData = new FormData($(this)[0]);
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
        });
        // $('.btnpaypal').click(function(){
        //     loader_overlay();
        // })
        
        $('body').on('submit', '#js-checkout-form', function (e) {
            e.preventDefault();            
                var formData = new FormData($(this)[0]);
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
            
        });
    </script>
@endsection