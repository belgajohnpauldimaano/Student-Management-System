                        <div class="pull-right">                            
                            <?php echo e($PaymentCategory ? $PaymentCategory->links() : ''); ?>                                    
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th width="15%">Student Category</th>
                                    <th width="7%">Grade Lvl</th>
                                    <th width="7%">Tuition Fee</th>
                                    <th width="7%">Misc Fee</th>
                                    <th width="7%">Other Fee</th>
                                    <th width="7%">Current</th>
                                    <th width="7%">Status</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php if($PaymentCategory): ?>
                                    <?php $__currentLoopData = $PaymentCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->stud_category->student_category); ?></td>
                                            <td><?php echo e($data->grade_level_id); ?></td>
                                            <td>
                                                <?php if($data->tuition): ?>
                                                    <?php echo e(number_format($data->tuition->tuition_amt, 2)); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($data->misc_fee): ?>
                                                    <?php echo e(number_format($data->misc_fee->misc_amt, 2)); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($data->other_fee): ?>
                                                    <?php echo e(number_format($data->other_fee->other_fee_amt, 2)); ?>

                                                <?php endif; ?>
                                            </td>
                                            
                                            <td><?php echo e($data->current == 1 ? 'Yes' : 'No'); ?></td> 
                                            <td><?php echo e($data->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update" data-id="<?php echo e($data->id); ?>">Edit</a></li>
                                                        <li><a href="#" class="js-btn_deactivate" data-id="<?php echo e($data->id); ?>">Deactivate</a></li>
                                                        <li><a href="#" class="js-btn_toggle_current" data-id="<?php echo e($data->id); ?>" data-toggle_title="<?php echo e(( $data->current ? 'Remove from current active' : 'Add to current active' )); ?>"><?php echo e(( $data->current ? 'Remove from current Active' : 'Add to current Active' )); ?></a></li>
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>