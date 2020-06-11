                        <div class="pull-right">
                            <?php echo e($TrascriptArhieve ? $TrascriptArhieve->links() : ''); ?>

                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>School Year Graduated</th>
                                    <th>TOR Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($TrascriptArhieve): ?>
                                    <?php $__currentLoopData = $TrascriptArhieve; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name); ?></td>
                                            <td><?php echo e($data->school_year_graduated); ?></td>
                                            
                                            <td><?php echo e($data->file_name ? 'Available' : 'Not Available'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update_sy" data-id="<?php echo e($data->id); ?>"><i class="fa fa-pencil"></i> Edit</a></li>
                                                        <li><a href="#" class="js-btn_delete" data-id="<?php echo e($data->id); ?>"><i class="fa fa-trash"></i> Delete</a></li>
                                                        <li><a href="#" class="js-btn_download" data-id="<?php echo e($data->id); ?>" data-file="<?php echo e($data->file_name); ?>"><i class="fa fa-download"></i> Download TOR</a></li>
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>