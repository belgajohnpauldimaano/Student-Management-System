@extends('control_panel_student.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Enrollment
    <button style="display: none" id="back_method" class="btn-success btn pull-right">back</button>
@endsection

@section ('content')    
    <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
    <div class="js-data-container">
        @include('control_panel_student.enrollment.partials.data_list')
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
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

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }
        

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

    $('#btn_method').on('click', function(){
        var payment_category = $('#payment_category').val();

        if(payment_category==1){
            $("#online").fadeIn();
            $('#selector_payment').hide();
            $('#online').css('display','block');
            $('#deposit').css('display','none');
            $('#back_method').css('display','block');
            $('#js-payment_category').html('');
        }else if(payment_category==2){
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
    
    </script>
@endsection