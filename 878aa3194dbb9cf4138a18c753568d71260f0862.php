<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('vendor.dashboard')); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pharmahub Vendor</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo e(route('vendor.dashboard')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Products</div>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-pills"></i>
            <span>All Products</span>
        </a>
    </li>

    <!-- Nav Item - Add Product -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Add Product</span>
        </a>
    </li>

    <!-- Nav Item - Categories -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tags"></i>
            <span>Categories</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Sales</div>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Orders</span>
            <span class="badge badge-danger badge-counter"><?php echo e(auth()->user()->vendor->orders_count ?? 0); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Payments</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Reviews & Analytics</div>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-star"></i>
            <span>Reviews</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Analytics</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<?php /**PATH C:\laragon\www\pharmaHub\resources\views/layouts/vendor/sidebar.blade.php ENDPATH**/ ?>