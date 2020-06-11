                                                
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#js-notyetapproved" data-toggle="tab">Not yet Approved &nbsp;
                                        <span class="<?php echo e($IncomingStudentCount == 0 ? '' : 'label label-danger'); ?> pull-right">
                                            <?php echo e($IncomingStudentCount == 0 ? '' : $IncomingStudentCount); ?>

                                        </span>
                                    </a>
                                </li>                                
                                <li>
                                    <a href="#js-approved" data-toggle="tab">Approved</a>
                                </li> 
                                <li>
                                    <a href="#js-disapproved" data-toggle="tab">Disapproved</a>
                                </li>                                
                            </ul>
                            <div class="tab-content">                                
                                <div class="active tab-pane" id="js-notyetapproved">     
                                    <div class="pull-right">
                                        <?php echo e($IncomingStudent ? $IncomingStudent->links() : ''); ?>

                                    </div>                             
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Student type</th>
                                                <th>Student level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $IncomingStudent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->student_name); ?></td>
                                                    <td><?php echo e($item->student_type == '1' ? 'Transferee' : 'Freshman'); ?></td>
                                                    <td>Grade <?php echo e($item->grade_level_id); ?></td>
                                                    <td>
                                                        <span class="label label-<?php echo e($item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'); ?>">
                                                            <?php echo e($item->approval); ?>

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="<?php echo e($item->student_id); ?>">View</button>
                                                        <button class="btn btn-sm btn-success btn-approve" data-id="<?php echo e($item->student_id); ?>">
                                                            Approve
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-disapprove" data-id="<?php echo e($item->student_id); ?>">
                                                            Disapprove
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        </tbody>
                                    </table>
                                </div>                                 
                        
                                <div class="tab-pane" id="js-approved">
                                    <div class="pull-right">
                                        <?php echo e($IncomingStudentApproved ? $IncomingStudentApproved->links() : ''); ?>

                                    </div>
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th>Name</th>
                                                <th>Student type</th>
                                                <th>Student level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $IncomingStudentApproved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->student_name); ?></td>
                                                    <td><?php echo e($item->student_type == '1' ? 'Transferee' : 'Freshman'); ?></td>
                                                    <td>Grade <?php echo e($item->grade_level_id); ?></td>
                                                    <td>
                                                        <span class="label label-<?php echo e($item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'); ?>">
                                                            <?php echo e($item->approval); ?>

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="<?php echo e($item->student_id); ?>">View</button>
                                                        <button class="btn btn-sm btn-danger btn-disapprove" data-id="<?php echo e($item->student_id); ?>">
                                                            Disapprove
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                        </tbody>
                                    </table> 
                                </div>  

                                <div class="tab-pane" id="js-disapproved">
                                    <div class="pull-right">
                                        <?php echo e($Disapproved ? $Disapproved->links() : ''); ?>

                                    </div>
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th>Name</th>
                                                <th>Student type</th>
                                                <th>Student level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $Disapproved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->student_name); ?></td>
                                                    <td><?php echo e($item->student_type == '1' ? 'Transferee' : 'Freshman'); ?></td>
                                                    <td>Grade <?php echo e($item->grade_level_id); ?></td>
                                                    <td>
                                                        <span class="label label-<?php echo e($item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'); ?>">
                                                            <?php echo e($item->approval); ?>

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="<?php echo e($item->student_id); ?>">View</button>
                                                        <button class="btn btn-sm btn-success btn-approve" data-id="<?php echo e($item->student_id); ?>">
                                                            Approve
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                        </tbody>
                                    </table> 
                                </div>  
                                
                                 
                            </div>                  
                        </div> 
                        
                        