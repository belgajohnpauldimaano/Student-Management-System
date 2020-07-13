                    
       
    <form id="js-form_payment_transaction">
        {{ csrf_field() }} 

        @if($Transaction)                  
            @if ($StudentInformation)
                <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                <input type="hidden" name="stud_status" value="1">
                <input type="hidden" name="no_months_paid" value="{{$Transaction->no_month_paid}}" />
            @endif            
            
                @include('control_panel_finance.student_payment_account.partials.data_student')    
            <hr>
                @include('control_panel_finance.student_payment_account.partials.student_with_account.data_account') 
                     
        @else            
            @if ($StudentInformation)
                <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                <input type="hidden" name="stud_status" value="0">
            @endif
            
            
                @include('control_panel_finance.student_payment_account.partials.data_student')         
            <hr>               
                @include('control_panel_finance.student_payment_account.partials.student_enroll.data_enroll')
        @endif
    </form>
