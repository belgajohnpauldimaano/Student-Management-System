{{-- <h4>Enrollment</h4> --}}

<div class="row" id="selector_payment">
  <div class="col-md-12">
    
    <div class="box box-primary">
      
      <div class="box-header with-border">
        <h3 class="box-title col-lg-12">Enrollment Method</h3>
      </div>
      
      <div class="box-body justify-content-center" style="height: 20em">
        
        @if (session('error') || session('success'))
          <button id="btn-success-alert" 
            class="btn btn-danger hidden" 
            data-value="{{ session('error') ?? session('success') }}">
              isSuccess
          </button>   
        @endif
        
          <div class="form-group col-lg-6 col-lg-offset-3" id="form_method">
              <select name="payment_category" id="payment_category" class="form-control">            
                <option value="0" selected>
                  --Select Preferred Enrollment Method --
                </option>
                <option value="1">
                  Credit card/Debit card/PayMaya
                </option>
                <option value="2">
                  Bank Deposit
                </option>
                <option value="3">
                  Gcash
                </option>    
              </select>
            <div class="help-block text-left" id="js-payment_category"></div>
            <button type="button" id="btn_method" class="btn btn-primary pull-right">Submit</button>
          </div>
          <a class="btn btn-info pull-right btn-transaction-history" 
            data-id="{{$StudentInformation->id}}" 
            data-school_year_id="{{$SchoolYear->id}}" 
            href="#">
            <i class="fas fa-history"></i> Transaction History
          </a>
          
       </div>
    </div>
  </div>
</div>
@include('control_panel_student.enrollment.partials.modal_profile')

<div class="row" id="online" style="display: none">
    @include('control_panel_student.enrollment.partials.online_bank')
</div>

<div class="row" id="deposit" style="display: none; padding:0 16px 0 16px">    
    @include('control_panel_student.enrollment.partials.deposit_bank')
</div>

<div class="row" id="gcash" style="display: none; padding:0 16px 0 16px">    
  @include('control_panel_student.enrollment.partials.gcash_method')
</div> 


