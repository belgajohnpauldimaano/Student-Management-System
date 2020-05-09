{{-- <h4>Enrollment</h4> --}}
<div class="row" id="selector_payment">
  <div class="col-md-12">
    
    <div class="box box-primary">
      
      <div class="box-header with-border">
        <h3 class="box-title col-lg-12">Enrollment Method</h3>
      </div>
      
      <div class="box-body justify-content-center" style="height: 20em"> 
        @if (session('error') || session('success'))     
          <div class="modal {{ session('error') ? 'modal-error':'modal-success' }} fade" tabindex="-1" role="dialog" id="modal-alert"  data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" style="top: 110px;" role="document">
                <div class="modal-content">                    
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                      <i class="icon fa {{ session('error') ? 'fa-ban':'fa-check' }}"></i> {{ session('error') ? 'Error':'Success' }}
                    </h4>
                  </div>
                  <div class="modal-body" align="center">                        
                      <h4> {{ session('error') ?? session('success') }} </h4>                    
                  </div>     
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                  </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
        @endif   
        
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