    
<div class="pull-right">
    <?php echo e($Grade9 ? $Grade9->links() : ''); ?>

</div>                             
<table class="table no-margin table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Student level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>                                            
                    <?php $__currentLoopData = $Grade9; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>      
                    <tr>                                        
                        <td><?php echo e($key + 1); ?>.</td>
                        <td style="width 80%"><?php echo e($data->student_name); ?></td>
                        <td><?php echo e($data->student_level); ?></td>
                        <td>
                            <span class="label <?php echo e($data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'); ?>">
                            <?php echo e($data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'); ?>

                            </span>
                        </td>
                        <td>
                            <div class="input-group-btn pull-left text-left">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                    <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $g_s_9; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                        <a href="#" class="js-btn_enroll_student" data-student="<?php echo e($data->student_name); ?>" data-section="<?php echo e($item->section->section); ?>" data-class_id="<?php echo e($item->id); ?>" data-student_id="<?php echo e($data->student_id); ?>">
                                                Section <?php echo e($item->section->section); ?> - <?php echo e($item->section->grade_level); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                </tbody>
</table>