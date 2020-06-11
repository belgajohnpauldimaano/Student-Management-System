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
  <?php echo e(csrf_field()); ?>

<div class="col-md-6">
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title col-lg-12">Online Enrollment Form</h3>
        </div>        
          <div class="box-body">
            <div class="form-group col-lg-12">
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
                  <input type="hidden" value="0" class="checkTution">
                  <input type="hidden" class="form-control" value="<?php echo e($PaymentCategory->id); ?>" name="tution_category">                  
                  <input type="hidden" id="total_tuition" name="total_tuition" value="<?php echo e($Tuition ? $sum_total_item : ''); ?>">
                  <input type="hidden" id="total_misc" name="total_misc" value="<?php echo e($PaymentCategory->misc_fee->misc_amt); ?>">
                  <input type="hidden" class="form-control" name="description_name" value="SJAI <?php echo e($IncomingStudentCount ? $IncomingStudentCount->grade_level_id : $ClassDetail->grade_level+1); ?>

                   Tuition Fee (<?php echo e(number_format($PaymentCategory->tuition->tuition_amt, 2)); ?>) | Miscellaneous Fee (<?php echo e(number_format($PaymentCategory->misc_fee->misc_amt,2)); ?>) 
                   | Other(s) <?php echo e($hasOtherfee->other_fee_id ? $hasOtherfee->other_fee_id != '' ? $PaymentCategory->other_fee->other_fee_name : 'N/A' : ''); ?> - (₱ <?php echo e($hasOtherfee->other_fee_id ? $hasOtherfee->other_fee_id != '' ? $PaymentCategory->other_fee->other_fee_amt : '' : ''); ?>)" name="tution_category">
                  <p>Tuition Fee (₱ <?php echo e(number_format($PaymentCategory->tuition->tuition_amt, 2)); ?>) | Miscellaneous Fee (₱ <?php echo e(number_format($PaymentCategory->misc_fee->misc_amt,2)); ?>)</p>
                  
                  <?php if($hasOtherfee->other_fee_id != ''): ?>
                    <label for="exampleInputEmail1">Other(s) Fee</label>
                    <input type="hidden" name="other_id" value="<?php echo e($PaymentCategory->other_fee->id); ?>">
                    <input type="hidden" name="other_name" value="<?php echo e($PaymentCategory->other_fee->other_fee_name); ?>">
                    <input type="hidden" name="other_price" value="<?php echo e($PaymentCategory->other_fee->other_fee_amt); ?>">
                    <p><?php echo e($PaymentCategory->other_fee->other_fee_name); ?> - (₱ <?php echo e(number_format($PaymentCategory->other_fee->other_fee_amt, 2)); ?>)</p>
                  <?php endif; ?>
                <?php else: ?>
                  <input type="hidden" value="1" class="checkTution">
                  <p>There is no Tution and Miscellaneous Fee</p>
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
                        <input type="checkbox" <?php echo e($hasAlreadyDiscount ? 'disabled' : ''); ?> class="discountSelected" name="discount[]" value="<?php echo e($item->id); ?>"
                          data-type="<?php echo e($item->disc_type); ?>" 
                          data-fee="<?php echo e($item->disc_amt); ?>">
                          <span style="<?php echo e($hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : ''); ?>"><?php echo e($item->disc_type); ?> (<?php echo e(number_format($item->disc_amt, 2)); ?>) <b></span> </b>
                      </label> 
                      &nbsp;&nbsp;        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                <?php if(!$AlreadyEnrolled): ?>
                  <div class="check-downpayment">                
                    <label for="">Downpayment Fee</label>                   
                    <div class="radio check-downpayment" style="margin-top: -2.5px;">
                    <?php $__currentLoopData = $Downpayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                      <label>                      
                        <input type="radio" class="downpaymentSelected" name="downpayment[]" value="<?php echo e($item->id); ?>"
                          data-modified="<?php echo e($item->modified); ?>" 
                          data-fee="<?php echo e($item->downpayment_amt); ?>">
                          <?php echo e(number_format($item->downpayment_amt, 2)); ?> <?php echo e($item->modified == 1 ? '- modified' : ''); ?>                           
                      </label>                       
                      &nbsp;&nbsp;               
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="help-block text-left js-downpayment" id="js-downpayment"></div>
                    </div>
                  </div>
                <?php else: ?>
                  <input type="hidden" class="hasDownpayment" value="0">
                <?php endif; ?>

                
                <label for="previous_balance">Current Balance Fee</label>         
                <?php if($AlreadyEnrolled): ?>    
                  <input type="hidden" class="form-control" value="<?php echo e($AlreadyEnrolled->balance); ?>" id="previous_balance" name="previous_balance">
                  <p>₱ <?php echo e(number_format($AlreadyEnrolled->balance,2)); ?></p> 
                <?php else: ?>
                  <?php if($Tuition): ?>                  
                    <p>₱ <?php echo e(number_format($Tuition ? $sum_total_item : '', 2)); ?></p> 
                  <?php endif; ?>      
                <?php endif; ?>               
            
            </div>    

          <div class="form-group col-lg-12 input-payment">
              <label for="pay_fee">Enter your payment fee</label>
              <?php if($Downpayment): ?>
              <input type="number" class="form-control" id="pay_fee" name="pay_fee" 
                placeholder="">
              <div class="help-block text-left" id="js-pay_fee"></div>
              <?php else: ?>
                <p>There is no downpayment amt yet</p>
              <?php endif; ?>
          </div>            
           
            <div class="form-group col-lg-12 input-phone">
                <label for="phone">Phone number</label>
                <input type="text" class="form-control" id="phone" name="phone" 
                placeholder="+639000000000" value="<?php echo e($StudentInformation->contact_number ? $StudentInformation->contact_number : '+639'); ?>">
                <div class="help-block text-left" id="js-number"></div>
            </div>  
            <div class="form-group col-lg-12 input-email">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="<?php echo e($StudentInformation->email); ?>">
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
            data-id="<?php echo e($StudentInformation->id); ?>" 
            data-school_year_id="<?php echo e($SchoolYear->id); ?>" 
            href="#">
            <i class="fas fa-history"></i> Transaction History
          </a>
        </div>
        <div class="box-body">                  
            <table class="table  table-invoice table-striped">
              <tbody>
                  <tr>           
                    <?php if(!$AlreadyEnrolled): ?>            
                      <tr>
                          <td style="width:120px">Tuition Fee</td>
                          <td align="right" id="tuition_fee"> 
                            <?php if($Tuition): ?>                             
                            ₱ <?php echo e(number_format($PaymentCategory->tuition->tuition_amt, 2)); ?>

                            <?php else: ?>
                              <p>There is no Tution Fee yet</p>
                            <?php endif; ?>
                          </td>
                      </tr>
                      <tr>
                          <td style="width:120px">Misc Fee</td>
                          <td align="right" id="misc_fee">
                            <?php if($Tuition): ?>
                            ₱ <?php echo e(number_format($PaymentCategory->misc_fee->misc_amt,2)); ?>

                            <?php else: ?>
                              <p>There is no Miscellaneous Fee yet</p>
                            <?php endif; ?>
                          </td>
                      </tr>
                      <tr>
                        <td style="width:120px">Other(s) Fee</td>
                        <td align="right" id="misc_fee">
                          <?php if($Tuition): ?>
                            <?php if($hasOtherfee->other_fee_id != NULL): ?>
                            ₱ <?php echo e(number_format($PaymentCategory->other_fee->other_fee_amt,2)); ?>

                            <?php else: ?>
                              <p>There is no other Fee yet</p>
                            <?php endif; ?>
                          <?php else: ?>
                            <p>There is no other Fee yet</p>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <tr >
                        <td style="width:120px">Discount</td>
                        <td  align="right" id="disc_amt"> 
                          <?php if($TransactionDiscount): ?>
                            <?php $__currentLoopData = $TransactionDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6"><?php echo e($item->discount_type); ?></div>
                                <div class="col-md-6" align="right"  style="padding-right: 0">₱ <?php echo e(number_format($item->discount_amt,2)); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <span id="disc_amt">
                            </span>
                          <?php else: ?>
                          <span id="disc_amt">
                            ₱ 0
                          </span>
                          <?php endif; ?>
                        </td>
                      </tr>                    
                     <tr>
                        <td style="width:120px">Total Fees</td>
                        <td align="right" id="total_fee">
                          ₱ <?php echo e($Tuition ? number_format($sum_total_item,2) : ''); ?>

                        </td>
                      </tr>
                      <?php endif; ?>
                      <tr>
                        <td style="width:120px">Previous Balance</td>
                        <td align="right" id="misc_fee">
                          <?php if($AlreadyEnrolled): ?>    
                           <p>₱ <?php echo e(number_format($AlreadyEnrolled->balance,2)); ?></p> 
                          <?php else: ?>
                            <?php if($Tuition): ?>
                              <p>₱ <?php echo e(number_format($sum_total_item, 2)); ?></p>
                            <?php else: ?>
                              <p>There is no Tution and Miscellaneous fee yet</p>
                            <?php endif; ?>
                          <?php endif; ?>
                        </td>
                      </tr>                     
                      <tr>
                          <td style="width:120px">Payment</td>
                          <td align="right">
                              ₱ <span id="dp_enrollment">0</span>
                          </td>
                      </tr>
                      <tr>
                        <td style="width:200px">Online Payment Charge</td>
                        <td align="right">
                          <input type="hidden" id="result_payment_charge" name="payment_charge">
                            ₱ <span id="payment_charge">0</span>
                        </td>
                      </tr>
                      <tr>
                        <td style="width:200px">Total Payment Charge</td>
                        <td align="right">
                          <input type="hidden" id="result_total_payment_charge" name="total_payment_charge">
                            ₱ <span id="total_payment_charge">0</span>
                        </td>
                      </tr>                 
                      <tr>
                          <td style="width:120px">Current Balance</td>
                          <td align="right">
                            <input type="hidden" id="result_current_bal" name="result_current_bal">
                              ₱ <span id="current_balance">0</span>
                          </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <i style="color: red">Note: flexible bank charges may be applied accordingly ex. total amount * 3.9% + 15</i>
                        </td>
                      </tr>
                                             
                  </tr>
              </tbody>
            </table>

            
            
            <div class="box-footer col-lg-12">              
              <button type="button" class="btn-reset btn btn-danger pull-left">Reset</button>
              <button type="submit" disabled id="btn-enroll" class="btn btn-primary pull-right">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <?php echo e($AlreadyEnrolled ? 'Pay ' : 'Enroll'); ?>

              </button>
            </div>
            
          
          <div>
            
          </div>
          <img class="img-responsive pull-right" width="210" src="https://logodix.com/logo/244356.png" alt=" img-full">
        </div>
        
      </div>
</div>
</form>