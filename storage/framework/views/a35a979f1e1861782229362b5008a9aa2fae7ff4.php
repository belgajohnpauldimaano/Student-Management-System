                                                
                    
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#js-notyetapproved" data-toggle="tab">Not yet Approved &nbsp;
                                        <span class="<?php echo e($NotyetApprovedCount == 0 ? '' : 'label label-danger'); ?> pull-right">
                                            <?php echo e($NotyetApprovedCount == 0 ? '' : $NotyetApprovedCount); ?>

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
                                        <?php echo e($NotyetApproved ? $NotyetApproved->links() : ''); ?>

                                    </div>  
                                                             
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Student level</th>
                                                <th>Tuition Fee</th>
                                                <th>Misc Fee</th>
                                                <th>Disc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $NotyetApproved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($data->student_name); ?></td>
                                                    <td><?php echo e($data->student_level); ?></td>
                                                    <td><?php echo e(number_format($data->tuition_amt,2)); ?></td>
                                                    <td><?php echo e(number_format($data->misc_amt,2)); ?></td>
                                                    <td>
                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo e(number_format(($data->tuition_amt + $data->misc_amt), 2)); ?>

                                                    </td>
                                                    <td><?php echo e(number_format($data->payment,2)); ?></td>
                                                    <td><?php echo e(number_format($data->balance,2)); ?></td>
                                                    <td>
                                                        <span class="label <?php echo e($data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'); ?>">
                                                        <?php echo e($data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'); ?>

                                                        </span>
                                                    </td>
                                                    <td width="15%">
                                                        <div class="input-group-btn pull-left text-left">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                                <span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#" class="btn-view-modal" data-id="<?php echo e($data->transaction_id); ?>"  data-monthly_id="<?php echo e($data->transact_monthly_id); ?>">View</a></li>
                                                                <li><a href="#" class="btn-approve" data-id="<?php echo e($data->transact_monthly_id); ?>">Approve</a></li>
                                                                <li><a href="#" class="btn-disapprove"  data-id="<?php echo e($data->transact_monthly_id); ?>">Disapprove</a></li>
                                                            </ul>
                                                        </div>                                                        
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>                                 
                        
                                <div class="tab-pane" id="js-approved">
                                    <div class="pull-right">
                                        <?php echo e($Approved ? $Approved->links() : ''); ?>

                                    </div>
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Student level</th>
                                                <th>Tuition Fee</th>
                                                <th>Misc Fee</th>
                                                <th>Disc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $Approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($data->student_name); ?></td>
                                                    <td><?php echo e($data->student_level); ?></td>
                                                    <td><?php echo e(number_format($data->tuition_amt,2)); ?></td>
                                                    <td><?php echo e(number_format($data->misc_amt,2)); ?></td>
                                                    <td>
                                                        <?php 
                                                            $discount = \App\TransactionDiscount::where('student_id', $data->student_id)->where('school_year_id', $data->school_year_id)->sum('discount_amt');
                                                            echo number_format($discount, 2);
                                                        ?>
                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo e(number_format(($data->tuition_amt + $data->misc_amt) - $discount, 2)); ?>

                                                    </td>
                                                    <td><?php echo e(number_format($data->payment,2)); ?></td>
                                                    <td><?php echo e(number_format($data->balance,2)); ?></td>
                                                    <td>
                                                        <span class="label <?php echo e($data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'); ?>">
                                                        <?php echo e($data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'); ?>

                                                        </span>
                                                    </td>
                                                    <td width="15%">
                                                        <div class="input-group-btn pull-left text-left">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                                <span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#" class="btn-view-modal" data-id="<?php echo e($data->transaction_id); ?>"  data-monthly_id="<?php echo e($data->transact_monthly_id); ?>">View</a></li>
                                                                
                                                                <li><a href="#" class="btn-disapprove"  data-id="<?php echo e($data->transact_monthly_id); ?>">Disapprove</a></li>
                                                            </ul>
                                                        </div> 
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
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Student level</th>
                                                <th>Tuition Fee</th>
                                                <th>Misc Fee</th>
                                                <th>Disc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $Disapproved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($data->student_name); ?></td>
                                                    <td><?php echo e($data->student_level); ?></td>
                                                    <td><?php echo e(number_format($data->tuition_amt,2)); ?></td>
                                                    <td><?php echo e(number_format($data->misc_amt,2)); ?></td>
                                                    <td>
                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo e(number_format(($data->tuition_amt + $data->misc_amt), 2)); ?>

                                                    </td>
                                                    <td><?php echo e(number_format($data->payment,2)); ?></td>
                                                    <td><?php echo e(number_format($data->balance,2)); ?></td>
                                                    <td>
                                                        <span class="label label-danger">
                                                            Disapproved
                                                        </span>
                                                    </td>
                                                    <td width="15%">
                                                        <div class="input-group-btn pull-left text-left">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                                <span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#" class="btn-view-modal" data-id="<?php echo e($data->transaction_id); ?>"  data-monthly_id="<?php echo e($data->transact_monthly_id); ?>">View</a></li>
                                                                <li><a href="#" class="btn-approve" data-id="<?php echo e($data->transact_monthly_id); ?>">Approve</a></li>
                                                                
                                                            </ul>
                                                        </div> 
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table> 
                                </div>
                                
                                
                            </div>                  
                        </div> 
                    
                        
                        