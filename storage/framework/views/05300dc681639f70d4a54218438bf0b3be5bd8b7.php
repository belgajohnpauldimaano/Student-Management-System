                        <div class="pull-right">
                            <?php echo e($DiscountFee ? $DiscountFee->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Discount Name</th>
                                    <th>Discount Fee Amount</th>
                                    <th>Apply to</th>
                                    <th>Current</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($DiscountFee): ?>
                                    <?php $__currentLoopData = $DiscountFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->disc_type); ?></td>
                                            <td><?php echo e(number_format($data->disc_amt ,2)); ?></td>
                                            <td><?php echo e($data->apply_to== 1 ? 'Student|Finance' : 'Finance'); ?></td>
                                            <td><?php echo e($data->current == 1 ? 'Yes' : 'No'); ?></td>
                                            <td><?php echo e($data->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update_sy" data-id="<?php echo e($data->id); ?>">Edit</a></li>
                                                        
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>