<div class="box-body">
    <?php if($GradeSheet != 0): ?>
        <?php if($grade_level >= 11): ?>         
            <?php 
                $Semester = \App\Semester::where('current', 1)->first()->id; 
            ?>
            <h3>
                <span class="logo-mini"><img src="<?php echo e(asset('/img/sja-logo.png')); ?>" style="height: 60px;"></span> Grade-level/Section : <i style="color:red"><?php echo e($ClassDetail->grade_level .' - '. $ClassDetail->section); ?></i>
            </h3>
            
            <?php echo $__env->make('control_panel_student.grade_sheet.partials.grade_panel.senior.first_sem.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <hr>
            <?php echo $__env->make('control_panel_student.grade_sheet.partials.grade_panel.senior.second_sem.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>            
            
        <?php else: ?>           
            <?php echo $__env->make('control_panel_student.grade_sheet.partials.grade_panel.junior.data_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>       
        <?php endif; ?>
    <?php else: ?>
        <h4>Not yet enrolled for this year</h4>
    <?php endif; ?>
</div>