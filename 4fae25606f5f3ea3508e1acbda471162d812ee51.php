<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('logo.png')); ?>" height="90" alt="JIC Logo">
            JIC <span>Catalog</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"
                       href="<?php echo e(route('home')); ?>">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('courses.index') || request()->routeIs('courses.show') ? 'active' : ''); ?>"
                       href="<?php echo e(route('courses.index')); ?>">
                        Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Majors
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Departments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isStudent()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                               href="<?php echo e(route('dashboard')); ?>">
                                Dashboard
                            </a>
                        </li>
                    <?php elseif(Auth::user()->isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.*') ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.dashboard')); ?>">
                                Admin Dashboard
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                <?php if(auth()->guard()->check()): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle d-flex align-items-center"
                                type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>
                            <div class="text-start">
                                <div class="small fw-bold"><?php echo e(Auth::user()->Username); ?></div>
                                <div class="x-small text-muted">
                                    <?php if(Auth::user()->isAdmin()): ?>
                                        <i class="bi bi-shield-check me-1"></i>Admin
                                    <?php else: ?>
                                        <i class="bi bi-person me-1"></i>Student
                                    <?php endif; ?>
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-gear me-2"></i>Settings
                                </a>
                            </li>
                            <?php if(Auth::user()->isStudent()): ?>
                                <li>
                                    <a class="dropdown-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                                       href="<?php echo e(route('dashboard')); ?>">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                            <?php elseif(Auth::user()->isAdmin()): ?>
                                <li>
                                    <a class="dropdown-item <?php echo e(request()->routeIs('admin.*') ? 'active' : ''); ?>"
                                       href="<?php echo e(route('admin.dashboard')); ?>">
                                        <i class="bi bi-shield-check me-2"></i>Admin Panel
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>"
                       class="btn btn-outline-dark me-2 <?php echo e(request()->routeIs('login') ? 'active' : ''); ?>">
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>"
                       class="btn btn-primary <?php echo e(request()->routeIs('register') ? 'active' : ''); ?>">
                        Sign Up
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\jic_catalog\resources\views/layouts/nav.blade.php ENDPATH**/ ?>