<div class="col-md-6">
    <div class="box box-primary" style="height: 33em;">
        <div class="box-header with-border">
          <h3 class="box-title col-lg-12">Enrollment Form</h3>
        </div>
        <form role="form">
          <div class="box-body">
            <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">You are incoming Grade-level <i style="color:red">{{$ClassDetail->grade_level+1}}</i></label>
                    <br><br>
                <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                @if($Tuition)
                    @if(!empty($PaymentCategory->tuition))
                    <select name="tution_category" id="tution_category" class="form-control" style="width: 100%;">
                        <option selected value="{{$PaymentCategory->id}}">
                            Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')}}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                        </option>    
                    </select>
                    @endif
                @endif
            </div>    
            <div class="form-group col-lg-12">
              <label for="exampleInputEmail1">Downpayment Fee</label>
              @if($Downpayment)
              <select name="downpayment" id="downpayment" class="form-control" style="width: 100%;">
                  <option selected value="{{$Downpayment->downpayment_amt}}">
                      {{number_format($Downpayment->downpayment_amt,2)}}
                  </option>    
              </select>
              @endif
            </div>  

            <div class="form-group col-lg-12 input-phone">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="+639000000000" value="+639">
                <div class="help-block text-left" id="js-number"></div>
            </div>  
            <div class="form-group col-lg-12 input-email">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com">
                <div class="help-block text-left" id="js-email"></div>
            </div>             
            
          </div>
        </div>
</div>
<div class="col-md-6">
    <div class="box box-primary" style="height: 33em;">
        <div class="box-header with-border">
          <h3 class="box-title col-lg-12">Transaction Summary</h3>
        </div>
        <div class="box-body">
            <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">Bank Name</label>               
                    <select name="downpayment" id="downpayment" class="form-control" style="width: 100%;">
                        <option selected value="pnb">
                            Choose bank
                        </option> 
                        <option selected value="pnb">
                            PNB
                        </option>   
                        <option selected value="EW">
                            East West
                        </option>
                        <option selected value="MB">
                            Metrobank, 
                        </option>
                        <option selected value="CB">
                            Chinabank
                        </option> 
                    </select>               
            </div>    
  
            <div class="form-group col-lg-12 input-payment">
                <label for="pay_fee">Transaction Number</label>
                <input type="number" class="form-control" id="pay_fee" name="pay_fee" placeholder=" {{number_format($Downpayment->downpayment_amt,2)}}">
                <div class="help-block text-left" id="js-pay_fee"></div>
            </div>
            
            <div class="form-group col-lg-12 input-payment">
                <label for="pay_fee">Enter your payment fee</label>
                <input type="number" class="form-control" id="pay_fee" name="pay_fee" placeholder=" {{number_format($Downpayment->downpayment_amt,2)}}">
                <div class="help-block text-left" id="js-pay_fee"></div>
            </div> 
            <div class="form-group col-lg-12">
                <label for="exampleInputFile">Image receipt deposit slip</label>
                <input type="file" id="exampleInputFile">
                <div class="help-block text-left" id="js-image_receipt"></div>
            </div>
            <div class="checkbox col-lg-12">
                <label>
                  <input type="checkbox" id="terms">I have read and Agree the <a href="">Terms of service</a>
                </label>
              </div>
            <div class="box-footer col-lg-12">
            <button type="submit" class="btn-reset btn btn-danger pull-left">Reset</button>
            <button type="submit" class="btn btn-primary pull-right">Enroll</button>
            </div>
          </form>
        </div>
      </div>
</div>