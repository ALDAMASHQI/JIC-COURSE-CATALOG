

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Admin Profile</h1>
        <p class="page-description">Manage your profile information and account settings</p>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <div class="row">
            <!-- Left Column - Profile Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person-gear me-2"></i>
                            Profile Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Please fix the following errors:
                                <ul class="mb-0 mt-1">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Admin Information Section -->
                            <div class="section-header mb-4">
                                <h6 class="section-title">
                                    <i class="bi bi-person-badge me-2"></i>
                                    Admin Information
                                </h6>
                                <div class="section-divider"></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="Admin_Name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['Admin_Name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="Admin_Name" name="Admin_Name"
                                           value="<?php echo e(old('Admin_Name', $admin->Admin_Name)); ?>" required
                                           placeholder="Enter your full name">
                                    <?php $__errorArgs = ['Admin_Name'];
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
                                    <label for="Admin_Email" class="form-label">Admin Email *</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['Admin_Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="Admin_Email" name="Admin_Email"
                                           value="<?php echo e(old('Admin_Email', $admin->Admin_Email)); ?>" required
                                           placeholder="Enter your admin email">
                                    <?php $__errorArgs = ['Admin_Email'];
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

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="Admin_Role" class="form-label">Role *</label>
                                    <select class="form-select <?php $__errorArgs = ['Admin_Role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="Admin_Role" name="Admin_Role" required>
                                        <option value="">Select Role</option>
                                        <option value="Super Admin" <?php echo e(old('Admin_Role', $admin->Admin_Role) == 'Super Admin' ? 'selected' : ''); ?>>Super Admin</option>
                                        <option value="Administrator" <?php echo e(old('Admin_Role', $admin->Admin_Role) == 'Administrator' ? 'selected' : ''); ?>>Administrator</option>
                                        <option value="Moderator" <?php echo e(old('Admin_Role', $admin->Admin_Role) == 'Moderator' ? 'selected' : ''); ?>>Moderator</option>
                                        <option value="Content Manager" <?php echo e(old('Admin_Role', $admin->Admin_Role) == 'Content Manager' ? 'selected' : ''); ?>>Content Manager</option>
                                        <option value="Support" <?php echo e(old('Admin_Role', $admin->Admin_Role) == 'Support' ? 'selected' : ''); ?>>Support</option>
                                    </select>
                                    <?php $__errorArgs = ['Admin_Role'];
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
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control"
                                           value="<?php echo e($admin->department->Dept_Name ?? 'Not Assigned'); ?>"
                                           readonly
                                           style="background-color: #f8f9fa;">
                                    <div class="form-text">Department assignment can be changed by Super Admin</div>
                                </div>
                            </div>

                            <!-- Account Information Section -->
                            <div class="section-header mb-4">
                                <h6 class="section-title">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Account Information
                                </h6>
                                <div class="section-divider"></div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="Username" class="form-label">Username *</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['Username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="Username" name="Username"
                                           value="<?php echo e(old('Username', auth()->user()->Username)); ?>" required
                                           placeholder="Enter your username">
                                    <?php $__errorArgs = ['Username'];
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
                                    <label for="Email" class="form-label">Login Email *</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['Email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="Email" name="Email"
                                           value="<?php echo e(old('Email', auth()->user()->Email)); ?>" required
                                           placeholder="Enter your login email">
                                    <?php $__errorArgs = ['Email'];
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

                            <!-- Password Change Section -->
                            <div class="section-header mb-4">
                                <h6 class="section-title">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Password Change
                                </h6>
                                <div class="section-divider"></div>
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="current_password" name="current_password"
                                           placeholder="Enter current password">
                                    <?php $__errorArgs = ['current_password'];
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

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="password" name="password"
                                           placeholder="Enter new password">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-text">Minimum 8 characters</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation"
                                           placeholder="Confirm new password">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Update Profile
                                    </button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Profile Summary -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body text-center">
                        <div class="profile-avatar mb-3">
                            <div class="avatar-circle">
                                <?php echo e(strtoupper(substr(auth()->user()->Username, 0, 2))); ?>

                            </div>
                        </div>
                        <h5 class="card-title"><?php echo e($admin->Admin_Name); ?></h5>
                        <p class="card-text text-muted mb-2"><?php echo e($admin->Admin_Role); ?></p>
                        <p class="card-text small text-muted">
                            <i class="bi bi-building me-1"></i>
                            <?php echo e($admin->department->Dept_Name ?? 'No Department'); ?>

                        </p>
                    </div>
                </div>

                <!-- Security Tips Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-shield-check me-2"></i>
                            Security Tips
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Use a strong, unique password
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Update your password regularly
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Keep your email updated
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Log out from shared devices
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .section-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, #ffffff, transparent);
            margin-top: 5px;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #bc960b 0%, #df8224 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-stats .stat-item {
            padding: 10px 0;
        }

        .profile-stats .stat-value {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .profile-stats .stat-label {
            color: #6c757d;
            font-size: 0.8rem;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }

        .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 25px;
            font-weight: 500;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .alert {
            border: none;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: #28a745;
            background-color: #f8fff9;
        }

        .alert-danger {
            border-left-color: #dc3545;
            background-color: #fff8f8;
        }

        .list-unstyled li {
            padding: 5px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .list-unstyled li:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .avatar-circle {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 15px;
            }

            .d-flex.justify-content-between > div {
                text-align: center;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/admin/profile.blade.php ENDPATH**/ ?>