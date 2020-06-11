<div class="box box-primary direct-chat direct-chat-primary">
    <div class="box-header with-border">
    <h3 class="box-title">Appointment</h3>    
    <div class="box-tools pull-right">
        <span data-toggle="tooltip" title="" class="<?php echo e($AppointedCount ? 'badge bg-light-blue' : ''); ?>" data-original-title="<?php echo e($AppointedCount ? $AppointedCount : 'No'); ?> Appointment">
            <?php echo e($AppointedCount ? $AppointedCount : ''); ?>

        </span>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>                   
    </div>
    </div>               
    <div class="box-body">                  
    <div class="">
        <?php if($hasAppointment): ?>
            <?php $__currentLoopData = $Appointed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="padding: 5px 10px;background:;border: 1px solid #d2d6de;margin: 5px 5px 0 5px;color: rgb(2, 2, 2);" class="success">
                <h4>Appointment Schedule</h4>
                <p>Date and Time: <?php echo e($item ? date_format(date_create($item->appointment->date), 'F d, Y') : ''); ?> <?php echo e($item->appointment->time); ?></p>
                <p>Queue number: <?php echo e($item->queueing_number); ?></p>
                <div>
                    
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div style="padding: 10px">
                <h4>No Appointment</h4>
            </div> 
        <?php endif; ?>
    </div>                 
    </div>
    
    <div class="box-footer">
    </div>
</div>