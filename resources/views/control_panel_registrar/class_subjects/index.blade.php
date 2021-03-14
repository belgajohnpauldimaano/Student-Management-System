@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Class Subjects ({{ "SY: " . $ClassDetail->school_year . " Yr/Sec: " . $ClassDetail->grade_level . "/" . $ClassDetail->section . " Room : " . $ClassDetail->room_code }})
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <div class="col-md-8 m-auto">
                <h6 class="box-title">Search</h6>
                <form id="js-form_search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div id="js-form_search" class="form-group" style="padding-left:0;padding-right:0">
                                <input type="text" class="form-control form-control-sm" name="search">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Search</button>
                            <button type="button" class="btn btn-danger" id="js-button-add">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        @include('control_panel_registrar.class_subjects.partials.data_list')
                    </div>
                </div>
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
                url : "{{ route('registrar.class_subjects', $class_id) }}",
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
                $('body').on('click', '#js-button-add, .js-btn_update', function (e) {
                    e.preventDefault();
                    
                    var class_subject_details_id = $(this).data('id');
                    $.ajax({
                        url : "{{ route('registrar.class_subjects.modal_data', $class_id) }}",
                        type : 'POST',
                        data : { _token : '{{ csrf_token() }}', class_subject_details_id : class_subject_details_id, class_details_id: {{ $class_id }} },
                        success : function (res) {
                            $('.js-modal_holder').html(res);
                            $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                            $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                                //Timepicker
                                $('.timepicker').timepicker({
                                showInputs: false
                                })
                                $('.select2').select2()
                            })
                        }
                    });
            });

            
            
            $('body').on('click', '.js-btn_update_faculty', function (e) {
                    e.preventDefault();
                    
                    var class_subject_details_id = $(this).data('id');

                    $.ajax({
                        url : "{{ route('registrar.class_subjects.modal_data_faculty', $class_id  ) }}",
                        type : 'POST',
                        data : { _token : '{{ csrf_token() }}', class_subject_details_id : class_subject_details_id },
                        success : function (res) {
                            $('.js-modal_holder').html(res);
                            $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                            $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                                $('.select2').select2()

                                $("#submit_faculty_form").click(function () {
                                    teacher = [];
                                    var output = ''; 
                                    $( "#faculty option:selected" ).each(function(e) {
                                        teacher.push({
                                            name:   $(this).data('name'),  
                                            id :    $(this).data('id')   
                                        });
                                    });
                                    $.each(teacher, function (index, value) {
                                            
                                        output += '<tr>';
                                        output += '<td>' + value.name +'</td>';
                                        output += '<td class="text-center">'+
                                                  '<button data-id="' + value.id +'" data-subject_class_id="'+class_subject_details_id+'" type="button" title="delete" class="btn js-btn_delete btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>';
                                         
                                        $('#faculty_table tfoot').html(output);
                                    });                                    
                                });
                                
                                deleteFaculty();

                                $('.close-btn').click(function (){
                                    location.reload();
                                })
                            })
                        }
                    });
            });

            

            $('body').on('submit', '#js-form_faculty', function (e) {
                    e.preventDefault();
                    $class_id =  $('#id').val();

                    // var class_subject_details_id = $(this).data('id');
                    var formData = new FormData($(this)[0]);
                    $.ajax({
                        url         : "{{ route('registrar.class_subjects.save_faculty_data', $class_id) }}",
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
                                show_toast_alert({
                                    heading : 'Success',
                                    message : res.res_msg,
                                    type    : 'success'
                                });
                                
                            }
                        }
                    });
            });

            function deleteFaculty(){
            
                $('body').on('click', '.js-btn_delete', function (e) {
                    e.preventDefault();
                    var faculty_id = $(this).data('id');
                    var subject_class_id = $(this).data('subject_class_id');
                    
                    var self = $(this);
                    alertify.defaults.transition = "slide";
                    alertify.defaults.theme.ok = "btn btn-primary ";
                    alertify.defaults.theme.cancel = "btn btn-danger ";
                    alertify.confirm('Confirmation', 'Are you sure you want to delete?', function(){  
                        $.ajax({
                            url         : "{{ route('registrar.faculty_id.delete_data', $class_id) }}",
                            type        : 'POST',
                            data        : { _token : '{{ csrf_token() }}', faculty_id : faculty_id, subject_class_id : subject_class_id },
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

                                    self.closest('tr').remove();
                                    
                                }
                            }
                        });
                    }, function(){  

                    });
                });
            }

            $('body').on('submit', '#js-form_subject_details', function (e) {
                e.preventDefault();
                $class_id =  $('#id').val();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('registrar.class_subjects.save_data', $class_id) }}",
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

            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                fetch_data();
            });
            $('body').on('click', '.pagination a', function (e) {
                e.preventDefault();
                page = $(this).attr('href').split('=')[1];
                fetch_data();
            });

            $('body').on('click', '.js-btn_deactivate', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                alertify.defaults.transition = "slide";
                alertify.defaults.theme.ok = "btn btn-primary ";
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('Confirmation', 'Are you sure you want to deactivate?', function(){  
                    $.ajax({
                        url         : "{{ route('registrar.class_subjects.deactivate_data', $class_id) }}",
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
                                fetch_data();
                            }
                        }
                    });
                }, function(){  

                });
            });

            $('body').on('click', '#check_all_days', function () {
                if ($(this).data('checked-all')) {
                    $('.sched_days').prop('checked', true);
                    $(this).data('checked-all', !$(this).data('checked-all'));
                } else {
                    $('.sched_days').prop('checked', false);
                    $(this).data('checked-all', !$(this).data('checked-all'));
                }
            })

            
            
        });
    </script>
@endsection