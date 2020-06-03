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
        <p>GCash Transaction</p>

        <p>Step 1. Using your mobile phone, go to GCash App (if you don’t have the app yet, download it from Playstore for Android and Appstore for iOs). Enter the desired payment in the Saint John’s Academy Incorporated GCash Account:</p>
        <ul>
            <li>
                GCash Account: 	<br>
                Saint John’s Academy Inc. – 0945-836-4135
            </li>
        </ul>
        

        <p>Step 2. After the successful Gcash transaction, fill out all the necessary information below. Take a screenshot of the transaction and upload it on the icon below (upload file)</p>

        <p>Step 3. You will receive a text message and email confirmation once the transaction has been successfully done. </p>

    </div>
    <!-- /.box-body -->
</div>
<div class="box box-primary">
    <div class="box-body">
        <form id="js-gcash-form">  
            {{ csrf_field() }} 
            <div class="col-md-6">    
                <div class="box-header with-border">
                    <h3 class="box-title col-lg-12">Enrollment Form </h3>
                </div>
                    
                    <input type="hidden" name="payment-cat" value="Transfer - Gcash">
                    <div class="form-group col-lg-12" style="margin-top: 10px">
                        <label for="exampleInputEmail1">You are incoming Grade-level <i style="color:red">
                            @if($IncomingStudentCount)
                                {{$IncomingStudentCount->grade_level_id}}
                            @else
                                {{$ClassDetail->grade_level+1}}
                            @endif
                        </i></label>
                            <br><br>
                        <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                        @if($Tuition)
                        <input type="hidden" name="gcash_tution_amt" value="{{$PaymentCategory->id}}">
                        <input type="hidden" name="gcash_tution_total" id="gcash_tution_total" value="{{$PaymentCategory->tuition->tuition_amt + $PaymentCategory->misc_fee->misc_amt}}">
                            <p>
                                Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')}}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                            </p>
                        @endif   
                        
                        <label for="gcash_discount">Discount Fee</label>
                        @if($StudentInformation->isEsc == '1')
                            <input type="hidden" value="{{$Discount->disc_type}}" name="gcash_discount_type">
                            <input type="hidden" id="gcash_discount" value="{{$Discount->disc_amt}}" name="gcash_discount">
                            <p>{{($Discount->disc_type)}} (₱ {{number_format($Discount->disc_amt,2)}})</p>             
                        @else
                            <input type="hidden" id="gcash_discount" value="0" name="gcash_discount">
                            <p>-NA-</p>
                        @endif

                        <label for="exampleInputEmail1">Downpayment Fee </label>              
                        @if($Downpayment)
                            <input type="hidden" name="gcash_downpayment" value="{{$Downpayment->id}}">
                            <input type="hidden" id="gcash_downpayment" value="{{$Downpayment ? $Downpayment->downpayment_amt : ''}}">                        
                            <p>₱ {{ $Downpayment ? number_format($Downpayment->downpayment_amt,2) : ''}}</p>
                        @endif      

                        <label for="previous_balance">Current Balance Fee</label>  
                        @if($AlreadyEnrolled)    
                            <input type="hidden" class="form-control" value="{{$AlreadyEnrolled->balance}}" id="gcash_previous_balance" name="gcash_previous_balance">
                            <p>₱ {{number_format($AlreadyEnrolled->balance,2)}}</p> 
                        @else
                            @if($Tuition)
                                <p>₱ {{number_format($Tuition ? $PaymentCategory->tuition->tuition_amt + $PaymentCategory->misc_fee->misc_amt : '', 2)}}</p> 
                            @endif      
                        @endif            

                    </div>

                    <div class="form-group col-lg-12 input-gcash_phone">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="gcash_phone" name="gcash_phone" placeholder="+639000000000" value="{{ $StudentInformation->contact_number ? $StudentInformation->contact_number : '+639' }}">
                        <div class="help-block text-left" id="js-gcash_phone"></div>
                    </div>  
                    <div class="form-group col-lg-12 input-gcash_email">
                        <label for="gcash_email">Email Address</label>
                        <input type="email" class="form-control" id="gcash_email" name="gcash_email" placeholder="your@email.com" value="{{ $StudentInformation->email }}">
                        <div class="help-block text-left" id="js-gcash_email"></div>
                    </div>                        
                
                {{-- </div> --}}
            </div>
            <div class="col-md-6">        
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload with Gcash</h3>
                        <a class="btn btn-info pull-right btn-transaction-history" 
                            data-id="{{$StudentInformation->id}}" 
                            data-school_year_id="{{$SchoolYear->id}}" 
                            href="#">
                            <i class="fas fa-history"></i> Transaction History
                        </a>
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
                        <input type="number" class="form-control" id="gcash_pay_fee" name="gcash_pay_fee" placeholder=" {{ $Downpayment ? number_format($Downpayment->downpayment_amt,2) : ''}}">
                        <input type="hidden" id="gcash_balance" name="gcash_balance">
                        <div class="help-block text-left" id="js-gcash_pay_fee"></div>
                    </div> 
                    <div class="form-group col-lg-12 input-gcash_image ">
                        <img id="image-receipt-gcash" style="cursor: pointer; padding-top: 20px" src="images/avatar.png" width="200">
                        <br/>
                        <label for="gcash_image">Image of receipt from Gcash transaction</label>
                        <input type="file" id="gcash_image" name="gcash_image" src="" onchange="readImageURLGcash(this);" accept="*/image">
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
            </div>
        </form>
    </div>
</div>