{{-- <h4>Enrollment</h4> --}}
<div class="row" id="selector_payment">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title col-lg-12">Enrollment Method</h3>
      </div>
      <div class="box-body justify-content-center" style="height: 20em">       
        <div class="form-group col-lg-6 col-lg-offset-3" id="form_method">
          <select name="payment_category" id="payment_category" class="form-control">            
            <option value="0" selected>
              Enrollment Method
            </option>
            <option value="1">
              Online Payment
            </option>
            <option value="2">
              Bank Deposit
            </option>    
          </select>
          <div class="help-block text-left" id="js-payment_category"></div>
          <button type="button" id="btn_method" class="btn btn-primary pull-right">Submit</button>
        </div>
       </div>
    </div>
  </div>
</div>

<div class="row" id="online" style="display: none">    
    @include('control_panel_student.enrollment.partials.online_bank')
</div>

<div class="row" id="deposit" style="display: none">    
    @include('control_panel_student.enrollment.partials.deposit_bank')
</div>