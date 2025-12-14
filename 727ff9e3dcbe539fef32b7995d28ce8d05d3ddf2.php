

<?php $__env->startSection('title', 'ملفي الشخصي'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="h4 fw-bold mb-3"><i class="fas fa-user ms-1 text-success"></i> ملفي الشخصي</h2>
        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 shadow-sm text-center"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger border-0 shadow-sm text-center"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow">
            <div class="card-body p-4 p-md-5">
                <form action="<?php echo e(route('user.profile.update')); ?>" method="POST" novalidate>
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

                    <hr class="my-4">

                    
                    <h3 class="h6 fw-bold mb-3">بيانات صحية</h3>
                    <div class="row g-3">
                        
                        <div class="col-md-3">
                            <label for="age" class="form-label">العمر</label>
                            <input
                                type="number"
                                id="age"
                                name="age"
                                class="form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('age', $user->age)); ?>"
                                min="10" max="120"
                                placeholder="مثال: 28"
                            >
                            <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <?php
                            $genderOld = old('gender', $user->gender);
                            $goalOld   = old('goal', $user->goal);
                        ?>

                        
                        <div class="col-md-3">
                            <label for="gender" class="form-label">النوع</label>
                            <select id="gender" name="gender" class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">— اختر —</option>
                                <option value="male"   <?php echo e($genderOld === 'male' ? 'selected' : ''); ?>>ذكر</option>
                                <option value="female" <?php echo e($genderOld === 'female' ? 'selected' : ''); ?>>أنثى</option>
                                <option value="other"  <?php echo e($genderOld === 'other' ? 'selected' : ''); ?>>أخرى</option>
                            </select>
                            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="goal" class="form-label">الهدف</label>
                            <select id="goal" name="goal" class="form-select <?php $__errorArgs = ['goal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">— اختر —</option>
                                <option value="slimming" <?php echo e($goalOld === 'slimming' ? 'selected' : ''); ?>>تخسيس</option>
                                <option value="bulking"  <?php echo e($goalOld === 'bulking'  ? 'selected' : ''); ?>>زيادة وزن/كتلة</option>
                                <option value="healthy"  <?php echo e($goalOld === 'healthy'  ? 'selected' : ''); ?>>صحة عامة</option>
                                <option value="kids"     <?php echo e($goalOld === 'kids'     ? 'selected' : ''); ?>>أطفال</option>
                            </select>
                            <?php $__errorArgs = ['goal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>


                        
                        <div class="col-md-6">
                            <label for="height_cm" class="form-label">الطول (سم)</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    id="height_cm"
                                    name="height_cm"
                                    class="form-control <?php $__errorArgs = ['height_cm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('height_cm', $user->height_cm)); ?>"
                                    min="80" max="250"
                                    placeholder="مثال: 175"
                                >
                                <span class="input-group-text">سم</span>
                                <?php $__errorArgs = ['height_cm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="weight_kg" class="form-label">الوزن (كجم)</label>
                            <div class="input-group">
                                <input
                                    type="number" step="0.01"
                                    id="weight_kg"
                                    name="weight_kg"
                                    class="form-control <?php $__errorArgs = ['weight_kg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('weight_kg', $user->weight_kg)); ?>"
                                    min="20" max="400"
                                    placeholder="مثال: 72.5"
                                >
                                <span class="input-group-text">كجم</span>
                                <?php $__errorArgs = ['weight_kg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <?php $bmi = $user->bmi; ?>
                            <div class="small text-muted">
                                مؤشر كتلة الجسم (BMI): <strong><?php echo e($bmi !== null ? $bmi : '—'); ?></strong>
                            </div>
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

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/user/profile.blade.php ENDPATH**/ ?>