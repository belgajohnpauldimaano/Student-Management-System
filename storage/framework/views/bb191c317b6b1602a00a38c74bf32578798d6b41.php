
    
        
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h4><i class="far fa-calendar-check"></i> Available Schedule of Appointment for paying tuition</h4>
            <div class="box-tools pull-right">            
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>                   
            </div>
            </div>               
            <div class="box-body">                  
                <div class="table-responsive">
                    <div class="form-group col-lg-6 input-email">
                        <label for="exampleInputEmail1">You are incoming Grade-level 
                            <i style="color:red">
                            <?php if($IncomingStudentCount): ?>
                                <?php echo e($IncomingStudentCount->grade_level_id); ?>

                                <input type="hidden" class="js-grade" value="<?php echo e($IncomingStudentCount->grade_level_id); ?>">
                            <?php else: ?>
                                <?php echo e($ClassDetail->grade_level+1); ?>

                                <input type="hidden" class="js-grade" value="<?php echo e($ClassDetail->grade_level+1); ?>">
                            <?php endif; ?>
                            </i>
                        </label><br/>
                        <label for="email">Check your Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="<?php echo e($StudentInformation->email); ?>">
                        <div class="help-block text-left" id="js-email"></div>
                    </div>    
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Available Total Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($OnlineAppointment): ?>
                                <?php $__currentLoopData = $OnlineAppointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item ? date_format(date_create($item->date), 'F d, Y') : ''); ?></td>
                                        <td><?php echo e($item->time); ?></td>
                                        <td><?php echo e($item->available_students == 0 ? 'The maximum number are reached to this schedule' : $item->available_students); ?></td>
                                        <td><?php echo e($item->status); ?></td>
                                        <td> 
                                            <?php                                         
                                                $Appointment = \App\StudentTimeAppointment::where('student_id', $StudentInformation->id)
                                                    // ->where('school_year_id', $SchoolYear->id)
                                                    // ->where('status', 1)
                                                    ->where('online_appointment_id', $item->id)->first(); 
                    
                                                if($Appointment){
                                                    $OnlineAppointment = \App\OnlineAppointment::where('status', 1)
                                                        ->where('id', $Appointment->online_appointment_id)
                                                        ->first();
                                                }
                                            ?>
                                            <?php if($Appointment): ?>
                                                <?php if($OnlineAppointment->date == $item->date): ?>                                   
                                                    <button <?php echo e($Appointment ? 'disabled' : ''); ?> class="btn btn-primary btn-reserve" 
                                                            data-id="<?php echo e($item->id); ?>"
                                                            data-date="<?php echo e($item ? date_format(date_create($item->date), 'F d, Y') : ''); ?>"
                                                            data-time="<?php echo e($item->time); ?>"
                                                    >
                                                            <i class="fas fa-mouse-pointer"></i> Reserve
                                                    </button>                                            
                                                <?php else: ?>
                                                    <button class="btn btn-primary btn-reserve" 
                                                        data-id="<?php echo e($item->id); ?>"
                                                        data-date="<?php echo e($item ? date_format(date_create($item->date), 'F d, Y') : ''); ?>"
                                                        data-time="<?php echo e($item->time); ?>"
                                                    >
                                                        <i class="fas fa-mouse-pointer"></i> Reserve
                                                    </button>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <button <?php echo e($item->available_students == 0 ? 'disabled' : ''); ?> class="btn btn-primary btn-reserve" 
                                                        data-id="<?php echo e($item->id); ?>"
                                                        data-date="<?php echo e($item ? date_format(date_create($item->date), 'F d, Y') : ''); ?>"
                                                        data-time="<?php echo e($item->time); ?>"
                                                    >
                                                        <i class="fas fa-mouse-pointer"></i> Reserve
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                            <?php endif; ?>           
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
        
        
    </div>

    <div class="col-md-4">
        <?php echo $__env->make('control_panel_student.online_appointment.partials.data_appointment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>            

            
       
    

