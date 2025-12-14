

<?php $__env->startSection('title', 'تسجيل الدخول'); ?>

<?php $__env->startSection('content'); ?>

    <section style="margin-top: 60px;" class="login-page sec-pad text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-5">
                    <div class="login-form bg-white rounded shadow p-4">

                        <h4 class="mb-3 fw-bold">تسجيل الدخول</h4>
                        <p class="text-muted">يرجى اختيار نوع الحساب وإدخال بيانات تسجيل الدخول</p>

                        <form action="<?php echo e(route('auth.login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3 text-start">
                                <label class="form-label" for="email">البريد الإلكتروني <span class="text-danger">*</span></label>
                                <input style="direction: rtl;" type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group mb-3 text-start">
                                <label for="password">كلمة المرور <span class="text-danger">*</span></label>
                                <input style="direction: rtl;" type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required autocomplete="new-password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">تسجيل الدخول</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-1">ليس لديك حساب؟ <a href="<?php echo e(route('auth.register')); ?>">اضغط هنا للتسجيل</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- التفاعل مع اختيار الدور -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const boxes = document.querySelectorAll(".user-type-box");
            const hiddenInput = document.getElementById("selected_user_role");

            boxes.forEach(box => {
                box.addEventListener("click", function () {
                    boxes.forEach(b => b.classList.remove("selected"));
                    this.classList.add("selected");
                    hiddenInput.value = this.dataset.value;
                });
            });
        });
    </script>

    <!-- تنسيق إضافي -->
    <style>
        .user-type-box {
            cursor: pointer;
            border: 2px solid transparent;
            transition: 0.3s;
        }

        .user-type-box:hover,
        .user-type-box.selected {
            border-color: #111948;
            background-color: #e3f2fd;
        }

        .login-form {
            border: 1px solid #ddd;
        }
        .blo {
            font-size: 9px;
            font-weight: bolder;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\fit_now\resources\views/auth/login.blade.php ENDPATH**/ ?>