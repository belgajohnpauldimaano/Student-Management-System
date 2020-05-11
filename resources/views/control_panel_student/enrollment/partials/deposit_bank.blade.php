<div class="box box-info collapsed-box">
    <div class="box-header with-border ">
      <h3 class="box-title">Instructions</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
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
        
        {{-- <div class="callout callout-info">
          <h4>Instructions</h4>
          <p>Follow the steps to continue to payment.</p>
        </div> --}}
        <div class="col-md-6">    
            <div class="box-header with-border">
                <h3 class="box-title col-lg-12">Enrollment Form </h3>
            </div>
            <form role="form">      
                
                <div class="form-group col-lg-12" style="margin-top: 10px">
                    <label for="exampleInputEmail1">You are incoming Grade-level <i style="color:red">{{$ClassDetail->grade_level+1}}</i></label>
                        <br><br>
                    <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                    @if($Downpayment)
                    <input type="hidden" name="bank_tution_amt" value="{{$PaymentCategory->id}}">
                        <p>
                            Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')}}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                        </p>
                    @endif                
                </div>    
                <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Downpayment Fee </label>              
                    @if($Downpayment)
                        <input type="hidden" name="bank_downpayment" value="{{$Downpayment->id}}">
                        <input type="hidden" id="bank_downpayment" value="{{$Downpayment->downpayment_amt}}">                        
                        <p>{{number_format($Downpayment->downpayment_amt,2)}}</p>
                    @endif
                </div>  

                <div class="form-group col-lg-12 input-bank_phone">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" id="bank_phone" name="bank_phone" placeholder="+639000000000" value="+639">
                    <div class="help-block text-left" id="js-bank_phone"></div>
                </div>  
                <div class="form-group col-lg-12 input-bank_email">
                    <label for="bank_email">Email Address</label>
                    <input type="email" class="form-control" id="bank_email" name="bank_email" placeholder="your@email.com">
                    <div class="help-block text-left" id="js-bank_email"></div>
                </div>    
            
            {{-- </div> --}}
        </div>
        <div class="col-md-6">
        
            <div class="box-header with-border">
                <h3 class="box-title col-lg-12">Upload with Bank/Gcash Transaction</h3>
            </div>
            <div class="form-group col-lg-12" style="margin-top: 10px">
                <label for="bank">Bank Name</label>               
                    <select name="bank" id="bank" class="form-control" style="width: 100%;">
                        <option selected value="pnb">
                            --Choose bank--
                        </option> 
                        <option  value="pnb">
                            PNB
                        </option>   
                        <option  value="EW">
                            East West
                        </option>
                        <option  value="MB">
                            Metrobank
                        </option>
                        <option  value="CB">
                            Chinabank
                        </option> 
                    </select>               
            </div>    
    
            <div class="form-group col-lg-12 input-bank_transaction_id">
                <label for="bank_transaction_id">Transaction Number</label>
                <input type="number" class="form-control" id="bank_transaction_id" name="bank_transaction_id" placeholder="">
                <div class="help-block text-left" id="js-bank_transaction_id"></div>
            </div>
            
            <div class="form-group col-lg-12 input-bank_pay_fee">
                <label for="bank_pay_fee">Enter your payment fee</label>
                <input type="number" class="form-control" id="bank_pay_fee" name="bank_pay_fee" placeholder=" {{number_format($Downpayment->downpayment_amt,2)}}">
                <div class="help-block text-left" id="js-bank_pay_fee"></div>
            </div> 
            <div class="form-group col-lg-12">
                <label for="bank_image">Image receipt deposit slip</label>
                <input type="file" id="bank_image">
                <div class="help-block text-left" id="js-bank_image"></div>
            </div>
            <div class="checkbox col-lg-12">
                <label>
                <input type="checkbox" id="bank_terms">I have read and Agree the <a href="">Terms of service</a>
                </label>
            </div>
            <div class="box-footer col-lg-12">
            <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
            <button type="submit" disabled class="btn-bank-enroll btn btn-primary pull-right">Enroll</button>
            </div>
            </form>
            
        </div>
    </div>
</div>