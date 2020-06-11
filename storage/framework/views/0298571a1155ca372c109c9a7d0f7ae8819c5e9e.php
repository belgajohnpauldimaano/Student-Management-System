<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        Print Student Grade
                    </h4>
                </div>
                <div class="modal-body">
                    <?php echo e(csrf_field()); ?>

                    <?php if($Enrollment): ?>
                        <input name="print_student_id" id="print_student_id" value="<?php echo e($student_id); ?>" type="hidden" />
                        <div class="form-group">
                        <label>Select School Year</label>
                            <select class="form-control" id="print_sy">
                                <option value="0">Select School Year</option>
                                <?php $__currentLoopData = $Enrollment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($e->c_id); ?>"><?php echo e($e->sy); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <h3>No Class tagged</h3>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    
                    <?php if($Enrollment): ?>
                        <a class="btn btn-primary btn-flat" id="js-btn_print_student_grade">Print</a>
                    <?php endif; ?>
                </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->