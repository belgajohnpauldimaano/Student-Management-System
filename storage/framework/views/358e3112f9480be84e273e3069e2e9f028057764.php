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
                St. John’s Academy Inc C/O Anrea Pangilinan – 0945-836-4135
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
            <?php echo e(csrf_field()); ?> 
            <div class="col-md-6">    
                <div class="box-header with-border">
                    <h3 class="box-title col-lg-12">Enrollment Form </h3>
                </div>
                    
                    <input type="hidden" name="payment-cat" value="Transfer - Gcash">
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
                            <input type="hidden" name="gcash_tution_amt" value="<?php echo e($PaymentCategory->id); ?>">
                            <input type="hidden" name="gcash_tution_total" id="gcash_tution_total" value="<?php echo e($Tuition ? $sum_total_item : ''); ?>">
                            <p>
                                Tuition Fee (<?php echo e(number_format($PaymentCategory->tuition->tuition_amt, 2 ?? '')); ?>) | Miscellenous Fee (<?php echo e(number_format($PaymentCategory->misc_fee->misc_amt,2)); ?>)
                            </p>
                            <?php if($hasOtherfee->other_fee_id != ''): ?>
                                <label for="exampleInputEmail1">Other(s) Fee</label>
                                <?php if($hasOtherfee->other_fee_id != ''): ?>
                                <input type="hidden" name="other_id" value="<?php echo e($PaymentCategory->other_fee->id); ?>">
                                <input type="hidden" name="other_name" value="<?php echo e($PaymentCategory->other_fee->other_fee_name); ?>">
                                <input type="hidden" name="other_price" value="<?php echo e($PaymentCategory->other_fee->other_fee_amt); ?>">
                                <p><?php echo e($PaymentCategory->other_fee->other_fee_name); ?> - (₱ <?php echo e(number_format($PaymentCategory->other_fee->other_fee_amt, 2)); ?>)</p>
                                <?php endif; ?>
                            <?php endif; ?>
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
                                <input type="checkbox" <?php echo e($hasAlreadyDiscount ? 'disabled' : ''); ?> class="discountGcashSelected" name="discount_bank[]" value="<?php echo e($item->id); ?>"
                                    data-type="<?php echo e($item->disc_type); ?>" 
                                    data-fee="<?php echo e($item->disc_amt); ?>">
                                    <span style="<?php echo e($hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : ''); ?>"><?php echo e($item->disc_type); ?> (<?php echo e(number_format($item->disc_amt, 2)); ?>) <b> </span></b>
                                </label> 
                                &nbsp;&nbsp;               
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if(!$AlreadyEnrolled): ?>
                            <div class="gcash-downpayment">                
                            <label for="">Downpayment Fee</label>                   
                            <div class="radio" style="margin-top: -2.5px;">
                            <?php $__currentLoopData = $Downpayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                                <label>                      
                                <input type="radio" class="downpaymentgSelected" name="downpayment[]" value="<?php echo e($item->id); ?>"
                                    data-modified="<?php echo e($item->modified); ?>" 
                                    data-fee="<?php echo e($item->downpayment_amt); ?>">
                                    <?php echo e(number_format($item->downpayment_amt, 2)); ?> <?php echo e($item->modified == 1 ? '- modified' : ''); ?>                           
                                </label>                       
                                &nbsp;&nbsp;               
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="help-block text-left" id="js-gcash_downpayment"></div>
                            </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" class="hasDownpayment" value="0">
                        <?php endif; ?>

                        <label for="previous_balance">Current Balance Fee</label>  
                        <?php if($AlreadyEnrolled): ?>    
                            <input type="hidden" class="form-control" value="<?php echo e($AlreadyEnrolled->balance); ?>" id="gcash_previous_balance" name="gcash_previous_balance">
                            <p>₱ <?php echo e(number_format($AlreadyEnrolled->balance,2)); ?></p> 
                        <?php else: ?>
                            <?php if($Tuition): ?>
                                <p>₱ <?php echo e(number_format($Tuition ? $sum_total_item : '', 2)); ?></p> 
                            <?php endif; ?>      
                        <?php endif; ?>            

                    </div>

                    <div class="form-group col-lg-12 input-gcash_phone">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="gcash_phone" name="gcash_phone" placeholder="+639000000000" value="<?php echo e($StudentInformation->contact_number ? $StudentInformation->contact_number : '+639'); ?>">
                        <div class="help-block text-left" id="js-gcash_phone"></div>
                    </div>  
                    <div class="form-group col-lg-12 input-gcash_email">
                        <label for="gcash_email">Email Address</label>
                        <input type="email" class="form-control" id="gcash_email" name="gcash_email" placeholder="your@email.com" value="<?php echo e($StudentInformation->email); ?>">
                        <div class="help-block text-left" id="js-gcash_email"></div>
                    </div>                        
                
                
            </div>
            <div class="col-md-6">        
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload with Gcash</h3>
                        <a class="btn btn-sm btn-info pull-right btn-transaction-history" 
                            data-id="<?php echo e($StudentInformation->id); ?>" 
                            data-school_year_id="<?php echo e($SchoolYear->id); ?>" 
                            href="#" style="margin-top: -10px">
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
                        <input type="checkbox" id="gcash_terms">I have read and Agree the <a href="">Terms of service</a>
                        </label>
                    </div>
                    <div class="box-footer col-lg-12">
                        <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
                        <button type="submit" disabled class="btn-gcash-enroll btn btn-primary pull-right"><?php echo e($AlreadyEnrolled ? 'Pay ' : 'Enroll'); ?></button>
                    </div>
            </div>
        </form>
    </div>
</div>