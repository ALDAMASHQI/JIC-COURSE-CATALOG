<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <h2 class="mb-4 text-center"><i class="fas fa-user-circle me-2"></i> My Profile</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

       <div class="row d-flex" style="    justify-content: center;">
           <div class="col-md-6">
               <div class="card shadow-sm">
                   <div class="card-body">
                       <form action="<?php echo e(route('customer.updateProfile')); ?>" method="POST">
                           <?php echo csrf_field(); ?>
                           <div class="mb-3">
                               <label class="form-label">Full Name</label>
                               <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
                               <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Phone</label>
                               <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $user->phone)); ?>">
                               <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Address</label>
                               <input type="text" name="address" class="form-control" value="<?php echo e(old('address', $user->address)); ?>">
                               <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>

                           <hr>
                           <h5 class="mb-3">Change Password</h5>
                           <div class="mb-3">
                               <label class="form-label">New Password</label>
                               <input type="password" name="password" class="form-control">
                               <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Confirm Password</label>
                               <input type="password" name="password_confirmation" class="form-control">
                           </div>

                           <button type="submit" class="btn btn-primary w-100">
                               <i class="fas fa-save me-2"></i> Update Profile
                           </button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/customer/profile.blade.php ENDPATH**/ ?>