
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('auth.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="display-6 fw-bold mb-3">Join Pharmahub Today</h1>
                    <h4 class="lead text-white">Create your account and start your healthcare journey with us</h4>

                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Sign Up</h2>
                <p class="auth-subtitle">Fill in your details to get started</p>
            </div>

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Basic Information -->
                <div class="form-section">
                    <h5 class="section-title">Basic Information</h5>

                  <div class="row">
                      <div class="mb-3 col-md-6">
                          <label class="form-label">Full Name <span class="text-danger">*</span></label>
                          <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                                 class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                 required>
                          <?php $__errorArgs = ['name'];
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

                      <div class="mb-3 col-md-6">
                          <label class="form-label">Email Address <span class="text-danger">*</span></label>
                          <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                                 class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  required>
                          <?php $__errorArgs = ['email'];
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

                      <div class="mb-3 col-md-6">
                          <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                          <div class="input-group">
                              <span class="input-group-text">+966</span>
                              <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                                     class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                     placeholder="5X XXX XXXX"
                                     pattern="05[0-9]{8}"
                                     title="Enter a valid Saudi phone number (5X XXX XXXX)"
                                     required>
                          </div>
                          <?php $__errorArgs = ['phone'];
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

                      <div class="mb-3 col-md-6">
                          <label class="form-label">Address <span class="text-danger">*</span></label>
                          <input type="text" name="address" value="<?php echo e(old('address')); ?>"
                                 class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                 required>
                          <?php $__errorArgs = ['address'];
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
                </div>

                <!-- Security Information -->
                <div class="form-section">
                    <h5 class="section-title">Security Information</h5>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password"
                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Create a strong password" required>
                        <div class="password-requirements">
                            <small class="form-text text-muted">Must be at least 8 characters long</small>
                        </div>
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

                        <div class="mb-3 col-md-6">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation"
                               class="form-control"
                               placeholder="Confirm your password" required>
                    </div>
                    </div>
                </div>

                <!-- Account Type -->
                <div class="form-section">
                    <h5 class="section-title">Account Type</h5>

                    <div class="mb-3">
                        <label class="form-label">I want to register as <span class="text-danger">*</span></label>
                        <select name="role" id="role"
                                class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Account Type</option>
                            <option value="Customer" <?php echo e(old('role')=='Customer' ? 'selected' : ''); ?>>
                                🛒 Customer - Buy medicines
                            </option>
                            <option value="Vendor" <?php echo e(old('role')=='Vendor' ? 'selected' : ''); ?>>
                                🏪 Vendor - Sell medicines
                            </option>
                        </select>
                        <?php $__errorArgs = ['role'];
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

                <!-- Vendor-specific fields -->
                <div id="vendor-fields" class="form-section" style="display:none;">
                    <h5 class="section-title">Pharmacy Information</h5>
                    <div class="vendor-info-alert">
                        <i class="fas fa-info-circle"></i>
                        <span>Vendor accounts require admin approval before activation</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pharmacy Name <span class="text-danger">*</span></label>
                        <input type="text" name="pharmacy_name" value="<?php echo e(old('pharmacy_name')); ?>"
                               class="form-control <?php $__errorArgs = ['pharmacy_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Enter your pharmacy name">
                        <?php $__errorArgs = ['pharmacy_name'];
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

                    <div class="mb-3">
                        <label class="form-label">License Number <span class="text-danger">*</span></label>
                        <input type="text" name="license_number" value="<?php echo e(old('license_number')); ?>"
                               class="form-control <?php $__errorArgs = ['license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Enter your pharmacy license number">
                        <?php $__errorArgs = ['license_number'];
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

                    <div class="mb-3">
                        <label class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" value="<?php echo e(old('location')); ?>"
                               class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Enter your pharmacy location">
                        <?php $__errorArgs = ['location'];
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

                <!-- Terms and Conditions -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a> <span class="text-danger">*</span>
                    </label>
                </div>

                <button type="submit" class="btn-custom w-100">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p class="text-center">Already have an account?
                    <a href="<?php echo e(route('login')); ?>" class="text-primary fw-semibold">Sign In</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        const roleSelect = document.getElementById('role');
        const vendorFields = document.getElementById('vendor-fields');
        const vendorInputs = vendorFields.querySelectorAll('input');

        function toggleVendorFields() {
            if (roleSelect.value === 'Vendor') {
                vendorFields.style.display = 'block';
                // Make vendor fields required
                vendorInputs.forEach(input => {
                    input.required = true;
                });
            } else {
                vendorFields.style.display = 'none';
                // Remove required attribute from vendor fields
                vendorInputs.forEach(input => {
                    input.required = false;
                });
            }
        }

        // Initialize on page load and on change
        roleSelect.addEventListener('change', toggleVendorFields);

        // Show vendor fields if there are validation errors
        document.addEventListener('DOMContentLoaded', function() {
            toggleVendorFields();

            // If there are validation errors for vendor fields, show the section
            <?php if($errors->has('pharmacy_name') || $errors->has('license_number') || $errors->has('location')): ?>
                vendorFields.style.display = 'block';
            roleSelect.value = 'Vendor';
            toggleVendorFields();
            <?php endif; ?>
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/auth/register.blade.php ENDPATH**/ ?>