                        <div class="pull-right">
                            <div class="pull-right">
                                <?php echo e($OnlineAppointment ? $OnlineAppointment->links() : ''); ?>

                            </div>          
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th width="15%">Date</th>
                                    <th width="15%">Time</th>
                                    <th width="15%">Grade level</th>
                                    <th width="15%">No. of Appointee</th>
                                    
                                    <th width="10%">Status</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php if($OnlineAppointment): ?>
                                    <?php $__currentLoopData = $OnlineAppointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data ? date_format(date_create($data->date), 'F d, Y') : ''); ?></td>
                                            <td><?php echo e($data->time); ?></td>
                                            <td>Grade level <?php echo e($data->grade_lvl_id == 0 ? 'Not yet set' : $data->grade_lvl_id); ?></td>
                                            <td><?php echo e($data->available_students); ?></td>
                                            
                                            <td><?php echo e($data->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
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