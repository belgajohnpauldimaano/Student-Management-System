<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_subject_details">
                <?php echo e(csrf_field()); ?>

                <?php if($ClassDetail): ?>
                    <input type="hidden" name="id" value="<?php echo e($ClassDetail->id); ?>">
                <?php endif; ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <?php echo e($ClassDetail ? 'Edit Class' : 'Add Class'); ?>

                    </h4>
                </div>
                <div class="modal-body">                    
                    
                    <!-- 
                    
                     -->
                       
                    <div class="form-group">
                        <label for="">Grade Level</label>
                        <select name="grade_level" id="grade_level" class="form-control">
                            <option value="">Select grade level</option>
                            <?php $__currentLoopData = $SectionDetail_grade_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($data->grade_level); ?>" <?php echo e($ClassDetail ? $ClassDetail->grade_level == $data->grade_level ? 'selected' : '' : ''); ?>>Grade <?php echo e($data->grade_level); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelevel">
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label for="">Section</label>
                        <select name="section" id="section" class="form-control">
                            <option value="">Select section</option>
                            <?php $__currentLoopData = $SectionDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($data->id); ?>" <?php echo e($ClassDetail ? $ClassDetail->section_id == $data->id ? 'selected' : '' : ''); ?>><?php echo e($data->section); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-section">
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="">Strand</label>
                            <select name="strand" id="strand" class="form-control">
                                <option value="">Select strand</option>
                                <?php $__currentLoopData = $Strand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <option value="<?php echo e($data->id); ?>" <?php echo e($ClassDetail ? $ClassDetail->strand_id == $data->id ? 'selected' : '' : ''); ?>><?php echo e($data->strand); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="help-block text-red text-center" id="js-strand">
                            </div>
                    </div>
                                 
                    <div class="form-group">
                        <label for="">Room</label>
                        <select name="room" id="room" class="form-control">
                            <option value="">Select room</option>
                            <?php $__currentLoopData = $Room; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($data->id); ?>" <?php echo e($ClassDetail ? $ClassDetail->room_id == $data->id ? 'selected' : '' : ''); ?>><?php echo e($data->room_code); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-room">
                        </div>
                    </div>     

                    <div class="form-group">
                        <label for="">Class Adviser</label>
                        <select name="adviser" id="adviser" class="form-control">
                            <option value="">Adviser</option>
                            <?php $__currentLoopData = $FacultyInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($data->id); ?>" <?php echo e($ClassDetail ? $ClassDetail->adviser_id == $data->id ? 'selected' : '' : ''); ?>><?php echo e($data->last_name . ' '  . $data->first_name . ', '  . $data->middle_nam); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-adviser">
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label for="">School Year</label>
                        <select name="school_year" id="school_year" class="form-control">
                            <option value="">Select school year</option>
                            <?php $__currentLoopData = $SchoolYear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <option value="<?php echo e($data->id); ?>" <?php echo e($ClassDetail ? $ClassDetail->school_year_id == $data->id ? 'selected' : '' : ''); ?>><?php echo e($data->school_year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block text-red text-center" id="js-school_year">
                        </div>
                    </div>
                    
                    <!--  -->



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->