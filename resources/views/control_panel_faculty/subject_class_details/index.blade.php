@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Subject Class Details
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
            <div class="col-8 m-auto">
                <form id="js-form_search">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-4">
                            <h5 class="box-title">Filter</h5>
                            <div id="js-form_search" class="form-group">
                                <select name="search_sy" id="search_sy" class="form-control">
                                    <option value="">Select SY</option>
                                    @foreach ($SchoolYear as $data)
                                        <option value="{{ $data->id }}">{{ $data->school_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <h5 class="box-title">&nbsp;</h5>
                            <div id="js-form_search" class="form-group">
                                <select name="search_class_subject" id="search_class_subject" class="form-control">
                                    <option value="">Select Class Subject</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right d-none" id="js-btn_print">
                        <i class="fa fa-file-pdf"></i> Print
                    </button>
                    <button type="submit" class="btn btn-success float-right mr-2">
                        <i class="fa fa-search"></i> Search
                    </button>
                    {{--  <button type="button" class="pull-right btn btn-danger btn-sm" id="js-button-add"><i class="fa fa-plus"></i> Add</button>  --}}
                </form>                
            </div>
        </div>
        <div class="card-body">
            <div class="js-data-container"></div>
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
                url : "{{ route('faculty.subject_class.list_students_by_class') }}",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                    $('#js-btn_print').removeClass('d-none');
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
                        url         : "{{ route('registrar.class_details.deactivate_data') }}",
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
            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                const search_class_subject = $('#search_class_subject').val()
                const search_sy = $('#search_sy').val()
                if (!search_class_subject || !search_sy) {
                    alert('Please select a subject');
                    return;
                }
                window.open("{{ route('faculty.subject_class.list_students_by_class_print') }}?search_class_subject="+search_class_subject+"&search_sy="+search_sy, '', 'height=800,width=800')
            })
        });
    </script>
@endsection