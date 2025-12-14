

<?php $__env->startSection('title', 'ملفي الشخصي'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">

        <h2 class="h4 fw-bold mb-3"><i class="fas fa-user ms-1 text-success"></i> ملفي الشخصي (أدمن)</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 shadow-sm text-center"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger border-0 shadow-sm text-center"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow">
            <div class="card-body p-4 p-md-5">
                <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>

                    
                    <h3 class="h6 fw-bold mb-3">بيانات الحساب</h3>
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">
                                الاسم الكامل <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                class="form-control <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('full_name', $user->full_name)); ?>"
                                required
                            >
                            <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                البريد الإلكتروني <span class="text-danger">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('email', $user->email)); ?>"
                                required
                            >
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="row g-3 mt-0">
                        <div class="col-md-3">
                            <label class="form-label">الدور</label>
                            <input type="text" class="form-control" value="admin" disabled>
                            <div class="form-text">لا يمكن تعديل الدور من هذه الصفحة.</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">الحالة</label>
                            <input type="text" class="form-control" value="<?php echo e($user->status ?? 'active'); ?>" disabled>
                        </div>
                    </div>

                    <hr class="my-4">

                    
                    <h3 class="h6 fw-bold mb-3">تغيير كلمة المرور (اختياري)</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">كلمة المرور الجديدة</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="••••••••"
                                minlength="8"
                            >
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-text">اتركه فارغًا إذا كنت لا ترغب في تغييره.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="••••••••"
                                minlength="8"
                            >
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/profile.blade.php ENDPATH**/ ?>