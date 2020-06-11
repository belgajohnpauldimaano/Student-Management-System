<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                    <h4 style="margin-right: 5em;" class="modal-title">
                        Student Payment Information
                    </h4>
                </div>
            
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Student Name</label>
                                <p><?php echo e($Modal_data->student->last_name.', '.$Modal_data->student->first_name.' '.$Modal_data->student->middle_name); ?></p>
                            </div> 
        
                            <div class="form-group">
                                <label for="">Student level</label>
                                <p><?php echo e($Modal_data->payment_cat->stud_category->student_category.'-'.$Modal_data->payment_cat->grade_level_id); ?></p>
                            </div>  

                            <div class="form-group">
                                <label for="">Email address</label>
                                <p><?php echo e($Monthly_history->email); ?></p>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label><br/>
                                <span class="label <?php echo e($Monthly_history->approval ? $Monthly_history->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'); ?>">
                                    <?php echo e($Monthly_history->approval); ?>

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Payment option</label>
                                <p><?php echo e($Monthly_history->payment_option); ?></p>
                            </div>  
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <p><?php echo e($Monthly_history->number); ?></p>
                            </div>  
                        </div>
                    </div>
                                        
                    <div class="box">
                        <div class="box-header ">
                            <p class="box-title">
                                Date and Time: <?php echo e($Monthly_history ? date_format(date_create($Monthly_history->created_at), 'F d, Y h:i A') : ''); ?>

                            </p>
                        </div>
                        
                        <div class="box-body no-padding">
                            <table class="table table-bordered table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td>Tuition Fee</td>
                                        <td>
                                            <?php echo e(number_format($Modal_data->payment_cat->tuition->tuition_amt, 2)); ?>

                                        </td>                                
                                    </tr>
                                    <tr>                                        
                                        <td>Misc Fee</td>
                                        <td>
                                            <?php echo e(number_format($Modal_data->payment_cat->misc_fee->misc_amt, 2)); ?>

                                        </td>                                
                                    </tr>   
                                    <tr>
                                        <td>Other Fee <?php echo e($Modal_data->others ? $Modal_data->others->other_name : ''); ?></td>
                                        <td>
                                            <?php 
                                                $others_fee =  0;
                                                if($Modal_data->others){
                                                    $others_fee = $Modal_data->others->item_price;
                                                }    
                                            ?>
                                            <?php echo e(number_format($others_fee, 2)); ?>

                                        </td>
                                    </tr>
                                    <tr>                                        
                                        <td><b>Sub Total</b></td>
                                        <td>
                                            <b>
                                            <?php echo e(number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt + $others_fee, 2)); ?>

                                            </b>
                                        </td>                                
                                    </tr>                                       
                                    <tr>
                                        <td>Less Discount Fee</td>
                                        <td>
                                            <?php 
                                                $discount = \App\TransactionDiscount::where('student_id', $Monthly_history->student_id)
                                                ->where('school_year_id', $Monthly_history->school_year_id)
                                                ->where('isSuccess', 1)
                                                ->sum('discount_amt');
                                                echo number_format($discount, 2);
                                            ?>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td><b>Total Fees</b></td>
                                        <td>
                                            <b>
                                            <?php if($Modal_data->disc_transaction_fee): ?>
                                                <?php echo e(number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt + $others_fee - $discount, 2)); ?>

                                            <?php else: ?>
                                                <?php echo e(number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt + $others_fee, 2)); ?>

                                            <?php endif; ?>
                                            </b>                                                
                                        </td>                                
                                    </tr>                                    
                                    <tr>                                        
                                        <td>Previous Balance</td>
                                        <td>
                                            <?php if($current_bal): ?>
                                                <?php if($current_bal->balance==0): ?>
                                                    wala
                                                    
                                                <?php else: ?>
                                                    <?php 
                                                        $current_bal = \App\TransactionMonthPaid::where('student_id', $Monthly_history->student_id)
                                                            ->where('school_year_id', $Monthly_history->school_year_id)
                                                            ->orderBY('id', 'desc')
                                                            ->skip(1)
                                                            ->take(1)
                                                            ->first();

                                                        echo $current_bal->balance + $others_fee;
                                                    ?>
                                                    
                                                    
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e(number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt + $others_fee, 2)); ?>

                                            <?php endif; ?>                                                                                                
                                        </td>                                    
                                    </tr>
                                    <tr>                                        
                                        <td>Payment</td>
                                        <td>
                                            <?php echo e(number_format($Monthly_history->payment, 2)); ?>

                                        </td>                                    
                                    </tr>
                                    <tr>
                                        
                                        <td><b>Balance</b></td>
                                        <td>
                                            <b><?php echo e(number_format($Monthly_history->balance, 2)); ?></b>
                                        </td>                                    
                                    </tr>
                                       
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    

                        <div class="lightbox-target" id="img_receipt">
                            <img src="<?php echo e($Monthly_history->receipt_img ? \File::exists(public_path('/img/receipt/'.$Monthly_history->receipt_img)) ?
                                asset('/img/receipt/'.$Monthly_history->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                asset('/img/receipt/blank-user.gif')); ?>"/>
                            <a class="lightbox-close" href="#"></a>
                        </div>
                    
                        <?php if($Monthly_history->payment_option != 'Credit Card/Debit Card'): ?>
                            <div class="form-group">
                                <label for="">Image Receipt <small>(Click to zoom)</small></label>
                                <a class="lightbox" href="#img_receipt">
                                    <img class="img-responsive" 
                                    id="img-receipt"
                                    src="<?php echo e($Monthly_history->receipt_img ? \File::exists(public_path('/img/receipt/'.$Monthly_history->receipt_img)) ?
                                    asset('/img/receipt/'.$Monthly_history->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                    asset('/img/receipt/blank-user.gif')); ?>" 
                                    alt="User profile picture">
                                </a>
                            </div> 
                        <?php endif; ?>
                    </div>
                </div>            
                <div class="moda-footer">
                    
                    <button class="btn btn-flat btn-<?php echo e($Monthly_history->approval ? $Monthly_history->approval =='Approved' ? 'danger btn-disapprove' : 'success btn-approve' : 'danger btn-disapprove'); ?> pull-right"
                         data-id="<?php echo e($Monthly_history->id); ?>">
                        <?php echo e($Monthly_history->approval ? $Monthly_history->approval =='Approved' ? 'Disapprove' : 'Approve' : 'Disapprove'); ?>

                    </button>
                </div>     
            </div>    
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->