<?php $__env->startSection('content'); ?>
<p class="login-box-msg">Sign in to manage</p>
    
    <form action="<?php echo e(route('login')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

      <div class="form-group has-feedback <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
        <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo e(old('username')); ?>" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        <?php if($errors->has('username')): ?>
            <span class="help-block text-center">
                <strong><?php echo e($errors->first('username')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="form-group has-feedback<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
        <input type="password" id="viewPwdLogin" name="password" class="form-control" placeholder="Password" required>
        
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        <?php if($errors->has('password')): ?>
            <span class="help-block text-center">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
        <?php endif; ?>
      </div>
      <div class="row">
            <div class="col-xs-8">
                    <div class="checkbox icheck">
                      <label>
                          
                        
                      </label>
                    </div>  
              </div>
        
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('control_panel.layouts.auth_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>