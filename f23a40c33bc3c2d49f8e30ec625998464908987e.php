
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('auth.css')); ?>">
    <style>
        .auth-card {
            max-width: 550px !important;

        }
    </style>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="display-6 fw-bold mb-4">Welcome Back to Pharmahub</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <div class="auth-card">
            <h2 class="text-center">Sign In</h2>
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button type="submit" class="btn-custom w-100">Login</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href="<?php echo e(route('register')); ?>">Register</a></p>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmahub\resources\views/auth/login.blade.php ENDPATH**/ ?>