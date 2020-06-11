                        <div class="pull-right">
                            <?php echo e($StudentInformation ? $StudentInformation->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Student Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($StudentInformation): ?>
                                    <?php $__currentLoopData = $StudentInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->username); ?></td>
                                            <td><?php echo e($data->fullname); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-primary js-btn_enroll_student" data-id="<?php echo e($data->id); ?>" aria-expanded="true">
                                                        Enroll
                                                    </button>
                                                        
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>