@extends('control_panel.layouts.master')

@section ('content_title')
    My Account
@endsection
@section ('styles')
    <link rel="stylesheet" href="{{ asset('cms/plugins/datepicker/datepicker3.css')}}">
@endsection
@section ('content')
    <div class="row">
        <div class="col-md-12">
            @include('control_panel_faculty.user_profile.partials.data_list')
            @include('control_panel_faculty.user_profile.partials.modal_data')
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script>
        

        $('#birthday').datepicker({
            autoclose: true
        })
        
        $('.date_picker_input').datepicker({
            autoclose: true
        })
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('admin.registrar_information') }}",
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
        function fetch_educ_attainment () {
            loader_overlay('js-loader-overlay-education');
            $.ajax({
                url : "{{ route('faculty.my_account.educational_attainment') }}",
                type : 'POST',
                data : {_token : '{{ csrf_token() }}'},
                success     : function (res) {
                    loader_overlay('js-loader-overlay-education');
                    $('#education_attainment_container').html(res);
                }
            });
        }
        function fetch_trainings_seminar_attainment () {
            loader_overlay('js-loader-overlay-trainings_seminars');
            $.ajax({
                url : "{{ route('faculty.my_account.trainings_seminars') }}",
                type : 'POST',
                data : {_token : '{{ csrf_token() }}'},
                success     : function (res) {
                    loader_overlay('js-loader-overlay-trainings_seminars');
                    $('#trainings_seminars_container').html(res);
                }
            });
        }
        $(function () {
            fetch_educ_attainment()
            fetch_trainings_seminar_attainment()
            $('body').on('click', '.btn-change-password', function (e) {
                e.preventDefault();
                $('.modal-change-pw-modal').modal({ backdrop : 'static' });
            });

            $('body').on('submit', '#form--change-password', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url : "{{ route('faculty.my_account.change_my_password') }}",
                    type : 'POST',
                    data : formData,
                    processData : false,
                    contentType : false,
                    success : function (res) {
                        if (res.res_code == 0)  
                        {
                            $('.modal-change-pw-modal').modal('hide');
                        }
                        
                        show_toast_alert({
                            heading : res.res_code == 1 ? 'Error' : 'Success',
                            message : res.res_msg,
                            type    : res.res_code == 1 ? 'error' : 'success'
                        });
                    }
                });
            });

            $('body').on('click', '.btn--update-profile', function (e) {
                e.preventDefault();
                $.ajax({
                    url : "{{ route('faculty.my_account.fetch_profile') }}",
                    type : 'POST',
                    data        : {_token: '{{ csrf_token() }}'},
                    success     : function (res) {
                        $('.help-block').html('');
                        $('.modal-update-profile').modal({ backdrop : 'static' });
                        $('#first_name').val(res.Profile.first_name);
                        $('#middle_name').val(res.Profile.middle_name);
                        $('#last_name').val(res.Profile.last_name);
                        $('#contact_number').val(res.Profile.contact_number);
                        $('#email').val(res.Profile.email);
                        $('#address').val(res.Profile.address);
                        $('#birthday').val(res.Profile.birthday);
                        
                    }
                })
            })
            $('body').on('submit', '#form--update-profile', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url : "{{ route('faculty.my_account.update_profile') }}",
                    type : 'POST',
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
                            $.ajax({
                                url : "{{ route('faculty.my_account.fetch_profile') }}",
                                type : 'POST',
                                dataType : 'JSON',
                                data        : {_token: '{{ csrf_token() }}'},
                                success     : function (res) {
                                    console.log(res)
                                    $('#display__full_name').text((res.Profile.first_name != null ? res.Profile.first_name : '') + ' ' + (res.Profile.middle_name != null ? res.Profile.middle_name : '') + ' '  + (res.Profile.last_name != null ? res.Profile.last_name : ''));
                                    $('#display__contact_number').text((res.Profile.contact_number != null ? res.Profile.contact_number : ''));
                                    $('#display__email').text((res.Profile.email != null ? res.Profile.email : ''));
                                    $('#display__address').text((res.Profile.address != null ? res.Profile.address : ''));
                                    $('#display__birthday').text((res.Profile.birthday != null ? res.Profile.birthday : ''));
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


            $('body').on('submit', '#js-form_subject_details', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('admin.registrar_information.save_data') }}",
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
                            $('.js-modal_holder .modal').modal('hide');
                            fetch_data();
                        }
                    }
                });
            });

            
            $('body').on('click', '.btn--update-photo', function (e) {
                $('#user--photo').click()
            })
            $('body').on('change', '#user--photo', function (e) {
                readURL($(this))
                

                {{--  $('body').on('submit', '#form_user_photo_uploader', function (frm) {
                    frm.preventDefault();  --}}
                {{--  })  --}}
            })

            function readURL(input) {
                var url = input[0].value;
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input[0].files && input[0].files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img--user_photo').attr('src', e.target.result);
                        
                        var formData = new FormData($('#form_user_photo_uploader')[0]);
                        {{--  formData.append('user_photo', $('#user--photo'));  --}}
                        formData.append('_token', '{{ csrf_token() }}');
                        console.log(formData)
                        $.ajax({
                            url : "{{ route('faculty.my_account.change_my_photo') }}",
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


            $('body').on('click', '.btn-add-educ', function (e) {
                e.preventDefault()
                $('.modal-education-attainment').modal({ backdrop : 'static' })
                $('#educ_id').val('');
                $('#course').val('');
                $('#school').val('');
                $('#date_from').val('');
                $('#date_to').val('');
                $('#awards').val('');
            })

            $('body').on('submit', '#form--education-attainment', function (e) {
                e.preventDefault()
                var frm = $(this);
                var formData = new FormData(frm[0]);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url : "{{ route('faculty.my_account.educational_attainment_save') }}",
                    type : 'POST',
                    data : formData,
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
                        } else {
                            frm[0].reset();
                            $('.modal-education-attainment').modal('hide')
                            fetch_educ_attainment()
                        }
                    }
                })
            })

            {{--  $('body').on('click', '.js-btn_educ_edit', function (e) {
                e.preventDefault()
                var educ_id = $(this).data('id');
                
                $.ajax({
                    url : "{{ route('faculty.my_account.educational_attainment_fetch_by_id') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', educ_id : educ_id },
                    success     : function (res) {
                        $('.modal-education-attainment').modal({ backdrop : 'static' });
                        $('#educ_id').val(educ_id);
                        $('#course').val(res.FacultyEducation.course);
                        $('#school').val(res.FacultyEducation.school);
                        $('#date_from').val(res.FacultyEducation.from);
                        $('#date_to').val(res.FacultyEducation.to);
                        $('#awards').val(res.FacultyEducation.awards);
                    }
                })
            })  --}}
            
            $('body').on('click', '.js-btn_educ_edit', function (e) {
                e.preventDefault()
                var educ_id = $(this).data('id');
                
                $.ajax({
                    url : "{{ route('faculty.my_account.educational_attainment_fetch_by_id') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', educ_id : educ_id },
                    success     : function (res) {
                        $('.modal-education-attainment').modal({ backdrop : 'static' });
                        $('#educ_id').val(educ_id);
                        $('#course').val(res.FacultyEducation.course);
                        $('#school').val(res.FacultyEducation.school);
                        $('#date_from').val(res.FacultyEducation.from);
                        $('#date_to').val(res.FacultyEducation.to);
                        $('#awards').val(res.FacultyEducation.awards);
                    }
                })
            })
            
            $('body').on('click', '.js-btn_educ_delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to delete?', function(){  
                    $.ajax({
                        url         : "{{ route('faculty.my_account.educational_attainment_delete_by_id') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', educ_id : id },
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
                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                $('.js-modal_holder .modal').modal('hide');
                                fetch_educ_attainment() 
                            }
                        }
                    });
                }, function(){  

                });   
            })  

            $('body').on('click', '.btn-trainings_seminars', function (e) {
                e.preventDefault();
                const training_seminar_id = $(this).data('id')
                if (training_seminar_id) {
                    $.ajax({
                        url : "{{ route('faculty.my_account.fetch_training_seminar_by_id') }}",
                        type : 'POST',
                        data : { _token:'{{ csrf_token() }}', id : training_seminar_id },
                        success : function (res) {
                            if (res.res_code) {
                                show_toast_alert({
                                    heading : 'Invalid',
                                    message : res.res_msg,
                                    type    : 'error'
                                });
                            } else {
                                $('#seminar_id').val(res.FacultySeminar.id)
                                $('#title').val(res.FacultySeminar.title)
                                $('#seminar_date_from').val(res.FacultySeminar.date_from)
                                $('#seminar_date_to').val(res.FacultySeminar.date_to)
                                $('#venue').val(res.FacultySeminar.venue)
                                $('#sponsor').val(res.FacultySeminar.sponsor)
                                $('#facilitator').val(res.FacultySeminar.facilitator)
                                $('#seminar_type').val(res.FacultySeminar.type)
                                $('.modal-trainings_seminar').modal({ backdrop:'static' })
                            }
                        }
                    })
                } else {
                    $('#seminar_id').val('')
                    $('#title').val('')
                    $('#seminar_date_from').val('')
                    $('#seminar_date_to').val('')
                    $('#venue').val('')
                    $('#sponsor').val('')
                    $('#facilitator').val('')
                    $('#seminar_type').val('')
                    $('.modal-trainings_seminar').modal({ backdrop:'static' })
                }
            })
            $('body').on('submit', '#form--training-seminar', function (e) {
                e.preventDefault()
                const seminar_id = $('#seminar_id').val()
                const frm = $(this)
                const formData = new FormData(frm[0])
                $.ajax({
                    url : "{{ route('faculty.my_account.save_training_seminar') }}",
                    type : 'POST',
                    data : formData,
                    processData : false,
                    contentType : false,
                    success : function (res) {
                        $('.help-block').html('');
                        if (res.res_code) {
                            show_toast_alert({
                                heading : 'Invalid',
                                message : res.res_msg,
                                type    : 'error'
                            });
                            
                            for (var err in res.res_error_msg)
                            {
                                $('#js-' + err).html('<code> '+ res.res_error_msg[err] +' </code>');
                            }
                        } else {
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });
                            $('.modal-trainings_seminar').modal('hide')
                            frm[0].reset();
                            fetch_trainings_seminar_attainment()
                        }
                    }
                })
            })
            
            
            $('body').on('click', '.btn-seminar_delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to delete?', function(){  
                    $.ajax({
                        url         : "{{ route('faculty.my_account.delete_training_seminar_by_id') }}",
                        type        : 'POST',
                        data        : { _token : '{{ csrf_token() }}', id : id },
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
                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                $('.js-modal_holder .modal').modal('hide');
                                fetch_trainings_seminar_attainment()
                            }
                        }
                    });
                }, function(){  

                });   
            })  
        });


        
    </script>
@endsection