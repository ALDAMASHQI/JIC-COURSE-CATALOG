


<?php $__env->startSection('title', 'إنشاء حساب'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg2.jpg')); ?>') center/cover no-repeat; min-height: 45vh;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity:.55;"></div>
        <div class="container position-relative">
            <h1 class="display-5 fw-bold mb-2">إنشاء حساب جديد</h1>
            <p class="lead text-white-50 mb-0">ابدأ رحلتك الصحية مع FitNow الآن</p>
        </div>
    </section>

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                
                <?php if(session('success')): ?>
                    <div class="alert alert-success border-0 shadow-sm"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger border-0 shadow-sm"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h4 fw-bold mb-4 text-center">معلومات الحساب</h2>

                        <form action="<?php echo e(route('auth.register')); ?>" method="POST" class="needs-validation" novalidate>
                            <?php echo csrf_field(); ?>

                            
                            <div class="mb-3">
                                <label for="full_name" class="form-label">
                                    الاسم الكامل <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" class="form-control <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('full_name')); ?>" required>
                                <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-3">
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
                                    placeholder="name@example.com"
                                    value="<?php echo e(old('email')); ?>"
                                    required
                                >
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    كلمة المرور <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
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
                                        required
                                    >
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('password', this)">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">
                                    تأكيد كلمة المرور <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="••••••••"
                                        minlength="8"
                                        required
                                    >
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('password_confirmation', this)">
                                        <i class="fa fa-eye-slash"></i>
                                    </button>
                                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h3 class="h6 fw-bold mb-3">بيانات صحية (اختياري)</h3>

                            <div class="row g-3">
                                
                                <div class="col-md-4">
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
                                        placeholder="مثال: 28"
                                        value="<?php echo e(old('age')); ?>"
                                        min="10" max="120"
                                    >
                                    <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="col-md-4">
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
                                        <option value="male"   @selected(old('gender')==='male')>ذكر</option>
                                        <option value="female" @selected(old('gender')==='female')>أنثى</option>
                                        <option value="other"  @selected(old('gender')==='other')>أخرى</option>
                                    </select>
                                    <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="col-md-4">
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
                                        <option value="slimming" @selected(old('goal')==='slimming')>تخسيس</option>
                                        <option value="bulking"  @selected(old('goal')==='bulking')>زيادة وزن/كتلة</option>
                                        <option value="healthy"  @selected(old('goal')==='healthy')>صحة عامة</option>
                                        <option value="kids"     @selected(old('goal')==='kids')>أطفال</option>
                                    </select>
                                    <?php $__errorArgs = ['goal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="height_cm" class="form-label">الطول (سم)</label>
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
                                        placeholder="مثال: 175"
                                        value="<?php echo e(old('height_cm')); ?>"
                                        min="80" max="250"
                                    >
                                    <?php $__errorArgs = ['height_cm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="col-md-6">
                                    <label for="weight_kg" class="form-label">الوزن (كجم)</label>
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
                                        placeholder="مثال: 72.5"
                                        value="<?php echo e(old('weight_kg')); ?>"
                                        min="20" max="400"
                                    >
                                    <?php $__errorArgs = ['weight_kg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    إنشاء الحساب
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <span class="text-muted">لديك حساب بالفعل؟</span>
                                <a href="<?php echo e(route('auth.login')); ?>" class="link-success fw-semibold">تسجيل الدخول</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
    <script>
        function togglePwd(id, btn){
            const i = document.getElementById(id);
            if(!i) return;
            if(i.type === 'password'){
                i.type = 'text';
                btn.innerHTML = '<i class="fa fa-eye-slash"></i>';
            }else{
                i.type = 'password';
                btn.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/auth/register.blade.php ENDPATH**/ ?>