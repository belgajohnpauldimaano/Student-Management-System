<div class="box box-info collapsed-box box-solid">
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
        <p>Follow the steps to continue to payment.</p>
    </div>
    <!-- /.box-body -->
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="col-md-6">    
            <div class="box-header with-border">
                <h3 class="box-title col-lg-12">Enrollment Form </h3>
            </div>
            <form role="form">      
                {{ csrf_field() }}
                <input type="hidden" name="payment-cat" value="Transfer - Gcash">
                <div class="form-group col-lg-12" style="margin-top: 10px">
                    <label for="exampleInputEmail1">You are incoming Grade-level <i style="color:red">{{$ClassDetail->grade_level+1}}</i></label>
                        <br><br>
                    <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                    @if($Downpayment)
                    <input type="hidden" name="gcash_tution_amt" value="{{$PaymentCategory->id}}">
                        <p>
                            Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')}}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                        </p>
                    @endif                
                </div>    
                <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Downpayment Fee </label>              
                    @if($Downpayment)
                        <input type="hidden" name="gcash_downpayment" value="{{$Downpayment->id}}">
                        <input type="hidden" id="gcash_downpayment" value="{{$Downpayment->downpayment_amt}}">                        
                        <p>{{number_format($Downpayment->downpayment_amt,2)}}</p>
                    @endif
                </div>  

                <div class="form-group col-lg-12 input-gcash_phone">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" id="gcash_phone" name="gcash_phone" placeholder="+639000000000" value="+639">
                    <div class="help-block text-left" id="js-gcash_phone"></div>
                </div>  
                <div class="form-group col-lg-12 input-gcash_email">
                    <label for="gcash_email">Email Address</label>
                    <input type="email" class="form-control" id="gcash_email" name="gcash_email" placeholder="your@email.com">
                    <div class="help-block text-left" id="js-gcash_email"></div>
                </div>    
            
            {{-- </div> --}}
        </div>
        <div class="col-md-6">        
                <div class="box-header with-border">
                    <h3 class="box-title col-lg-12">Upload with Gcash</h3>
                </div>
                <div class="form-group col-lg-12" style="margin-top: 10px">
                    <label for="Gcash">Gcash Name</label>               
                    <select name="Gcash" id="Gcash" class="form-control" style="width: 100%;">
                        <option  selected value="Gcash">
                            GCASH
                        </option>   
                    </select>               
                </div>    
        
                <div class="form-group col-lg-12 input-gcash_transaction_id">
                    <label for="gcash_transaction_id">Transaction Number</label>
                    <input type="number" class="form-control" id="gcash_transaction_id" name="gcash_transaction_id" placeholder="">
                    <div class="help-block text-left" id="js-gcash_transaction_id"></div>
                </div>
                
                <div class="form-group col-lg-12 input-gcash_pay_fee">
                    <label for="gcash_pay_fee">Enter your payment fee</label>
                    <input type="number" class="form-control" id="gcash_pay_fee" name="gcash_pay_fee" placeholder=" {{number_format($Downpayment->downpayment_amt,2)}}">
                    <div class="help-block text-left" id="js-gcash_pay_fee"></div>
                </div> 
                <div class="form-group col-lg-12 input-gcash_image ">
                    <label for="gcash_image">Image of receipt deposit slip</label>
                    <input type="file" id="gcash_image">
                    <div class="help-block text-left" id="js-gcash_image"></div>
                </div>
                <div class="checkbox col-lg-12">
                    <label>
                    <input type="checkbox" id="gcash_terms">I have read and Agree the <a href="">Terms of service</a>
                    </label>
                </div>
                <div class="box-footer col-lg-12">
                    <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
                    <button type="submit" disabled class="btn-gcash-enroll btn btn-primary pull-right">Enroll</button>
                </div>
            </form>
            
        </div>
    </div>
</div>