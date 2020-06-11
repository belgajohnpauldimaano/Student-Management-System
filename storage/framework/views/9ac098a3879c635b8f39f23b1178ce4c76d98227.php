                        <div class="pull-right">
                            <?php echo e($StudentInformation ? $StudentInformation->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Parent/Guardian</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($StudentInformation): ?>
                                    <?php $__currentLoopData = $StudentInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name); ?></td>
                                            <td><?php echo e($data->user->username); ?></td>
                                            <td><?php echo e(($data->gender == 1 ? 'Male' : 'Female')); ?></td>
                                            <td><?php echo e($data->birthdate ? date_format(date_create($data->birthdate), 'F d, Y') : ''); ?></td>
                                            <td><?php echo e($data->guardian); ?></td>
                                            <td><?php echo e($data->c_address); ?></td>
                                            <td><?php echo e($data->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <?php if($data->enrolled_class): ?> 
                                                            <li><a href="#" class="js-btn_print_grade" data-id="<?php echo e($data->id); ?>">Print Grade</a></li>
                                                        <?php endif; ?>
                                                        <li><a href="#" class="js-btn_update_sy" data-id="<?php echo e($data->id); ?>">Edit</a></li>
                                                        <li><a href="#" class="js-btn_deactivate" data-id="<?php echo e($data->id); ?>">Deactivate</a></li>
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>