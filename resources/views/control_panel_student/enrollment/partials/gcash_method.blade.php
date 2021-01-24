<div class="card card-success collapsed-card">
  <div class="card-header">
    <h3 class="card-title">Instructions</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-3">
        <p>GCash Transaction</p>

        <p><b>Step 1.</b> Using your mobile phone, go to GCash App (if you don’t have the app yet, download it from Playstore for Android and Appstore for iOs). Enter the desired payment in the Saint John’s Academy Incorporated GCash Account:</p>
        <ul>
            <li>
                <b>
                    GCash Account: 	<br/>
                    St. John’s Academy Inc. / Anrea Pangilinan<br/>
                    09458364135
                </b>
            </li>
        </ul>

        <p>
            <b>Step 2.</b> After the successful GCash transaction, fill out all the necessary information below. Take a screenshot of the transaction and upload it on the icon below (upload file).
        </p>

        <p>
            <b>Step 3.</b> You will receive an email confirmation once the transaction has been successfully done. 
        </p>

  </div>
  <!-- /.card-body -->
</div>
<div class="">
    <h2 class="{{$isPaid ? $isPaid ? 'overlay-paid' : '' : ''}}">
        {{$isPaid ? $isPaid ? 'PAID' : '' : ''}}
    </h2>
            
    <form id="#js-bank-form" class="js-bank-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">    
                <div class="card card-default" style="height: 550px;">
                    <div class="card-header" style="height: 55px;">
                        <h3 class="card-title">{{$AlreadyEnrolled ? 'Registration' : 'Enrollment' }} Form:</h3>

                        <a class="btn btn-sm btn-info float-right btn-transaction-history " 
                            data-id="{{$StudentInformation->id}}"
                            data-school_year_id="{{$SchoolYear->id}}"
                            href="#">
                            <i class="fas fa-history"></i> Transaction History
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$AlreadyEnrolled ? 'Registration' : 'Enrollment' }} Form </h3>
                            <a class="d-lg-none d-block btn btn-sm btn-info pull-right btn-transaction-history" 
                                data-id="{{$StudentInformation->id}}" 
                                data-school_year_id="{{$SchoolYear->id}}" 
                                href="#" style="margin-top: -10px">
                                <i class="fas fa-history"></i> Transaction History
                            </a>
                        </div>
                            
                        <input type="hidden" name="payment-cat" value="Transfer - Gcash">
                        <div class="form-group col-lg-12" style="margin-top: 10px">
                            <h4>
                                {{$AlreadyEnrolled ? 'You are enrolled to ' : 'You are incoming' }} Grade-level <i style="color:red">
                                @if($IncomingStudentCount)
                                {{$IncomingStudentCount->grade_level_id}}
                                @else
                                {{$ClassDetail->grade_level}}
                                @endif
                                </i>
                            </h4>
                            <br/>
                            <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                            @if($Tuition)
                                <input type="hidden" name="gcash_tution_amt" value="{{$PaymentCategory->id}}">
                                <input type="hidden" name="gcash_tution_total" id="gcash_tution_total" value="{{ $Tuition ? $sum_total_item : '' }}">
                                <p>
                                    Tuition Fee ({{number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')}}) | Miscellenous Fee ({{number_format($PaymentCategory->misc_fee->misc_amt,2)}})
                                </p>
                                @if($hasOtherfee->other_fee_id != '')
                                    <label for="exampleInputEmail1">Other(s) Fee</label>
                                    @if($hasOtherfee->other_fee_id != '')
                                    <input type="hidden" name="other_id" value="{{$PaymentCategory->other_fee->id}}">
                                    <input type="hidden" name="other_name" value="{{$PaymentCategory->other_fee->other_fee_name}}">
                                    <input type="hidden" name="other_price" value="{{$PaymentCategory->other_fee->other_fee_amt}}">
                                    <p>{{$PaymentCategory->other_fee->other_fee_name}} - (₱ {{number_format($PaymentCategory->other_fee->other_fee_amt, 2) }})</p>
                                    @endif
                                @endif
                            @endif   
                                
                            <label for="e_discount">Discount Fee</label>
                            <div class="checkbox" style="margin-top: -2.5px;">
                                @foreach ($Discount as $item)                
                                    <label>                      
                                    <?php 
                                        $hasAlreadyDiscount = \App\Models\TransactionDiscount::where('student_id', $StudentInformation->id)
                                            ->where('school_year_id', $SchoolYear->id)->where('discount_type', $item->disc_type)
                                            ->where('isSuccess', 1)
                                            ->first();
                                    ?>
                                    <input type="checkbox" {{$AlreadyEnrolled ? $hasAlreadyDiscount ? 'disabled' : '' : '' }} class="discountGcashSelected" name="discount_bank[]" value="{{$item->id}}"
                                        data-type="{{$item->disc_type}}" 
                                        data-fee="{{$item->disc_amt}}">
                                        <span style="{{$AlreadyEnrolled ? $hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : '' : '' }}">{{$item->disc_type}} ({{number_format($item->disc_amt, 2)}}) <b> </span></b>
                                    </label> 
                                    &nbsp;&nbsp;               
                                @endforeach
                            </div>

                            @if(!$AlreadyEnrolled)
                                <div class="gcash-downpayment">                
                                <label for="">Downpayment Fee</label>                   
                                <div class="radio" style="margin-top: -2.5px;">
                                @foreach ($Downpayment as $item)                
                                    <label>                      
                                    <input type="radio" class="downpaymentgSelected" name="downpayment[]" value="{{$item->id}}"
                                        data-modified="{{$item->modified}}" 
                                        data-fee="{{$item->downpayment_amt}}">
                                        {{number_format($item->downpayment_amt, 2)}} {{$item->modified == 1 ? '- modified' : ''}}                           
                                    </label>                       
                                    &nbsp;&nbsp;               
                                @endforeach
                                <div class="help-block text-left" id="js-gcash_downpayment"></div>
                                </div>
                                </div>
                            @else
                                <input type="hidden" class="hasDownpayment" value="0">
                            @endif

                            <label for="previous_balance">Current Balance Fee</label>  
                            @if($AlreadyEnrolled)    
                                <input type="hidden" class="form-control" value="{{$AlreadyEnrolled->balance}}" id="gcash_previous_balance" name="gcash_previous_balance">
                                <p>₱ {{number_format($AlreadyEnrolled->balance,2)}}</p> 
                            @else
                                @if($Tuition)
                                    <input type="hidden" class="form-control" value="{{$sum_total_item}}" id="gcash_previous_balance" name="gcash_previous_balance">  
                                    <p>₱ {{number_format($Tuition ? $sum_total_item : '', 2)}}</p> 
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
                    </div>
                    <div class="card-footer">
                        &nbsp;
                        {{-- <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
                        <button type="submit" disabled class="btn-bank-enroll btn btn-primary float-right">Submit</button> --}}
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="card card-default" style="height: 550px;">
                    <div class="card-header" style="height: 55px;">
                        <h3 class="card-title"><i class="fas fa-file-upload"></i> Upload with Gcash</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">                                    
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
                            <input type="text" class="form-control" id="gcash_transaction_id" name="gcash_transaction_id" placeholder="">
                            <div class="help-block text-left" id="js-gcash_transaction_id"></div>
                        </div>
                        
                        <div class="form-group col-lg-12 input-gcash_pay_fee">
                            <label for="gcash_pay_fee">Enter your payment fee</label>
                            <input type="number" class="form-control" id="gcash_pay_fee" name="gcash_pay_fee" placeholder="0.00">
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
                            <input type="checkbox" id="gcash_terms"> I have read and Agree the <a href="">Terms of service</a>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn-reset btn btn-danger float-left">Reset</button>
                        <button type="submit" disabled class="btn-gcash-enroll btn btn-primary float-right">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
 </div>
