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
    Online Appointment
@endsection

@section ('content')
    <div class="row">
        <form id="js-form_search">
            {{ csrf_field() }}
        </form>
            
        <div class="col-sm-12">
            <div id="preloader" style="display: none">
                <img class="preloader" src="{{ asset('img/loader.gif')}}" alt="">
            </div>
            <div class="js-data-container">
                @include('control_panel_student.online_appointment.partials.data_list')     
            </div>
        </div>           
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('student.student_appointment') }}",
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

       
        // $('body').on('click', '.btn--update-profile', function (e) {
        //         e.preventDefault();
        //         $.ajax({
        //             url : "{{ route('student.my_account.fetch_profile') }}",
        //             type : 'POST',
        //             data        : {_token: '{{ csrf_token() }}'},
        //             success     : function (res) {
        //                 const bday = new Date(res.Profile.birthdate)
        //                 $('.help-block').html('');
        //                 $('.modal-update-profile').modal({ backdrop : 'static' });
        //                 $('#first_name').val(res.Profile.first_name);
        //                 $('#middle_name').val(res.Profile.middle_name);
        //                 $('#last_name').val(res.Profile.last_name);
        //                 $('#contact_number').val(res.Profile.contact_number != null ? res.Profile.contact_number : '+639');
        //                 $('#profile_email').val(res.Profile.email);
        //                 $('#c_address').val(res.Profile.c_address);
        //                 $('#p_address').val(res.Profile.p_address);
        //                 $('#birthday').val((bday.getMonth() + 1).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false}) + `/` + bday.getDate().toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false}) +`/` + bday.getFullYear());
        //                 $('#father_name').val(res.Profile.father_name);     
        //                 $('#mother_name').val(res.Profile.mother_name);    
        //                 $('#gender').val(res.Profile.gender);
        //                 // $('#isEsc').val(res.Profile.isEsc);
                        
        //             }
        //         })
        //     })
        $("#email").keyup(function(){
            check_email();
        });

        $('body').on('click', '.btn-reserve', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var date = $(this).data('date');
            var time = $(this).data('time');
            var email = $('#email').val();
            var grade_lvl = $('.js-grade').val();

            alertify.defaults.transition = "slide";
            alertify.defaults.theme.ok = "btn btn-primary";
            alertify.defaults.theme.cancel = "btn btn-danger";
            alertify.confirm('<i style="color: red !important" class="icon fa fa-warning"></i> Confirmation', 'You reserve to Date: <b>'+date+'</b> Time <b>'+time+'</b>?', function(){  
                
                if($("#email").val() == ''){ 
                    check_email();
                    return;
                }
                if(isValidEmailAddress(email)){
                    $.ajax({
                        url         : "{{ route('student.student_appointment.reserve') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', id : id , email : email, grade_lvl : grade_lvl},
                        beforeSend: function() {                    
                            $('#preloader').show();
                        },
                        success     : function (res) {
                            $('.help-block').html('');
                            if (res.res_code == 1)
                            {
                                show_toast_alert({
                                    heading : 'Error',
                                    message : res.res_msg,
                                    type    : 'error'
                                });
                            }
                            else
                            {
                               
                                // $('.js-modal_holder .modal').modal('hide');
                                $('#preloader').hide();

                                alertify.alert('<i style="color: green" class="fas fa-check-circle fa-lg"></i> Confirmation',
                                ""+res.res_msg+"", function(){
                                    location.reload();
                                });
                                // fetch_data();
                            }
                        }
                    });
                }else{
                    check_email();
                }
                
                
            }, function(){  

            });
        });

            // notify();

            function notify(){               
                
                alertify.defaults.theme.ok = "btn btn-primary";
                alertify
                .alert('<i style="color: red !important" class="icon fa fa-warning"></i> Reminder, Please read',"You can only reserve once in every available schedule.Please do not reserve it when you don't need it. Thank you!.", function(){
                    // alertify.message('OK');
                });
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

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }

            
            
    </script>
@endsection