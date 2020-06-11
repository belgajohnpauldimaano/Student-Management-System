                        <div class="pull-right">
                            <?php echo e($FacultyInformation ? $FacultyInformation->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>No. of Handled Subjects</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($FacultyInformation): ?>
                                    <?php $__currentLoopData = $FacultyInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->fullname); ?></td>
                                            <td><?php echo e(collect(\App\FacultyInformation::DEPARTMENTS)->firstWhere('id', $data->department_id)['department_name']); ?></td>
                                            <td><?php echo e($data->subjects_count); ?></td>
                                            
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_view_class_schedule" data-id="<?php echo e($data->id); ?>">View Handled Subjects</a></li>
                                                        <li><a href="#" target="_blank" class="js-btn_report" data-id="<?php echo e($data->id); ?>">Print Subjects</a></li>
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>