<div class="list-group list-group-sidebar">
	<a class="list-group-item text-muted <?php echo e(Request::is('school-profile') ? 'selected' : ''); ?>" href="<?php echo e(route('school_profile')); ?>">School Profile</a>
	<a class="list-group-item text-muted <?php echo e(Request::is('vision-mission') ? 'selected' : ''); ?>" href="<?php echo e(route('vision_mission')); ?>">Vision  Mission</a>
	<a class="list-group-item text-muted <?php echo e(Request::is('philosophy') ? 'selected' : ''); ?>" href="<?php echo e(route('philosophy')); ?>">Philosophy</a>
	<a class="list-group-item text-muted <?php echo e(Request::is('history') ? 'selected' : ''); ?>" href="<?php echo e(route('history')); ?>">History</a>
	<a class="list-group-item text-muted <?php echo e(Request::is('hymn') ? 'selected' : ''); ?>" href="<?php echo e(route('hymn')); ?>">Hymn</a>
	<a class="list-group-item text-muted <?php echo e(Request::is('award-and-recognition') ? 'selected' : ''); ?>" href="<?php echo e(route('award_recognition')); ?>">Awards & Recognition</a>
	<a class="list-group-item text-muted <?php echo e(Request::is('administration-and-offices') ? 'selected' : ''); ?>" href="<?php echo e(route('administration_offices')); ?>">Administration & Offices</a>
</div>