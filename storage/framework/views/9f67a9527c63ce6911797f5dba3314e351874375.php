                        <div class="pull-right">
                            <?php echo e($OtherFee ? $OtherFee->links() : ''); ?>                  
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Other Fee</th>
                                    <th>Other Fee Amount</th>
                                    <th>Current</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php if($OtherFee): ?>
                                    <?php $__currentLoopData = $OtherFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->other_fee_name); ?></td>
                                            <td><?php echo e(number_format($data->other_fee_amt, 2)); ?></td>
                                            <td><?php echo e($data->current == 1 ? 'Active' : 'Inactive'); ?></td>
                                            <td><?php echo e($data->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update_sy" data-id="<?php echo e($data->id); ?>">Edit</a></li>
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