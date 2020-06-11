<div class="pull-right">
    <?php echo e($DownpaymentFee ? $DownpaymentFee->links() : ''); ?>

</div>
<table class="table no-margin">
    <thead>
        <tr>
            <th>Downpayment Fee</th>
            <th>Student Category</th>
            <th>Modified</th>
            
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if($DownpaymentFee): ?>
            <?php $__currentLoopData = $DownpaymentFee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(number_format($data->downpayment_amt, 2)); ?></td>
                    <td><?php echo e($data->grade_level_id ? 'Grade' : ''); ?> <?php echo e($data->grade_level_id == 0 ? '' : $data->grade_level_id); ?></td>
                    <td><?php echo e($data->modified == 1 ? 'Yes' : 'No'); ?></td>
                    
                    <td><?php echo e($data->status == 1 ? 'Active' : 'Inactive'); ?></td>
                    <td>
                        <div class="input-group-btn pull-left text-left">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="js-btn_update_sy" data-id="<?php echo e($data->id); ?>">Edit</a></li>
                                <li><a href="#" class="js-btn_deactivate" data-id="<?php echo e($data->id); ?>">Deactivate</a></li>
                                <li><a href="#" class="js-modify" data-id="<?php echo e($data->id); ?>" data-modify_title="<?php echo e(( $data->modified ? 'Remove from modify active' : 'Add to modify active' )); ?>"><?php echo e(( $data->modified ? 'Remove from modify Active' : 'Add to modify Active' )); ?></a></li>
                                
                            </ul>>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>