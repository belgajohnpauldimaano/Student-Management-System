@extends('control_panel.layouts.master')

@section ('content_title')
    Student List
@endsection

@section ('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search</h3>
            <form id="js-form_search">
                {{ csrf_field() }}
                <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-left:0;padding-right:0">
                    <input type="text" class="form-control" name="search">
                </div>                
                <button type="submit" class="btn btn-flat btn-success">Search</button>
                {{-- <button type="button" class="pull-right btn btn-flat btn-danger btn-sm" id="js-button-add">
                    <i class="fa fa-plus"></i> Add
                </button> --}}
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            
            <div class="js-data-container">
                @include('control_panel_finance.student_information.partials.data_list')       
            </div>
            
        </div>        
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            $.ajax({
                url : "{{ route('finance.student_account') }}",
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
            $('body').on('click', '.js-btn_account', function (e) {
                e.preventDefault();
                 {{-- loader_overlay();  --}}
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('finance.student_account.modal') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                            //Date picker
                            $('#datepicker').datepicker({
                                autoclose: true
                            })  
                            $('.select2').select2();

                            total = 0;
                            disc_total = 0;
                            tuition_total = 0;
                            misc_total = 0;
                            downpayment_total=0;
                            less_total = 0;
                            function currencyFormat(num) {
                                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                            }
                            
                            $('#or_number').keyup(function() {
                                var or = $('#or_number').val();
                                $('#or_num').text(or);
                                $('.js-btn_print').data('or_num', or);
                                $('#js-btn-save').data('or_num', or);
                                // alert(or);
                            });

                            $('#downpayment').keyup(function() {
                                function currencyFormat(num) {
                                    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                }
                                $('#dp_enrollment').text(currencyFormat(parseFloat($('#downpayment').val())));
                                downpayment_total = parseFloat($('#downpayment').val());
                                total_fees();
                            });                           
                            
                            $('#payment_category').on('change', function() {
                                var dataid = $("#payment_category option:selected").attr('value');
                                // const dataid = $("#payment_category option:selected").attr('data-gradelvl');
                                var tuition = $("#payment_category option:selected").attr('data-tuition');
                                var misc = $("#payment_category option:selected").attr('data-misc');
                                // alert(dataid);
                                $('#tuition_fee').text(currencyFormat(parseFloat(tuition)));
                                $('#misc_fee').text(currencyFormat(parseFloat(misc)));

                                tuition_total = parseFloat(tuition) + parseFloat(misc);
                                total_fees();
                                // alert(total)
                            });

                            $(".discountSelected").change(function () {
                                var str = "";
                                disc = [];
                                $('#disc_amt').html("");
                                $( ".discountSelected option:selected" ).each(function() {
                                // str += $( this ).text() + " ";
                                    disc.push({
                                        type: $(this).data('type'),
                                        fee: $(this).data('fee')
                                    });
                                });
                                $.each(disc, function (index, value) {
                                    
                                    disc_total += parseFloat(value.fee);

                                    $item = ''
                                        + value.type +' '+ value.fee + '<br/>'
                                        ;

                                    $('#disc_amt').append($item);
                                });
                                // $( "div" ).text( str );
                                // alert('str')
                                total_fees();
                            })
                            .change();

                            function total_fees(){
                                less_total= disc_total + downpayment_total;
                                total = tuition_total + misc_total - less_total;
                                $('#total_balance').text(currencyFormat(total));           
                            } 

                            // monthly fee    

                            // $(".monthly_select").change(function () {
                            //     var str = "";
                            //     disc = [];
                            //     $('#disc_amt').html("");
                            //     $( ".monthly_select option:selected" ).each(function() {
                            //     // str += $( this ).text() + " ";
                            //         disc.push({
                            //             type: $(this).data('type'),
                            //             fee: $(this).data('fee')
                            //         });
                            //     });
                            //     $.each(disc, function (index, value) {
                                    
                            //         disc_total += parseFloat(value.fee);

                            //         $item = ''
                            //             + value.type +' '+ value.fee.toLocaleString() + '<br/>'
                            //             ;

                            //         $('#disc_amt').append($item);
                            //     });
                            //     // $( "div" ).text( str );
                            //     // alert('str')
                            //     total_fees();
                            // })
                            // .change();
                            current_balance();
                            $('#or_number_others').keyup(function() {
                                var or = $('#or_number_others').val();
                                $('#js-or_num_others').text(or);
                                $('.js-btn_print').data('or_num', or);
                                $('#js-btn-save-monthly').data('or_num', or);

                                // alert(or);
                            }); 

                            $('#payment').keyup(function() {
                                function currencyFormat(num) {
                                    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                                }
                                $('#js-monthly_fee_others').text(currencyFormat(parseFloat($('#payment').val())));
                                // downpayment_total = parseFloat($('#payment').val());
                                // total_fees();
                                current_balance();
                            });   

                            $('.monthly_select').on('change', function() {
                                var mo = $('.monthly_select').val();
                                $('#js-month_others').text(mo);
                            });

                            function current_balance(){
                                var bal = $('#js-current_balance').val()
                                var mo = $('#payment').val();
                                // $('#js-month_others').text(mo);
                                current_bal = bal - mo;
                                $('#js-current_bal').text(currencyFormat(current_bal));     
                            }                                    
                            
                        });
                    }
                });
            });

            $('body').on('click', '.js-btn_account_modal', function (e) {
                e.preventDefault();
                 {{-- loader_overlay();  --}}
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('finance.student_account.modal_account') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                            //Date picker
                            $('#datepicker').datepicker({
                                autoclose: true
                            })  
                            $('.select2').select2();

                        });;
                    }
                });
            });
            
           
            
            // $('body').on('click', '#js-btn-save', function (e) {
            //     e.preventDefault();

            //     var q = $(this).data('id');
            //     var or_num = parseInt($(this).data('or_num'));
                
            //     if(or_num){
            //         if(q == 1){
            //             // alert('none');
            //             dataSaved()
            //         }                   
            //     }
                
            // });

            // function dataSaved(data, value) {                               
            //         alert(data);
            // }

           
            function error(){
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify
                .alert("Please save first before your print it.", function(){
                    // alertify.message('OK');
                });
            }

            $('body').on('click', '.js-btn_print', function (e) {
                e.preventDefault();
                var btn_save = $(this).data('id');
                // var id = $('#print_student_id').val();
                // var print_sy = $('#print_sy').val();
                var syid = $(this).data('syid');
                var studid = $(this).data('studid');
                var or_num = $(this).data('or_num');

                var downpayment = $('#downpayment').val();
                var payment_category = $('#payment_category').val();
                
                var stud_status = $('#stud_status').val();
                var balance = $('#js-current_balance').val();
                
                if (or_num) {
                    if(downpayment == '' || payment_category == ''){
                        error();
                    }
                    else{
                        window.open("{{ route('finance.print_enrollment_bill') }}?syid="+syid+"&studid="+studid+"&or_num="+or_num+"&stud_status="+stud_status+"&balance="+balance, '', 'height=800,width=800')
                    }
                }
                else
                {
                    error();
                }
                
            })
            

            $('body').on('submit', '#js-form_payment_transaction', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('finance.student_account.save_data') }}",
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
                            // $('.js-modal_holder .modal').modal('hide');
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });
                            // document.getElementById("js-form_payment_transaction").reset();
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
                alertify.defaults.theme.ok = "btn btn-primary btn-flat";
                alertify.defaults.theme.cancel = "btn btn-danger btn-flat";
                alertify.confirm('Confirmation', 'Are you sure you want to deactivate?', function(){  
                    $.ajax({
                        url         : "{{ route('admin.student.information.deactivate_data') }}",
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

            $('body').on('submit', '#form_user_photo_uploader', function (e) {
                e.preventDefault();
                readURL($(this));
            });

            $('body').on('click', '.btn--update-photo', function (e) {
                $('#user--photo').click()
            })
            
            $('body').on('change', '#user--photo', function (e) {
                readURL($(this))
            })

            function readURL(input) {
                var url = input[0].value;
                var id = $(this).data('id');
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
                            url : "{{ route('admin.student.change_my_photo') }}",
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
        });

       

        
    </script>
@endsection