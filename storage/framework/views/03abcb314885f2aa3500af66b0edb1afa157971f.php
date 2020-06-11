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
                Account Name: ST. John Academy<br/>
                Account Number: 205370002058
            </li>
            <li>
                Chinabank Dinalupihan Branch<br/>
                Account Name: Saint John’s Academy Inc.<br/>
                Account Number: 167600000464
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
            <?php echo e(csrf_field()); ?>

            <div class="col-md-6">    
                <div class="box-header with-border">
                    <h3 class="box-title">Enrollment Form </h3>
                </div>      
                    <input type="hidden" name="payment-cat" value="over the counter - bank">
                    <div class="form-group col-lg-12" style="margin-top: 10px">
                        <h4>
                            <?php echo e($AlreadyEnrolled ? 'You are enrolled to ' : 'You are incoming'); ?> Grade-level <i style="color:red">
                            <?php if($IncomingStudentCount): ?>
                              <?php echo e($IncomingStudentCount->grade_level_id); ?>

                            <?php else: ?>
                              <?php echo e($ClassDetail->grade_level+1); ?>

                            <?php endif; ?>
                            </i>
                        </h4>
                        <br/>
                        <label for="exampleInputEmail1">Available Tuition Fee and Misc Fee</label>
                        <?php if($Tuition): ?>
                            <input type="hidden" name="bank_tution" id="bank_tution" value="<?php echo e($Tuition ? $sum_total_item : ''); ?>">
                            <input type="hidden" name="bank_tution_amt" value="<?php echo e($PaymentCategory->id); ?>">
                            <p>
                                Tuition Fee (<?php echo e(number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')); ?>) | Miscellenous Fee (<?php echo e(number_format($PaymentCategory->misc_fee->misc_amt,2)); ?>)
                            </p>

                            <?php if($hasOtherfee->other_fee_id != ''): ?>
                                <label for="exampleInputEmail1">Other(s) Fee</label>
                                <input type="hidden" name="other_id" value="<?php echo e($PaymentCategory->other_fee->id); ?>">
                                <input type="hidden" name="other_name" value="<?php echo e($PaymentCategory->other_fee->other_fee_name); ?>">
                                <input type="hidden" name="other_price" value="<?php echo e($PaymentCategory->other_fee->other_fee_amt); ?>">
                                <p><?php echo e($PaymentCategory->other_fee->other_fee_name); ?> - (₱ <?php echo e(number_format($PaymentCategory->other_fee->other_fee_amt, 2)); ?>)</p>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <p>There is no Tution and Miscellenous Fee</p>
                        <?php endif; ?>  
                        
                        <label for="e_discount">Discount Fee</label>
                        <div class="checkbox" style="margin-top: -2.5px;">
                            <?php $__currentLoopData = $Discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                                <label>                      
                                <?php 
                                    $hasAlreadyDiscount = \App\TransactionDiscount::where('student_id', $StudentInformation->id)
                                        ->where('school_year_id', $SchoolYear->id)->where('discount_type', $item->disc_type)
                                        ->where('isSuccess', 1)
                                        ->first();
                                ?>
                                <input type="checkbox" <?php echo e($hasAlreadyDiscount ? 'disabled' : ''); ?> class="discountBankSelected" name="discount_bank[]" value="<?php echo e($item->id); ?>"
                                    data-type="<?php echo e($item->disc_type); ?>" 
                                    data-fee="<?php echo e($item->disc_amt); ?>">
                                    <span style="<?php echo e($hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : ''); ?>"><?php echo e($item->disc_type); ?> (<?php echo e(number_format($item->disc_amt, 2)); ?>) <b> </span></b>
                                </label> 
                                &nbsp;&nbsp;               
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if(!$AlreadyEnrolled): ?>
                            <div class="bank-downpayment">                
                                <label for="">Downpayment Fee</label>                   
                                <div class="radio check-downpayment" style="margin-top: -2.5px;">
                                    <?php $__currentLoopData = $Downpayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                                        <label>                      
                                        <input type="radio" class="downpaymentBankSelected" name="downpayment[]" value="<?php echo e($item->id); ?>"
                                            data-modified="<?php echo e($item->modified); ?>" 
                                            data-fee="<?php echo e($item->downpayment_amt); ?>">
                                            <?php echo e(number_format($item->downpayment_amt, 2)); ?> <?php echo e($item->modified == 1 ? '- modified' : ''); ?>                           
                                        </label>                       
                                        &nbsp;&nbsp;               
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="help-block text-left" id="js-bank_downpayment"></div>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" class="hasDownpayment" value="0">
                        <?php endif; ?>

                        
                    
                        <label for="previous_balance">Current Balance Fee</label>         
                        <?php if($AlreadyEnrolled): ?>    
                            <input type="hidden" class="form-control" value="<?php echo e($AlreadyEnrolled->balance); ?>" id="bank_previous_balance" name="bank_previous_balance">
                            <p>₱ <?php echo e(number_format($AlreadyEnrolled->balance,2)); ?></p> 
                        <?php else: ?>
                            <?php if($Tuition): ?>
                                <p>₱ <?php echo e(number_format($Tuition ? $sum_total_item : '', 2)); ?></p> 
                            <?php endif; ?>       
                        <?php endif; ?>  
                    </div>  

                    <div class="form-group col-lg-12 input-bank_phone">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="bank_phone" name="bank_phone" placeholder="+639000000000" value="<?php echo e($StudentInformation->contact_number ? $StudentInformation->contact_number : '+639'); ?>">
                        <div class="help-block text-left" id="js-bank_phone"></div>
                    </div>  

                    <div class="form-group col-lg-12 input-bank_email">
                        <label for="bank_email">Email Address</label>
                        <input type="email" class="form-control" id="bank_email" name="bank_email" placeholder="your@email.com" value="<?php echo e($StudentInformation->email); ?>">
                        <div class="help-block text-left" id="js-bank_email"></div>
                    </div>    
                
                
            </div>
            <div class="col-md-6">        
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload with Bank</h3>
                        <a style="margin-top: -10px" class="btn btn-sm btn-info pull-right btn-transaction-history" 
                            data-id="<?php echo e($StudentInformation->id); ?>"
                            data-school_year_id="<?php echo e($SchoolYear->id); ?>"
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
                        <input type="number" class="form-control" id="bank_pay_fee" name="bank_pay_fee" placeholder="0.00">
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
                        <button type="submit" disabled class="btn-bank-enroll btn btn-primary pull-right"><?php echo e($AlreadyEnrolled ? 'Pay ' : 'Enroll'); ?></button>
                    </div>                         
            </div>
        </form>   
    </div>
</div>