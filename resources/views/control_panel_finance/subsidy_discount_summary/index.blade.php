@extends('control_panel.layouts.master')

@section ('styles') 

@endsection

@section ('content_title')
    Subsidy/Discount Summary
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <h3 class="card-title">Summary:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                         @include('control_panel_finance.subsidy_discount_summary.partials.data_list')       
                    </div>     
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $('#date_from').datepicker({
            autoclose: true
        }) 

        $('#date_to').datepicker({
            autoclose: true
        }) 

        
        function currencyFormat(num) {
            return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        } 

        var total = 0;
        function fetch_data (date_from, date_to, category_type, school_year)  {
            loader_overlay();

            $.ajax({
            url:"{{ route('finance.subsidy_discount.fetch_record') }}",
            method:"POST",
            data:{ _token : '{{ csrf_token() }}', category_type : category_type, school_year : school_year, date_from : date_from,  date_to : date_to},
            dataType:"json",
            success:function(data)
            {
                loader_overlay();
                total = 0;
                var output = '';                
                // $('#total_records').text(data.length);
                for(var count = 0; count < data.length; count++)
                {
                    output += '<tr>';
                    output += '<td style="width: 10%">' + (count+1) +'</td>';
                    output += '<td style="width: 20%">' + data[count].created_at + '</td>';
                    output += '<td style="width: 30%">' + data[count].student_name + '</td>';
                    output += '<td style="width: 20%">' + data[count].student_level + '</td>';
                    
                    // if(data[count].balance == null){
                    //     output += '<td style="width: 15%;text-align: right">' + data[count].balance + '</td>';
                    // }else{
                    //     output += '<td style="width: 15%;text-align: right">' + currencyFormat(data[count].balance) + '</td>';
                    // }
                    
                    output += '<td style="width: 15%;text-align: right">' + currencyFormat(data[count].discount_amt) + '</td>';
                    output += '</tr>';
                    if (!isNaN(data[count].discount_amt)) {
                        total += data[count].discount_amt;                        
                    }
                }

                $('tbody').html(output);
                $('tfoot').html(total_output);
                var total_output = '';
                
                if(data.length == ''){
                    // var total_output = '';
                    total_output +='<tr>';
                    total_output +='<td style="text-align: center" colspan="5"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/><b>SORRY THERE IS NO DATA AVAILABLE</b> </td>';
                    total_output +='</tr>';
                    total_output +='</tr>';
                }else{                
                    total_output +='<tr>';
                    total_output +='<td style="text-align: right" colspan="4"><b>Total:</b> </td>';
                    total_output +='<td colspan="2" style="text-align: right"><b>'+currencyFormat(total)+'</b></td>';
                    total_output +='</tr>';
                    total_output +='</tr>';
                }
                $('tbody').html(output);
                $('tfoot').html(total_output);
                
            }
            })
            
        } 
        
        $('body').on('click', '#js-btn_print', function (e) {
            e.preventDefault()
            const date_from = $('#date_from').val();
            const date_to = $('#date_to').val()
            const category_type = $('#category_type').val();
            const school_year = $('#school_year').val();
            if(total == 0){
                alertify.defaults.theme.ok = "btn btn-primary ";                
                alertify.defaults.theme.cancel = "btn btn-danger ";
                alertify.confirm('<i style="color: red" class="fas fa-question-circle"></i> Warning', 
                     'SORRY THERE IS NO DATA AVAILABLE', function(){                     
                         // location.reload();
                     }, function(){  
                });
            }
            else
            {
                window.open("{{ route('finance.subsidy_discount.print') }}?category_type="+category_type+"&total="+total+"&school_year="+school_year+"&date_from="+date_from+"&date_to="+date_to, '', 'height=800,width=800')
            }
        })

        $('.btn-fetch_record').click(function(){
            var category_type = $('#category_type').val();
            var school_year = $('#school_year').val();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            if(category_type != 2 && school_year != 0 && date_from != '' &&  date_to != '')
            {
                fetch_data(date_from, date_to, category_type, school_year);
            }
            else
            {
                checkDateFrom();
                checkDateTo();
                categoryFee();
                schoolYear();
            }
        });

        $('#date_from').focusin(function(){
            checkDateFrom();
        })

        $('#date_to').focusin(function(){
            checkDateTo();
        })

        $('#date_to').focusin(function(){
            checkDateTo();
        })

        $('#school_year').focusin(function(){
            schoolYear();
        })

        $('#category_type').change(function(){
            categoryFee();
        })

        $('#date_to').change(function(){
            checkDateTo();
        })

        $('#date_from').change(function(){
            checkDateFrom();
        })

        function schoolYear(){
            var school_year = $('#school_year').val();
            
            if(school_year != ''){
                $('.input-school_year').addClass('has-success');
                $('.input-school_year').removeClass('has-error');
                $('#js-school_year').css('color', 'green').text('');               
            }else{
                $('.input-school_year').addClass('has-error');
                $('.input-school_year').removeClass('has-success');
                $('#js-school_year').css('color', 'red').text('You must select school_year.');
            }
        }

        function categoryFee(){
            var category_type = $('#category_type').val();
            
            if(category_type != 2){
                $('.input-category_type').addClass('has-success');
                $('.input-category_type').removeClass('has-error');
                $('#js-category_type').css('color', 'green').text('');               
            }else{
                $('.input-category_type').addClass('has-error');
                $('.input-category_type').removeClass('has-success');
                $('#js-category_type').css('color', 'red').text('You must select category.');
            }
        }

        function checkDateFrom(){
            var date_from = $('#date_from').val();
            
            if(date_from != ''){
                $('.input-date_from').addClass('has-success');
                $('.input-date_from').removeClass('has-error');
                $('#js-date_from').css('color', 'green').text('');               
            }else{
                $('.input-date_from').addClass('has-error');
                $('.input-date_from').removeClass('has-success');
                $('#js-date_from').css('color', 'red').text('You must be select your date from.');
            }
        }

        function checkDateTo(){
            var date_to = $('#date_to').val();
            
            if(date_to != ''){
                $('.input-date_to').addClass('has-success');
                $('.input-date_to').removeClass('has-error');
                $('#js-date_to').css('color', 'green').text('');               
            }else{
                $('.input-date_to').addClass('has-error');
                $('.input-date_to').removeClass('has-success');
                $('#js-date_to').css('color', 'red').text('You must be select your date to.');
            }
        }

    </script>
@endsection