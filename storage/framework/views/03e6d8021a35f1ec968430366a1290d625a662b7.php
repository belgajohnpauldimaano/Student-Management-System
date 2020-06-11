                        <div class="pull-right">
                            <?php echo e($ClassDetail ? $ClassDetail->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Room</th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    <!--  -->
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($ClassDetail): ?>
                                    <?php $__currentLoopData = $ClassDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->school_year); ?> </td>
                                            <td><?php echo e($data->room_code); ?></td>
                                            <td><?php echo e($data->grade_level); ?></td>
                                            <td><?php echo e($data->section); ?></td>
                                            
                                            
                                            <td><?php echo e($data->status == 0 ? 'Active' : 'Inactive'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo e(route('faculty.advisory_class.view')); ?>?c=<?php echo e(encrypt($data->id)); ?>" class="js-btn_view" data-id="<?php echo e(encrypt($data->id)); ?>">
                                                                View
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo e(route('faculty.my_advisory_class.index')); ?>?c=<?php echo e(encrypt($data->id)); ?>" class="js-btn_gradesheet" data-id="<?php echo e(encrypt($data->id)); ?>">
                                                                Grade Sheet
                                                            </a>
                                                        </li>

                                                        <!-- 

                                                        

                                                         -->
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>