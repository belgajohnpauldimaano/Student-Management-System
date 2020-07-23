@extends('control_panel.layouts.master')

@section ('content_title')
    Student Account
@endsection

@section ('content')
    <div class="box box-danger">
        <div class="box-header">            
            <form id="js-form_search">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="overlay hidden" id="js-loader-overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="box-body">
            <div class="js-data-container">                
                @include('control_panel_finance.student_payment_account.partials.data_list')                       
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
            // loader_overlay();
            $.ajax({
                url : "{{ route('finance.student_payment_account') }}",
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
            total_fees();

            function currencyFormat(num) {
                return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            } 

            downpayment_total = 0;
            all_in = 0;
            function total_fees(){
                disc_total = 0;            
                less_total = 0;            
                total = 0;  
                grandTotal = 0;
                disc = [];
                $('#disc_amt').html("");           

                $('#or_number').keyup(function() {
                    var or = $('#or_number').val();
                    $('#or_num').text(or);
                    $('.js-btn_print').data('or_num', or);
                    $('#js-btn-save').data('or_num', or);
                    // alert(or);
                });     

                $('input[name="discount[]"]:checked').each(function () {                
                    disc.push({
                        type: $(this).data('type'),
                        fee: $(this).data('fee')
                    });
                });
                $.each(disc, function (index, value) {                
                    disc_total += parseFloat(value.fee);                
                    $item = ''+ value.type +' '+ currencyFormat(value.fee) + '<br/>';
                    $('#disc_amt').append($item);  
                });       

                if($('#downpayment').val() == ''){
                    // $('#downpayment').text(0);
                    document.getElementById('downpayment').value = (0);
                }
            }

            setPayment();
            function setPayment(){
                var dataid = $("#payment_category option:selected").attr('value');
                // const dataid = $("#payment_category option:selected").attr('data-gradelvl');
                var tuition = $("#payment_category option:selected").attr('data-tuition');
                var misc = $("#payment_category option:selected").attr('data-misc');
                var other = $("#payment_category option:selected").attr('data-other');
                // alert(dataid);
                $('#tuition_fee').text(currencyFormat(parseFloat(tuition)));
                $('#misc_fee').text(currencyFormat(parseFloat(misc)));
                $('#other_fee').text(currencyFormat(parseFloat(other)));

                all_in = parseFloat(tuition) + parseFloat(misc) + parseFloat(other);
                grand_total();
            }

            $('#payment_category').on('change', function() {
                setPayment();
                // alert(total)
            });

            $(".downpaymentSelected").click(function (e) {
                downpayment = [];
                
                $('input[name="downpayment1[]"]:checked').each(function () {                
                    downpayment.push({
                        fee: $(this).data('fee')
                    });
                });
                $.each(downpayment, function (index, value) {                
                    downpayment_bank_fee = parseFloat(value.fee);
                    document.getElementById('payment').value = (downpayment_bank_fee);
                    $('#dp_enrollment').text(currencyFormat(parseFloat(downpayment_bank_fee)));
                    downpayment_total = downpayment_bank_fee; 
                    grand_total();
                }); 

            });

            $('#payment').keyup(function() {
                $('#dp_enrollment').text(currencyFormat(parseFloat($('#payment').val())));
                downpayment_total = parseFloat($('#payment').val());            
                grand_total();
            });     
            
            $(".discountSelected").click(function (e) {
                total_fees();    
                grand_total();         
            });
            

            function grand_total(){
                less_total= disc_total + downpayment_total;
                total = all_in - less_total;
                $('#total_balance').text(currencyFormat(total));  
            }


            get_payment_monthly();
            balance = 0;
            function get_payment_monthly(){           
                disc_total2 = 0;           
                disc2 = [];

                $('#js-discount_fee_payment').html("");           
                
                $('#or_number_payment').keyup(function() {
                    var or = $('#or_number_payment').val();
                    $('#js-or_num_payment').text(or);
                    // $('.js-btn_print').data('or_num', or);
                    // $('#js-btn-save-monthly').data('or_num', or);

                    // alert(or);
                }); 

                $('.js-discount:checked').each(function () {                
                    disc2.push({
                        type: $(this).data('type'),
                        fee: $(this).data('fee')
                    });
                });
                $.each(disc2, function (index, value) {                
                    disc_total2 += parseFloat(value.fee);                
                    $item = ''+ value.type +' '+ currencyFormat(value.fee) + '<br/>';
                    // alert($item)
                    $('#js-discount_fee_payment').append($item);  
                });  
                

                $('#payment_bill').keyup(function() {
                    $('#js-monthly_fee_payment').text(currencyFormat(parseFloat($('#payment_bill').val())));
                                    
                    var current_bal = $('#js-current_balance').val();
                    var payment_fee = $('#payment_bill').val();
                    
                    balance = (current_bal - parseFloat(payment_fee));
                
                    $('#js-current_bal').text(currencyFormat(balance));
                    grand_total_2();
                    // document.getElementById('total_bal').value = balance;
                });       

            }

            function grand_total_2(){
                less_total= balance - disc_total2;                
                $('#js-current_bal').text(currencyFormat(less_total));  
            }

              

           
            getOthers();

            function getOthers()
            {
                // $('#item-qty-input').keyup(function() {
                //     $('.item-qty').text($('#item-qty-input').val());
                // });
                $('.js-btnRemove').on('click', function(e){
                    e.preventDefault();
                    alert('remove');
                });

                $('#or_number_others').keyup(function() {
                    var or = $('#or_number_others').val();
                    $('#js-or_num_others').text(or);
                    $('.js-btn_print').data('or_num', or);
                    $('#js-btn-save').data('or_num', or);
                    // alert(or);
                });

                $('.js-btnAdd').on('click', function(){
                    
                    if($(this).closest('tr').find('.item-qty').val() == '' || $(this).closest('tr').find('.item-qty').val() < 0){
                        alert('empty');
                    }else{
                        
                        function currencyFormat(num) {
                            return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                        }
                        var or = $('#or_number_others').val();
                        var currentRow=$(this).closest("tr");
                        var col1 = currentRow.find(".item-description").html();
                        var col2 = $(this).closest('tr').find('.item-qty').val();

                        var price = currentRow.find(".item-price").html();
                        var item_id = currentRow.find(".item-id").html();

                        var total = (col2 * price);

                        var id_qty = item_id+'.'+col2+'.'+price+'.'+col1;
                    
                        var action = '<button id="btnremove" class="btn btn-sm btn-flat btn-danger js-btnRemove"><i class="far fa-trash-alt"></i></button>';                   
                        var input_description = '<input type="hidden" name="id_qty[]" class="selected_description" value='+id_qty+'>';                    
                        var row = $(this).closest("tr").html();
                        $("#others_result tbody").append("<tr><td>" + col1 + "</td><td class='quantity' style='text-align: center'> " + col2 + "</td><td class='inputed_price' style='text-align: right'><span class='total_price' style='display:none'>" +total+ "</span>" + currencyFormat(total) + "</td><td  style='text-align: center'>"+action+" " +input_description+"</td></tr>");
                        
                        $('table thead th').each(function(i) {
                            calculateColumn(i);
                        });
                    }
                    
                });

                
                $('#others_result tbody').on('click', '#btnremove', function(e){                    
                    
                    $(this).closest('tr').remove()
                    
                    $('table thead th').each(function(i) {
                        calculateColumn(i);
                    });
                    
                });

                $("#others_item tr td").on("click", function() {
                    var row = $(this).closest("tr").html();
                    $("#table2").append("<tr>" + row + "</tr>");
                });

                // $('.js-btnRemove').on("click", "#others_result tr td", function() {
                //     $(this).parent().remove();
                // });
                
            }

            function calculateColumn(index) {
                var total = 0;
                $('table tr').each(function() {
                    var value = parseInt($('.total_price', this).eq(index).text());
                    if (!isNaN(value)) {
                        total += value;
                    }
                });
                function currencyFormat(num) {
                    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
                }
                $('table tfoot #total').eq(index).text(currencyFormat(total));
            }        
        
            $('body').on('click', '#js-button-payment', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('finance.student_payment_account.modal') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                            //Date picker
                            $('#datepicker').datepicker({
                                autoclose: true
                            }); 

                            get_payment_monthly();
                            $(".js-discount").on("click", function () {
                                get_payment_monthly();
                                grand_total_2();
                                // alert('herqer');
                            }); 

                            btnSaveDisabled();
                            
                            getOthers();
                            
                            $(document).ready(function() {
                                $('table thead th').each(function(i) {
                                    calculateColumn(i);
                                });
                            });

                            
                            
                        });;
                    }
                });
            });

            $('body').on('click', '.btn-transaction-edit', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('finance.student_payment_account.modal_edit') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', id : id },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                        $('.js-modal_holder .modal').on('shown.bs.modal', function () {
                            
                        });;
                    }
                });
            });

            $('body').on('submit', '#js-update_transaction', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('finance.student_payment_account.update_data') }}",
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

                            fetch_data();
                        }
                    }
                });
            });

            $('body').on('click', '.btn-close', function (e) {
                location.reload();
            })

            $('body').on('click', '.js-button-payment', function (e) {
                e.preventDefault();
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
            
            $('body').on('click', '.js-btn_print_grade', function (e) {
                e.preventDefault();
                {{--  loader_overlay();  --}}
                var id = $(this).data('id');
                $.ajax({
                    url : "{{ route('admin.student.information.print_student_grade_modal') }}",
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
                        });
                    }
                });
            })

            $('body').on('click', '#js-btn_print_student_grade', function (e) {
                e.preventDefault();
               
                var id = $('#print_student_id').val();
                var print_sy = $('#print_sy').val();
                if (print_sy < 1) {
                    alert('Please select school year')
                    return
                }
                window.open("{{ route('admin.student.information.print_student_grades') }}?id="+id+"&cid="+print_sy, '', 'height=800,width=800')
            })

            disable = false;
            function btnSaveDisabled()
            {
                if(disable==true){
                    $('.js-btn-save').attr('disabled', true);   
                }                
            }
            

            $('body').on('submit', '#js-form_payment_transaction', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('finance.student_payment_account.save_data') }}",
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

                            $('.transaction-success').html(''+
                                '<div class="alert alert-success alert-dismissible">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                                    '<h4><i class="icon fa fa-check"></i> Success!</h4>'+
                                    'Transaction successfully submitted!'+
                                '</div>'                            
                            +'');

                            disable = true;
                            btnSaveDisabled();
                           
                            fetch_data();
                        }
                    }
                });
            });
            

            $('body').on('submit', '#js-others_item', function (e) {
                e.preventDefault();
                
                
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url         : "{{ route('finance.student_payment_account.save_others') }}",
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