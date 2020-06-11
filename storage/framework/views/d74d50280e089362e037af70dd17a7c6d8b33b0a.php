<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_downpayment">
                <?php echo e(csrf_field()); ?>

                <?php if($DownpaymentFee): ?>
                    <input type="hidden" name="id" value="<?php echo e($DownpaymentFee->id); ?>">
                <?php endif; ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <?php echo e($DownpaymentFee ? 'Edit Downpayment Fee' : 'Add Downpayment Fee'); ?>

                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Downpayment fee</label>
                        <input type="number" class="form-control" name="downpayment_fee" value="<?php echo e($DownpaymentFee ? $DownpaymentFee->downpayment_amt : ''); ?>">
                        <div class="help-block text-red text-center" id="js-downpayment_fee">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Grade lvl</label>
                        <select name="gradelvl" id="gradelvl" class="form-control">
                            <option value="">Select Grade level</option>
                            <?php if($Gradelvl): ?>
                                <?php $__currentLoopData = $Gradelvl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade_lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($grade_lvl->id); ?>" <?php echo e($DownpaymentFee ? $DownpaymentFee->grade_level_id == $grade_lvl->id ? 'selected' : '' : ''); ?>> Grade <?php echo e($grade_lvl->grade); ?></option>                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelvl">
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label for="">Set as Modified</label>
                        <select name="modified" id="modified" class="form-control">
                            <option value="1" <?php echo e($DownpaymentFee ? ($DownpaymentFee->modified == 1 ? 'selected' : '')  : 'selected'); ?>>Yes</option>
                            <option value="0" <?php echo e($DownpaymentFee ? ($DownpaymentFee->modified == 0 ? 'selected' : '')  : ''); ?>>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-modified">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->