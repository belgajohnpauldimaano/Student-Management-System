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
        <p>Bank transaction</p>
        <p>
            Step 1. Choose one (1) of the following bank that is nearest to you to proceed with the deposit transaction. 
            Saint John’s Academy Incorporated bank accounts are as follows:
        </p>
        <ul>
            <li>
                PNB Dinalupihan Branch<br/>
                Account Name: Saint John’s Academy Inc.<br/>
                Account Number: 0785-89547-458
            </li>
            <li>
                Metrobank Dinalupihan Branch<br/>
                Account Name: Saint John’s Academy Inc.<br/>
                Account Number: 1141-25547-578
            </li>
            <li>
                Chinabank Dinalupihan Branch<br/>
                Account Name: Saint John’s Academy Inc.<br/>
                Account Number: 2564-65549-254
            </li>
            <li>
                Eastwest Bank Dinalupihan Branch<br/>
                Account Name: Saint John’s Academy Inc.<br/>
                Account Number: 6897-245247-6548
            </li>
        </ul>
        <p>
            Step 2. After the successful deposit transaction, fill out all the necessary information below. Take a photo of the deposit slip and upload it on the icon below (upload file)
        </p>
        <p>
            Step 3. You will receive a text message and email confirmation once the transaction has been successfully done.
        </p> 

    </div>
    <!-- /.box-body -->
</div>
<div class="box box-primary">
    <div class="box-body">
        <form id="#js-bank-form" class="js-bank-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-6">    
                <div class="box-header with-border">
                    <h3 class="box-title col-lg-12">Enrollment Form </h3>
                </div>            
                    
                    <input type="hidden" name="payment-cat" value="over the counter - bank">
                    <div class="form-group col-lg-12" style="margin-top: 10px">
                        <label for="exampleInputEmail1">You are incoming Grade-level <i style="color:red">{{$ClassDetail->grade_level+1}}</i></label>
                            <br><br>
                        <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                        @if($Tuition)
                            <input type="hidden" name="bank_tution" id="bank_tution" value="{{ $PaymentCategory->tuition->tuition_amt + $PaymentCategory->misc_fee->misc_amt }}">
                            <input type="hidden" name="bank_tution_amt" value="{{$PaymentCategory->id}}">
                            <p>
                                Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')}}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                            </p>
                        @else
                            <p>There is no Tution and Miscellenous Fee</p>
                        @endif                
                    
                        <label for="previous_balance">Current Balance Fee</label>         
                        @if($AlreadyEnrolled)    
                            <input type="hidden" class="form-control" value="{{$AlreadyEnrolled->balance}}" id="bank_previous_balance" name="bank_previous_balance">
                            <p>₱ {{number_format($AlreadyEnrolled->balance,2)}}</p> 
                        @else
                            @if($Tuition)
                                <p>₱ {{number_format($Tuition ? $PaymentCategory->tuition->tuition_amt + $PaymentCategory->misc_fee->misc_amt : '', 2)}}</p> 
                            @endif       
                        @endif  

                        <label for="exampleInputEmail1">Downpayment Fee </label>              
                        @if($Downpayment)
                            <input type="hidden" name="bank_downpayment" value="{{$Downpayment->id}}">
                            <input type="hidden" id="bank_downpayment" value="{{$Downpayment->downpayment_amt}}">                        
                            <p>₱ {{number_format($Downpayment->downpayment_amt,2)}}</p>
                        @endif

                        <label for="bank_discount">Discount Fee</label>
                        @if($StudentInformation->isEsc == '1')
                            <input type="hidden" value="{{$Discount->id}}" name="bank_discount">
                            <input type="hidden" id="bank_discount" value="{{$Discount->disc_amt}}" name="bank_discount">
                            <p>{{($Discount->disc_type)}} (₱ {{number_format($Discount->disc_amt,2)}})</p>             
                        @else
                            <p>-NA-</p>
                        @endif
                    </div>  

                    <div class="form-group col-lg-12 input-bank_phone">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="bank_phone" name="bank_phone" placeholder="+639000000000" value="{{ $StudentInformation->contact_number ? $StudentInformation->contact_number : '+639' }}">
                        <div class="help-block text-left" id="js-bank_phone"></div>
                    </div>  
                    <div class="form-group col-lg-12 input-bank_email">
                        <label for="bank_email">Email Address</label>
                        <input type="email" class="form-control" id="bank_email" name="bank_email" placeholder="your@email.com" value="{{ $StudentInformation->email }}">
                        <div class="help-block text-left" id="js-bank_email"></div>
                    </div>    
                
                {{-- </div> --}}
            </div>
            <div class="col-md-6">        
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload with Bank</h3>
                        <a class="btn btn-info pull-right btn-transaction-history" 
                            data-id="{{$StudentInformation->id}}" 
                            data-school_year_id="{{$SchoolYear->id}}" 
                            href="#">
                            <i class="fas fa-history"></i> Transaction History
                        </a>
                    </div>
                    <div class="form-group col-lg-12 input-bank" style="margin-top: 10px">
                        <label for="bank">Bank Name</label>               
                        <select name="bank" id="bank" class="form-control" style="width: 100%;">
                            <option selected value="">--Choose bank--</option> 
                            <option  value="PNB">
                                PNB
                            </option>   
                            <option  value="East West">
                                East West
                            </option>
                            <option  value="Metrobank">
                                Metrobank
                            </option>
                            <option  value="Chinabank">
                                Chinabank
                            </option> 
                        </select>       
                        <div class="help-block text-left" id="js-bank"></div>        
                    </div>    
            
                    <div class="form-group col-lg-12 input-bank_transaction_id">
                        <label for="bank_transaction_id">Transaction Number</label>
                        <input type="number" class="form-control" id="bank_transaction_id" name="bank_transaction_id" placeholder="">
                        <div class="help-block text-left" id="js-bank_transaction_id"></div>
                    </div>
                    
                    <div class="form-group col-lg-12 input-bank_pay_fee">
                        <label for="bank_pay_fee">Enter your payment fee</label>
                        <input type="number" class="form-control" id="bank_pay_fee" name="bank_pay_fee" placeholder=" {{number_format($Downpayment->downpayment_amt,2)}}">
                        <input type="hidden" id="bank_balance" name="bank_balance">
                        <div class="help-block text-left" id="js-bank_pay_fee"></div>
                    </div> 
                    <div class="form-group col-lg-12 input-bank_image ">
                        <img id="image-receipt" style="cursor: pointer; padding-top: 20px" src="images/avatar.png" width="200">
                        <br/>
                        <label for="bank_image">Image of receipt deposit slip</label>                        
                        <input type="file" id="bank_image" name="bank_image" src="" onchange="readImageURL(this);" accept="*/image">
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
            </div>
        </form>   
    </div>
</div>