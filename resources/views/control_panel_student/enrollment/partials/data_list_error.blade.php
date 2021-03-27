{{-- <h4>Enrollment</h4> --}}

<div class="row" id="selector_payment">
  <div class="col-md-12">
    
    <div class="card card-default">
      
      <div class="card-header">
        <h5 class="box-title"></h5>
      </div>
      
      <div class="card-body">
        
        @if (session('error') || session('success'))
          <button id="btn-success-alert" 
            class="btn btn-danger hidden" 
            data-value="{{ session('error') ?? session('success') }}">
              isSuccess
          </button>   
        @endif
        
          <div class="form-group" id="form_method">
              @include('errors.404')
          </div>
                    
       </div>
    </div>
  </div>
</div>





