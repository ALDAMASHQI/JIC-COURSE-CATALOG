<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - JIC Course Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('admin.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<nav class="admin-navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-logo">
                <img src="<?php echo e(asset('logo.png')); ?>" height="90" alt="JIC Logo">
                <span>JIC</span> Course Catalog
            </a>
        </div>

        <div class="nav-actions">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search courses, students...">
            </div>

            <div class="admin-profile dropdown">
                <div class="profile-dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-img">
                        <?php echo e(strtoupper(substr(Auth::user()->Username, 0, 2))); ?>

                    </div>
                    <div class="profile-info">
                        <h5><?php echo e(Auth::user()->Username); ?></h5>
                        <small class="text-muted">
                            <?php if(Auth::user()->admin): ?>
                                <?php echo e(Auth::user()->admin->Admin_Role ?? 'Administrator'); ?>

                            <?php else: ?>
                                Administrator
                            <?php endif; ?>
                        </small>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                    <li>
                        <div class="dropdown-header">
                            <div class="d-flex align-items-center">
                                <div class="profile-img-sm me-3">
                                    <?php echo e(strtoupper(substr(Auth::user()->Username, 0, 2))); ?>

                                </div>
                                <div>
                                    <h6 class="mb-0"><?php echo e(Auth::user()->Username); ?></h6>
                                    <small class="text-muted">
                                        <?php if(Auth::user()->admin): ?>
                                            <?php echo e(Auth::user()->admin->Admin_Role ?? 'Administrator'); ?>

                                        <?php else: ?>
                                            Administrator
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.profile.edit')); ?>">
                            <i class="bi bi-person me-2"></i>
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('home')); ?>" target="_blank">
                            <i class="bi bi-house me-2"></i>
                            View Site
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline w-100">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Secondary Navigation -->
    <div class="secondary-nav">
        <?php echo $__env->make('layouts.nav_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="dashboard-content">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\jic_catalog\resources\views/layouts/app_admin.blade.php ENDPATH**/ ?>