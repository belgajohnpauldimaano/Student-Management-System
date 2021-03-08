
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 footer-info">
                        <h3>St. John's</h3>
                        <p>ST. JOHN'S ACADEMY INC was born out of a clamor for a Catholic educational institution which will provide a deeply-rooted Christian formation to the young and which can supply the volunteers for the Parochial catechetical program at the public schools within the parish... <a href="{{ route('history') }}">readmore</a></p>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>About SJAI</h4>
                        <ul>
                            <li><i class="ion-ios-arrow-right"></i> <a href="{{ route('home_page') }}">Home</a></li>
                            <li><i class="ion-ios-arrow-right"></i> <a href="{{ route('vision_mission') }}">Vision Mission</a></li>
                            <li><i class="ion-ios-arrow-right"></i> <a href="{{ route('history') }}">Hymn</a></li>
                            <li><i class="ion-ios-arrow-right"></i> <a href="{{ route('faculty_staff') }}">Faculty and Staff</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            Rizal Street, Dinalupihan
                            <br> Bataan, 2110 
                            <br>
                            <strong>Contact Numbers:</strong> (047) 636 5560 | (047) 636 0088
                            <br>
                        </p>
                        {{-- <div class="social-links">
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        </div> --}}
                    </div>
                    <div {{-- class="col-lg-3 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>St. John's</strong>. All Rights Reserved
            </div>
            {{-- <div class="credits">
                Best <a href="https://bootstrapmade.com/">Bootstrap Templates</a> by BootstrapMade
            </div> --}}
        </div>
    </footer>
    <!-- #footer -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="{{ asset('theme/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/lib/jquery/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('theme/lib/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('theme/lib/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('theme/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('theme/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('theme/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('theme/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('theme/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('theme/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('theme/lib/touchSwipe/jquery.touchSwipe.min.js') }}"></script>
    <!-- Contact Form JavaScript File -->
    <script src="{{ asset('theme/contactform/contactform.js') }}"></script>
    <!-- Template Main Javascript File -->
    <script src="{{ asset('theme/js/main.js') }}"></script>
    {{-- alertify --}}
    <script src="{{ asset('cms/plugins/alertifyjs/alertify.min.js') }}"></script>
    <!-- jquery-toast-plugin -->
    <script src="{{ asset('cms/plugins/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <!-- alertifyjs -->
    <script src="{{ asset('cms/plugins/alertifyjs/alertify.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('cms/plugins/datepicker/datepicker3.css') }}">
    <script>
        $('#birthday').datepicker({
            autoclose: true
        })
    </script>
    @yield('scripts')
    <script>
        $(function () {
            $('.btn--update-photo').click(function(){
                $('.btn-upload-photo').click();
            })

            $('.btn-enroll').click(function(){
                $('#js-registration').modal({
                    backdrop: 'static',
                    keyboard: false
                })
            })
            
           
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
                        $('#mother_name').val() != '' && $('#father_name').val() != '' && $('#p_address').val() != ''
                    )
                    {
                            $.ajax({
                                url         : "{{ route('registration.store') }}",
                                type        : 'POST',
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

                $('#grade_lvl').change(function() {
                    check_grade_lvl();
                });

                $('#grade_lvl').focusin(function() {
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

            }

            
                function check_lrn(){
                    var x = $('#lrn').val();

                    if(x != ''){
                        $('.input-lrn').addClass('has-success');
                        $('.input-lrn').removeClass('has-error');
                        $('#js-lrn').text('Double check your LRN and You are good to go!').css('color', 'green');               
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
                        $('#js-reg_type').text('You are good to go!').css('color', 'green');               
                    }else{
                        $('.input-reg_type').addClass('has-error');
                        $('.input-reg_type').removeClass('has-success');
                        $('#js-reg_type').css('color', 'red').text('You must select your registration type.');
                    }
                }

                function check_grade_lvl(){
                    var x = $('#grade_lvl').val();

                    if(x != ''){
                        $('.input-grade_lvl').addClass('has-success');
                        $('.input-grade_lvl').removeClass('has-error');
                        $('#js-grade_lvl').text('You are good to go!').css('color', 'green');               
                    }else{
                        $('.input-grade_lvl').addClass('has-error');
                        $('.input-grade_lvl').removeClass('has-success');
                        $('#js-grade_lvl').css('color', 'red').text('You must select your incoming grade level.');
                    }
                }
            
                
                function check_first_name(){
                    var x = $('#first_name').val();

                    if(x != ''){
                        $('.input-first_name').addClass('has-success');
                        $('.input-first_name').removeClass('has-error');
                        $('#js-first_name').text('You are good to go!').css('color', 'green');               
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
                        $('#js-middle_name').text('You are good to go!').css('color', 'green');               
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
                        $('#js-last_name').text('You are good to go!').css('color', 'green');               
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
                    $('#js-phone').css('color', 'green').text('You are good to go!');               
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
                    $('#js-guardian').css('color', 'green').text('You are good to go!');               
                }else{
                    $('.input-guardian').addClass('has-error');
                    $('.input-guardian').removeClass('has-success');
                    $('#js-guardian').css('color', 'red').text('You must enter your guardian name.');
                }
            }

            function check_father_name(){
                var x = $('#father_name').val();
                
                if(x != ''){
                    $('.input-father_name').addClass('has-success');
                    $('.input-father_name').removeClass('has-error');
                    $('#js-father_name').css('color', 'green').text('You are good to go!');               
                }else{
                    $('.input-father_name').addClass('has-error');
                    $('.input-father_name').removeClass('has-success');
                    $('#js-father_name').css('color', 'red').text('You must enter your father name.');
                }
            }

            function check_mother_name(){
                var x = $('#mother_name').val();
                
                if(x != ''){
                    $('.input-mother_name').addClass('has-success');
                    $('.input-mother_name').removeClass('has-error');
                    $('#js-mother_name').css('color', 'green').text('You are good to go!');               
                }else{
                    $('.input-mother_name').addClass('has-error');
                    $('.input-mother_name').removeClass('has-success');
                    $('#js-mother_name').css('color', 'red').text('You must enter your mother name.');
                }
            }

            function check_address(){
                var address = $('#address').val();
                
                if(address != ''){
                    $('.input-address').addClass('has-success');
                    $('.input-address').removeClass('has-error');
                    $('#js-address').css('color', 'green').text('You are good to go!');               
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
                    $('#js-p_address').css('color', 'green').text('You are good to go!');               
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
                    $('#js-birthdate').css('color', 'green').text('You are good to go!');               
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
                        $('#js-gender').text('You are good to go!').css('color', 'green');               
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
                        $('#js-student_img').css('color', 'green').text('You are good to go!');               
                    }else{
                        $('.btn--update-photo').addClass('has-error');
                        $('.btn--update-photo').removeClass('has-success');
                        $('#js-student_img').css('color', 'red').text('You must upload your 2x2 picture with white background.');
                    }
                }
            
        });

        function readImageURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img--user_photo')
                            .attr('src', e.target.result)
                            .width(150)
                            ;
                    };
                    reader.readAsDataURL(input.files[0]);
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

        
    

    </script>
</body>

</html>