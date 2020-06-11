<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_other_fee">
                <?php echo e(csrf_field()); ?>

                <?php if($OnlineAppointment): ?>
                    <input type="hidden" name="id" value="<?php echo e($OnlineAppointment->id); ?>">
                <?php endif; ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <?php echo e($OnlineAppointment ? 'Edit Online Appointment' : 'Add Online Appointment'); ?>

                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control" id="date" name="date" data-date-format="yyyy/m/d" placeholder="yyyy/m/d" value="<?php echo e($OnlineAppointment ? $OnlineAppointment->date : ''); ?>">
                        <div class="help-block text-red text-center" id="js-date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Time</label>
                        <input type="text" class="form-control timepicker" name="time" value="<?php echo e($OnlineAppointment ? $OnlineAppointment->time : ''); ?>">
                        <div class="help-block text-red text-center" id="js-time">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Grade level</label>
                        <select name="grade_lvl" id="grade_lvl" class="form-control">
                            <option value="">Select Grade level</option>
                            <?php if($Gradelvl): ?>
                                <?php $__currentLoopData = $Gradelvl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade_lvl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($grade_lvl->id); ?>" <?php echo e($OnlineAppointment ? $OnlineAppointment->grade_lvl_id == $grade_lvl->id ? 'selected' : '' : ''); ?>> Grade <?php echo e($grade_lvl->grade); ?></option>                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-grade_lvl">
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="">Number of Appointee</label>
                            <input type="number" class="form-control" name="appointee" value="<?php echo e($OnlineAppointment ? $OnlineAppointment->available_students : ''); ?>">
                            <div class="help-block text-red text-center" id="js-appointee">
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