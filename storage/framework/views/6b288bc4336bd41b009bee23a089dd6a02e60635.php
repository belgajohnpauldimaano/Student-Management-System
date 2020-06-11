<div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fas fa-history"></i> Transaction History</h4>
            </div>
            <div class="modal-body" style="background-color: #ecf0f5;">
                <?php if($hasTransaction): ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                                Account Payment
                            </h3>   
                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th width="50%">Description</th>
                                        <th width="50%">Amount</th>
                                    </tr>
                                    <tr>
                                        <td>Tuition Fee</td>
                                        <td>
                                            ₱ <?php echo e(number_format($Transaction_history[0]->payment_cat->tuition->tuition_amt, 2)); ?>

                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>Miscellaneous Fee</td>
                                        <td>
                                            ₱ <?php echo e(number_format($Transaction_history[0]->payment_cat->misc_fee->misc_amt, 2)); ?>

                                        </td>                                        
                                    </tr>
                                    <?php $__currentLoopData = $OtherFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>Other(s) Fee <?php echo e($item->other_name ? '-' : ''); ?> <?php echo e($item->other_name); ?></td>
                                        <td>
                                            ₱ <?php echo e(number_format($item->item_price, 2)); ?> 
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php $__currentLoopData = $Discount_amt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item ? $item->discount_type : ''); ?> Discount Fee</td>
                                            <td>
                                                ₱   <?php echo e($item ? number_format($item->discount_amt,2) : '--NA--'); ?> 
                                            </td>                                        
                                        </tr> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                                    <tr>
                                        <td>Total Fees</td>
                                        <td>
                                            <?php if($Discount): ?>
                                                ₱ <?php echo e(number_format($tuition_misc_fee, 2)); ?>

                                            <?php else: ?>
                                                ₱ <?php echo e(number_format($tuition_misc_fee, 2)); ?>

                                            <?php endif; ?>
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td>
                                        <td>
                                            <span class="label label-<?php echo e($Transaction_history[0]->status=='1' ? 'danger': 'success'); ?>">
                                                <?php echo e($Transaction_history[0]->status=='1' ? 'Not yet Paid': 'Paid'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div> 
                    
                    <h4>History</h4>
                    <?php $__currentLoopData = $Transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="box">
                            <div class="box-header">
                                <p style="font-weight: bold">
                                    Payment Option - <?php echo e($transaction->payment_option); ?>

                                </p>
                                <p style="color: #008fef">Date and Time: <?php echo e($transaction ? date_format(date_create($transaction->created_at), 'F d, Y h:i A') : ''); ?></p>   
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th width="50%">Description</th>
                                            <th width="50%">Amount</th>
                                        </tr>
                                        <tr>
                                            <td>Payment</td>
                                            <td>
                                                ₱ <?php echo e(number_format($transaction->payment, 2)); ?>

                                            </td>                                        
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td>
                                                ₱ <?php echo e(number_format($transaction->balance, 2)); ?>

                                            </td>                                        
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <span class="label label-<?php echo e($transaction->approval=='Approved' ? 'success': 'danger'); ?>"><?php echo e($transaction->approval); ?></span>
                                            </td>                                        
                                        </tr>
                                        <div class="lightbox-target" id="img_receipt<?php echo e($transaction->receipt_img); ?>">
                                            <img src="<?php echo e($transaction->receipt_img ? \File::exists(public_path('/img/receipt/'.$transaction->receipt_img)) ?
                                                asset('/img/receipt/'.$transaction->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                                asset('/img/receipt/blank-user.gif')); ?>"/>
                                            <a class="lightbox-close" href="#"></a>
                                        </div>
                                        
                                        <?php if($transaction->payment_option != 'Credit Card/Debit Card'): ?>
                                            <div class="form-group" style="padding: 10px">
                                                <label for="">Image Receipt <small>(Click to zoom)</small></label>
                                                <a class="lightbox" href="#img_receipt<?php echo e($transaction->receipt_img); ?>">
                                                    <img class="img-responsive" 
                                                    id="img-receipt"
                                                    src="<?php echo e($transaction->receipt_img ? \File::exists(public_path('/img/receipt/'.$transaction->receipt_img)) ?
                                                    asset('/img/receipt/'.$transaction->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                                    asset('/img/receipt/blank-user.gif')); ?>" 
                                                    alt="User profile picture">
                                                </a>
                                            </div> 
                                        <?php endif; ?>
                                    </tbody>
                                    
                                </table>
                            </div>
                            
                        </div>                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                <?php else: ?>
                    <p style="font-weight: bold"><i class="fas fa-ban"></i> No Transaction yet</p>
                <?php endif; ?>       
           
        </div>
        <!-- /.modal-content -->
        <div class="modal-footer" style="background-color: #fff;">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->