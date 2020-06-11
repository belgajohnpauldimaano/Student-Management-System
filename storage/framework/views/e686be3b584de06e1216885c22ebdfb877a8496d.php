


<div class="active tab-pane" id="js-unpaid">     
    

    <table class="table table-bordered" id="myTable">
        <thead>
            <th width="4%">No.</th>
            <th>Name</th>
            <th>Grade level</th>
            <th>Queue number</th>
            <th>Status</th>
            <th width="20%">Action</th>
        </thead>
        <tbody>
         <?php if($OnlineAppointment): ?>   
            <button style="margin-bottom: 1em" class="btn btn-danger btn-deactivate pull-right" data-id="<?php echo e($OnlineAppointment->id); ?>">
                <i class="fas fa-exclamation-circle"></i> Deactivate this entire Schedule
            </button>   
            <?php if($hasAppointment): ?>      
                <?php $__currentLoopData = $appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?>.</td>
                        <td><?php echo e($item->student_name); ?></td>
                        <td><?php echo e($item->grade_lvl); ?></td>
                        <td><?php echo e($item->queueing_number); ?></td>
                        <td>
                            <span class="label label-<?php echo e($item->status == 1 ? 'success' : 'danger'); ?>">
                                <?php echo e($item->status == 1 ? 'Queue' : 'Done'); ?>

                            </span>
                        </td>
                        <td >
                            <button <?php echo e($item->status == 1 ? '' : 'disabled'); ?> class="btn btn-primary btn_done" data-id="<?php echo e($item->student_time_appointment_id); ?>">
                                <i class="far fa-check-circle"></i> <?php echo e($item->status == 1 ? 'Done' : 'Already Done'); ?>

                            </button>
                            
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>             
            <?php else: ?>
                <tr>
                    <td colspan="6">There is no active appointment</td>
                </tr>
            <?php endif; ?>          
        <?php endif; ?>
        </tbody>
    </table>

</div>                                 

