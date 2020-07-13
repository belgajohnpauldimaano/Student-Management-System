<div style="padding:0 16px 0 16px">
  <h2 class="{{$isPaid ? $isPaid ? 'overlay-paid' : '' : ''}}">{{$isPaid ? $isPaid ? 'PAID' : '' : ''}}</h2>
  <div class="box box-info box-solid collapsed-box">
    <div class="box-header with-border ">
      <h3 class="box-title">Instructions</h3>
  
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-plus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
        <p>Debit/Credit/PayMaya Transaction</p>
        <p>
          Step 1. Fill up necessary information below.
        </p>
        <p>
          Step 2. Click the enroll button to proceed with the payment.
        </p>
        <p>
          Step 3. Wait for the portal of paypal.
        </p>
        <p>
          Step 4. Choose your preferred method and enter the required information.
        </p>
        <p>
          Step 5. Wait for the text/email or confirmation upon successful payment via Debit/Credit card or PayMaya.
        </p>
    </div>
    <!-- /.box-body -->
  </div>
</div>

<form id="js-checkout-form">
  {{ csrf_field() }}
<div class="col-md-12">
  <div class="box box-primary" style="height: 20em">
    <div class="text-center">
      <h4>Sorry this transaction not available this time. Thank you</h4>
    </div>
          
  </div>
</div>

</form>