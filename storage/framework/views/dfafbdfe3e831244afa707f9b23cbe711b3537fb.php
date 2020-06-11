<?php $__env->startSection('title'); ?>
	Administration and Offices
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="global-header" style="background-image: url('<?php echo e(asset('img/intro-banner/1.jpg')); ?>');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Administration and Offices</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora consequatur non atque, dolorem iste numquam assumenda inventore vitae quod. Nisi porro praesentium consequuntur ad provident minus, accusamus odit aspernatur error.</p>
				</div>
				
					<div class="col-md-4">
						<?php echo $__env->make('pages.about.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				
			</div>
			
		</div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>