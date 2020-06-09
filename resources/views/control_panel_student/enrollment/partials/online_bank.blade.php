<div style="padding:0 16px 0 16px">
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
<div class="col-md-6">
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-lg-12">Online Enrollment Form</h3>
        </div>        
          <div class="box-body">
            <div class="form-group col-lg-12">
                <h4>
                  {{$AlreadyEnrolled ? 'You are enrolled to ' : 'You are incoming' }} Grade-level <i style="color:red">
                  @if($IncomingStudentCount)
                    {{$IncomingStudentCount->grade_level_id}}
                  @else
                    {{$ClassDetail->grade_level+1}}
                  @endif
                  </i>
                </h4>
                <br/>
                <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                
                @if($Tuition)
                  <input type="hidden" value="0" class="checkTution">
                  <input type="hidden" class="form-control" value="{{$PaymentCategory->id}}" name="tution_category">                  
                  <input type="hidden" id="total_tuition" name="total_tuition" value="{{$Tuition ? $sum_total_item : ''}}">
                  <input type="hidden" id="total_misc" name="total_misc" value="{{$PaymentCategory->misc_fee->misc_amt}}">
                  <input type="hidden" class="form-control" name="description_name" value="SJAI {{$IncomingStudentCount ? $IncomingStudentCount->grade_level_id : $ClassDetail->grade_level+1 }}
                   Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2) }}) | Miscellaneous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}}) 
                   | Other(s) {{$hasOtherfee->other_fee_id ? $hasOtherfee->other_fee_id != '' ? $PaymentCategory->other_fee->other_fee_name : 'N/A' : ''}} - (₱ {{$hasOtherfee->other_fee_id ? $hasOtherfee->other_fee_id != '' ? $PaymentCategory->other_fee->other_fee_amt : '' : '' }})" name="tution_category">
                  <p>Tuition Fee (₱ {{number_format($PaymentCategory->tuition->tuition_amt, 2) }}) | Miscellaneous Fee (₱ {{number_format($PaymentCategory->misc_fee->misc_amt,2)}})</p>
                  
                  @if($hasOtherfee->other_fee_id != '')
                    <label for="exampleInputEmail1">Other(s) Fee</label>
                    <input type="hidden" name="other_id" value="{{$PaymentCategory->other_fee->id}}">
                    <input type="hidden" name="other_name" value="{{$PaymentCategory->other_fee->other_fee_name}}">
                    <input type="hidden" name="other_price" value="{{$PaymentCategory->other_fee->other_fee_amt}}">
                    <p>{{$PaymentCategory->other_fee->other_fee_name}} - (₱ {{number_format($PaymentCategory->other_fee->other_fee_amt, 2) }})</p>
                  @endif
                @else
                  <input type="hidden" value="1" class="checkTution">
                  <p>There is no Tution and Miscellaneous Fee</p>
                @endif
                
                          
                  <label for="e_discount">Discount Fee</label>
                  <div class="checkbox" style="margin-top: -2.5px;">
                    @foreach ($Discount as $item)                
                      <label>                      
                        <?php 
                          $hasAlreadyDiscount = \App\TransactionDiscount::where('student_id', $StudentInformation->id)
                            ->where('school_year_id', $SchoolYear->id)->where('discount_type', $item->disc_type)
                            ->where('isSuccess', 1)
                            ->first();
                        ?>
                        <input type="checkbox" {{$hasAlreadyDiscount ? 'disabled' : ''  }} class="discountSelected" name="discount[]" value="{{$item->id}}"
                          data-type="{{$item->disc_type}}" 
                          data-fee="{{$item->disc_amt}}">
                          <span style="{{$hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : ''  }}">{{$item->disc_type}} ({{number_format($item->disc_amt, 2)}}) <b></span> </b>
                      </label> 
                      &nbsp;&nbsp;        
                    @endforeach
                  </div>

                @if(!$AlreadyEnrolled)
                  <div class="check-downpayment">                
                    <label for="">Downpayment Fee</label>                   
                    <div class="radio check-downpayment" style="margin-top: -2.5px;">
                    @foreach ($Downpayment as $item)                
                      <label>                      
                        <input type="radio" class="downpaymentSelected" name="downpayment[]" value="{{$item->id}}"
                          data-modified="{{$item->modified}}" 
                          data-fee="{{$item->downpayment_amt}}">
                          {{number_format($item->downpayment_amt, 2)}} {{$item->modified == 1 ? '- modified' : ''}}                           
                      </label>                       
                      &nbsp;&nbsp;               
                    @endforeach
                    <div class="help-block text-left js-downpayment" id="js-downpayment"></div>
                    </div>
                  </div>
                @else
                  <input type="hidden" class="hasDownpayment" value="0">
                @endif

                
                <label for="previous_balance">Current Balance Fee</label>         
                @if($AlreadyEnrolled)    
                  <input type="hidden" class="form-control" value="{{$AlreadyEnrolled->balance}}" id="previous_balance" name="previous_balance">
                  <p>₱ {{number_format($AlreadyEnrolled->balance,2)}}</p> 
                @else
                  @if($Tuition)                  
                    <p>₱ {{number_format($Tuition ? $PaymentCategory->tuition->tuition_amt + $PaymentCategory->misc_fee->misc_amt : '', 2)}}</p> 
                  @endif      
                @endif               
            
            </div>    

          <div class="form-group col-lg-12 input-payment">
              <label for="pay_fee">Enter your payment fee</label>
              @if($Downpayment)
              <input type="number" class="form-control" id="pay_fee" name="pay_fee" 
                placeholder="">
              <div class="help-block text-left" id="js-pay_fee"></div>
              @else
                <p>There is no downpayment amt yet</p>
              @endif
          </div>            
           
            <div class="form-group col-lg-12 input-phone">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" id="phone" name="phone" 
                placeholder="+639000000000" value="{{ $StudentInformation->contact_number ? $StudentInformation->contact_number : '+639' }}">
                <div class="help-block text-left" id="js-number"></div>
            </div>  
            <div class="form-group col-lg-12 input-email">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="{{ $StudentInformation->email }}">
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
          <h3 class="box-title">
            Transaction Summary
          </h3> 

          <a class="btn btn-sm btn-info pull-right btn-transaction-history" 
            data-id="{{$StudentInformation->id}}" 
            data-school_year_id="{{$SchoolYear->id}}" 
            href="#">
            <i class="fas fa-history"></i> Transaction History
          </a>
        </div>
        <div class="box-body">                  
            <table class="table  table-invoice table-striped">
              <tbody>
                  <tr>           
                    @if(!$AlreadyEnrolled)            
                      <tr>
                          <td style="width:120px">Tuition Fee</td>
                          <td align="right" id="tuition_fee"> 
                            @if($Tuition)                             
                            ₱ {{number_format($PaymentCategory->tuition->tuition_amt, 2)}}
                            @else
                              <p>There is no Tution Fee yet</p>
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td style="width:120px">Misc Fee</td>
                          <td align="right" id="misc_fee">
                            @if($Tuition)
                            ₱ {{number_format($PaymentCategory->misc_fee->misc_amt,2)}}
                            @else
                              <p>There is no Miscellaneous Fee yet</p>
                            @endif
                          </td>
                      </tr>
                      <tr>
                        <td style="width:120px">Other(s) Fee</td>
                        <td align="right" id="misc_fee">
                          @if($Tuition)
                            @if($hasOtherfee->other_fee_id != NULL)
                            ₱ {{number_format($PaymentCategory->other_fee->other_fee_amt,2)}}
                            @else
                              <p>There is no other Fee yet</p>
                            @endif
                          @else
                            <p>There is no other Fee yet</p>
                          @endif
                        </td>
                      </tr>
                      <tr >
                        <td style="width:120px">Discount</td>
                        <td  align="right" id="disc_amt"> 
                          @if($TransactionDiscount)
                            @foreach ($TransactionDiscount as $item)
                                <div class="col-md-6">{{$item->discount_type}}</div>
                                <div class="col-md-6" align="right"  style="padding-right: 0">₱ {{number_format($item->discount_amt,2)}}</div>
                            @endforeach
                            <span id="disc_amt">
                            </span>
                          @else
                          <span id="disc_amt">
                            ₱ 0
                          </span>
                          @endif
                        </td>
                      </tr>                    
                     <tr>
                        <td style="width:120px">Total Fees</td>
                        <td align="right" id="total_fee">
                          ₱ {{$Tuition ? number_format($sum_total_item,2) : ''}}
                        </td>
                      </tr>
                      @endif
                      <tr>
                        <td style="width:120px">Previous Balance</td>
                        <td align="right" id="misc_fee">
                          @if($AlreadyEnrolled)    
                           <p>₱ {{number_format($AlreadyEnrolled->balance,2)}}</p> 
                          @else
                            @if($Tuition)
                              <p>₱ {{number_format($sum_total_item, 2)}}</p>
                            @else
                              <p>There is no Tution and Miscellaneous fee yet</p>
                            @endif
                          @endif
                        </td>
                      </tr>                     
                      <tr>
                          <td style="width:120px">Payment</td>
                          <td align="right">
                              ₱ <span id="dp_enrollment">0</span>
                          </td>
                      </tr>                    
                      <tr>
                          <td style="width:120px">Current Balance</td>
                          <td align="right">
                            <input type="hidden" id="result_current_bal" name="result_current_bal">
                              ₱ <span id="current_balance">0</span>
                          </td>
                      </tr>                      
                  </tr>
              </tbody>
             

            </table>

            
            
            <div class="box-footer col-lg-12">              
              <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
              <button type="submit" disabled id="btn-enroll" class="btn btn-primary pull-right">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> {{$AlreadyEnrolled ? 'Pay ' : 'Enroll' }}
              </button>
            </div>
            {{-- @include('control_panel_student.enrollment.partials.modal_paypal') --}}
          
          <div>
            
          </div>
          <img class="img-responsive pull-right" width="210" src="https://logodix.com/logo/244356.png" alt=" img-full">
        </div>
        
      </div>
</div>
</form>