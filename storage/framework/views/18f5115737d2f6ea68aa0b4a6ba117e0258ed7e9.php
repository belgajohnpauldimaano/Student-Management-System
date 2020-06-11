<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_payment_category">
                <?php echo e(csrf_field()); ?>

                <?php if($PaymentCategory): ?>
                    <input type="hidden" name="id" value="<?php echo e($PaymentCategory->id); ?>">
                <?php endif; ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <?php echo e($PaymentCategory ? 'Edit Monthly Fee' : 'Add Monthly Fee'); ?>

                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Student Category</label>
                        <select name="stud_cat" id="stud_cat" class="form-control">
                            <option value="">Select Student Category</option>
                            <?php if($StudentCategory): ?>
                                <?php $__currentLoopData = $StudentCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($student_cat->id); ?>" <?php echo e($PaymentCategory ? $PaymentCategory->student_category_id == $student_cat->id ? 'selected' : '' : ''); ?>> Category <?php echo e($student_cat->student_category); ?></option>                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-stud_cat">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="">Grade lvl</label>
                        <select name="gradelvl" id="gradelvl" class="form-control">
                            <option value="">Select Grade level</option>
                            <?php if($Gradelvl): ?>
                                <?php $__currentLoopData = $Gradelvl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade_lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($grade_lvl->id); ?>" <?php echo e($PaymentCategory ? $PaymentCategory->grade_level_id == $grade_lvl->id ? 'selected' : '' : ''); ?>> Grade <?php echo e($grade_lvl->grade); ?></option>                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelvl">
                        </div>                        
                    </div>

                    <div class="form-group">
                            <label for="">Tuition Fee</label>
                            <select name="tuitionfee" id="tuitionfee" class="form-control">
                                
                                <?php if($TuitionFee): ?>
                                <option value="">Select Tuition Fee</option>
                                    <?php $__currentLoopData = $TuitionFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tf->id); ?>" <?php echo e($PaymentCategory ? $PaymentCategory->tuition_fee_id == $tf->id ? 'selected' : '' : ''); ?>> <?php echo e(number_format($tf->tuition_amt, 2)); ?></option>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <div class="help-block text-red text-center" id="js-tuitionfee">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Miscelleneous Fee</label>
                        <select name="misc_fee" id="misc_fee" class="form-control">
                            <option value="">Select Miscelleneous Fee</option>
                            <?php if($MiscFee): ?>
                                <?php $__currentLoopData = $MiscFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $misc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($misc->id); ?>" <?php echo e($PaymentCategory ? $PaymentCategory->misc_fee_id == $misc->id ? 'selected' : '' : ''); ?>> <?php echo e(number_format($misc->misc_amt, 2)); ?></option>                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-misc_fee">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Other Fee</label>
                        <select name="other_fee" id="other_fee" class="form-control">
                            <option value="">Select Other Fee</option>
                            <?php if($OtherFee): ?>
                                <?php $__currentLoopData = $OtherFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($other->id); ?>" <?php echo e($PaymentCategory ? $PaymentCategory->other_fee_id == $other->id ? 'selected' : '' : ''); ?>> <?php echo e(number_format($other->other_fee_amt, 2)); ?></option>                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-other_fee">
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