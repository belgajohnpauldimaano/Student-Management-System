<?php $__env->startSection('content_title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-sm-12 col-md-4">
        <div class="info-box bg-green">
            <span class="info-box-icon ">
                <i class="ion ion-ios-people-outline"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Tagged Students</span>
                <span class="info-box-number"><?php echo e($StudentInformation_tagged_student->total_students); ?></span>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="info-box bg-red">
            <span class="info-box-icon">
                
                <i class="fas fa-male"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Tagged Male</span>
                <span class="info-box-number"><?php echo e($StudentInformation_tagged_student_male->total_students); ?></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="info-box bg-yellow">
            <span class="info-box-icon">
                <i class="fas fa-female"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Tagged Female</span>
                <span class="info-box-number"><?php echo e($StudentInformation_tagged_student_female->total_students); ?></span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="info-box bg-blue">
            <span class="info-box-icon">
                <i class="fas fa-book"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Number of current subject</span>
                <span class="info-box-number"><?php echo e($ClassSubjectDetail_count->subject_count); ?></span>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control_panel.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>