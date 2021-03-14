{{-- <h4>Enrollment</h4> --}}
<div class="row" id="selector_payment">
  <div class="col-md-8 m-auto">
    <div class="card card-default">
        {{-- <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div> --}}
        <div class="card-header text-center">
            <h3 class="card-title">Payment Registration Method:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                {{-- <h3 class="card-title"> </h3> --}}
                @if (session('error') || session('success'))
                  <button id="btn-success-alert" 
                    class="btn btn-danger hidden" 
                    data-value="{{ session('error') ?? session('success') }}">
                      isSuccess
                  </button>   
                @endif
                
                  <div class="form-group col-lg-8 m-auto" id="form_method">
                      <select name="payment_category" id="payment_category" class="form-control form-control-sm">    
                        <option value="0" selected>
                            --Select--
                        </option>
                        {{-- <option value="0">
                          Credit card/Debit card/PayMaya <span style="color: red !important">(Not Available)</span>
                        </option> --}}
                        <option value="2">
                          Bank Deposit/Fund Transfer/Mobile Banking
                        </option>
                        <option value="3">
                          Gcash
                        </option>    

                      </select>
                    <div class="help-block text-left" id="js-payment_category"></div>
                    <button type="button" id="btn_method" class="btn btn-primary float-right mt-2">Submit</button>
                  </div>
            </div>
        </div>
    </div>
    
  </div>
</div>

  @include('control_panel_student.enrollment.partials.modal_profile')

  {{-- <div class="row" id="online" style="display: none;">
      @include('control_panel_student.enrollment.partials.online_bank')
  </div> --}}

  <div class="row" id="deposit" style="display: none; padding:0 16px 0 16px">    
      @include('control_panel_student.enrollment.partials.deposit_bank')
  </div>

  <div class="row" id="gcash" style="display: none; padding:0 16px 0 16px">    
    @include('control_panel_student.enrollment.partials.gcash_method')
  </div>



