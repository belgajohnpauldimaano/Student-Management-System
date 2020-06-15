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
              <h4>This account maybe not updated. Please contact the administrator. Thank you</h4>
          </div>
                    
       </div>
    </div>
  </div>
</div>





