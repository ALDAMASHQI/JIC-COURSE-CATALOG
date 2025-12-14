<ul class="navbar-nav m-auto">
    <li class="nav-item">
        <a class="nav-link active" href="<?php echo e(url('/')); ?>">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('products.index')); ?>">Medicines</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('/')); ?>#cats">Categories</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('vendors.index')); ?>">Pharmacies</a>
    </li>

</ul>
<div class="d-flex align-items-center">
    
    <a href="<?php echo e(route('cart.view')); ?>" class="btn btn-outline-primary me-2">
        <i class="fas fa-shopping-cart"></i>
        Cart
        <span class="badge bg-danger ms-1 cart-count">
            <?php echo e(auth()->check() ? auth()->user()->orders()->where('status', 'pending')->first()?->orderItems->sum('quantity') ?? 0 : 0); ?>

        </span>
    </a>

    
    <div class="dropdown">
        <?php if(auth()->guard()->check()): ?>
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-1"></i> <?php echo e(auth()->user()->name); ?>

            </button>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="<?php echo e(route('customer.profile')); ?>"><i class="fas fa-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('customer.orders')); ?>"><i class="fas fa-file me-2"></i> Orders</a></li>
                <li>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        <?php else: ?>
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-1"></i> Account
            </button>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt me-2"></i> Login</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('register')); ?>"><i class="fas fa-user-plus me-2"></i> Register</a></li>
            </ul>
        <?php endif; ?>
    </div>
</div>

<?php /**PATH C:\laragon\www\pharmaHub\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>