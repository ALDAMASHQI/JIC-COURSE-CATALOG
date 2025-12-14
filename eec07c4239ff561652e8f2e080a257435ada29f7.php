<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Vendor Dashboard - Pharmahub'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('dash.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
<!-- Sidebar Navigation -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="<?php echo e(asset('logo.png')); ?>" style="height: 60px;" alt="Pharmahub Logo">
    </div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?php echo e(route('vendor.dashboard')); ?>"
               class="<?php echo e(request()->routeIs('vendor.dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-chart-line"></i> <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('vendor.products.index')); ?>"
               class="<?php echo e(request()->routeIs('vendor.products.*') ? 'active' : ''); ?>">
                <i class="fas fa-pills"></i> <span>Products</span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('vendor.orders.index')); ?>" class="<?php echo e(request()->routeIs('vendor.orders.*') ? 'active' : ''); ?>">
                <i class="fas fa-shopping-cart"></i> <span>Orders</span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('vendor.reviews.index')); ?>" class="<?php echo e(request()->routeIs('vendor.reviews.*') ? 'active' : ''); ?>">
                <i class="fas fa-star"></i> <span>Reviews</span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('vendor.profile.index')); ?>" class="<?php echo e(request()->routeIs('vendor.profile.*') ? 'active' : ''); ?>">
                <i class="fas fa-store"></i> <span>Profile Info</span>
            </a>
        </li>



        <li>
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content" id="main-content">
    <!-- Header -->
    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="toggle-sidebar" id="toggle-sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4 class="mb-0" style="color: var(--dark-blue);"><?php echo $__env->yieldContent('page-title', 'Dashboard Overview'); ?></h4>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown me-3">
                <button class="btn notification-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge"><?php echo e(count(getNotifications())); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">Latest Orders</li>
                    <?php $__empty_1 = true; $__currentLoopData = getNotifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('vendor.orders.index')); ?>">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Order #<?php echo e($order->order_id); ?> - <?php echo e(ucfirst($order->status)); ?>

                                <br>
                                <small class="text-muted"><?php echo e($order->order_date->format('d M Y h:i A')); ?></small>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li><span class="dropdown-item text-muted">No new orders</span></li>
                    <?php endif; ?>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-center" href="<?php echo e(route('vendor.orders.index')); ?>">
                            View All Orders
                        </a>
                    </li>
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn user-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <span><?php echo e(auth()->user()->name); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?php echo e(route('vendor.profile.index')); ?>"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container-fluid">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleButton = document.getElementById('toggle-sidebar');

        // Check if sidebar state is stored in localStorage
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

        // Set initial state
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
        }

        // Toggle sidebar
        toggleButton.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            // Store state in localStorage
            const isNowCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isNowCollapsed);

            // Update icon
            if (isNowCollapsed) {
                toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
            } else {
                toggleButton.innerHTML = '<i class="fas fa-times"></i>';
            }
        });

        // Make sidebar items clickable
        const sidebarItems = document.querySelectorAll('.sidebar-nav a');
        sidebarItems.forEach(item => {
            item.addEventListener('click', function (e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }

                // Remove active class from all items
                sidebarItems.forEach(i => i.classList.remove('active'));

                // Add active class to clicked item
                this.classList.add('active');

                // If sidebar is collapsed on mobile, close it after selection
                if (window.innerWidth < 992) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                    toggleButton.innerHTML = '<i class="fas fa-bars"></i>';
                    localStorage.setItem('sidebarCollapsed', 'true');
                }
            });
        });

        // Auto-close alerts
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.parentNode) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });
    });
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\pharmahub\resources\views/layouts/vendor.blade.php ENDPATH**/ ?>