<div class="col-md-6">
  <form id="js-checkout-form">
    {{ csrf_field() }}
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-lg-12">Online Enrollment Form</h3>
        </div>        
          <div class="box-body">
            <div class="form-group col-lg-12">
                <label for="exampleInputEmail1">You are incoming Grade-level <i style="color:red">{{$ClassDetail->grade_level+1}}</i></label>
                    <br><br>
                <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                
                  @if($PaymentCategory))
                  <select name="tution_category" id="tution_category" class="form-control" style="width: 100%;">
                      <option selected value="{{$PaymentCategory->id}}">
                          Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2) }}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                      </option>    
                  </select>
                  @endif
                
            </div>    
            <div class="form-group col-lg-12">
              <label for="exampleInputEmail1">Downpayment Fee</label>
              @if($Downpayment)
              <input type="hidden" value="{{$Downpayment->id}}" name="e_downpayment">
              <select name="downpayment" id="downpayment" class="form-control" style="width: 100%;">
                  <option selected value="{{$Downpayment->downpayment_amt}}">
                      {{number_format($Downpayment->downpayment_amt,2)}}
                  </option>    
              </select>
              @endif
            </div>    

           <div class="form-group col-lg-12 input-payment">
                <label for="pay_fee">Enter your payment fee</label>
                <input type="number" class="form-control" id="pay_fee" name="pay_fee" placeholder=" {{number_format($Downpayment->downpayment_amt,2)}}">
                <div class="help-block text-left" id="js-pay_fee"></div>
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
            <div class="checkbox col-lg-12">
              <label>
                <input type="checkbox" id="terms">I have read and Agree the <a href="">Terms of service</a>
              </label>
            </div>
          </div>
        </div>
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-lg-12">Transaction Summary</h3>
        </div>
        <div class="box-body">
                  
            <table class="table  table-invoice table-striped">
              <tbody>
                  <tr>                       
                      <tr>
                            <td style="width:140px">Tuition Fee</td>
                            <td align="right" id="tuition_fee">
                              {{number_format($PaymentCategory->tuition->tuition_amt, 2)}}
                            </td>
                      </tr>
                      <tr>
                            <td style="width:140px">Misc Fee</td>
                            <td align="right" id="misc_fee">
                                {{number_format($PaymentCategory->misc_fee->misc_amt,2)}}
                            </td>
                      </tr>
                      <tr>
                            <td style="width:140px">Payment</td>
                            <td align="right">
                                ₱ <span id="dp_enrollment">0</span>
                            </td>
                      </tr>
                      <tr>
                            <td style="width:140px">Current Balance</td>
                            <td align="right">
                                ₱ <span id="total_balance">0</span>
                            </td>
                      </tr>
                      
                  </tr>
              </tbody>

            </table>
            <div class="box-footer col-lg-12">
              
              <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
              <button type="button" disabled id="btn-enroll" class="btn btn-primary pull-right">Enroll</button>
            </div>
            @include('control_panel_student.enrollment.partials.modal_paypal')
          </form>
        </div>
      </div>
</div>