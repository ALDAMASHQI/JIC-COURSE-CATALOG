<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-nowrap logo-img">
                <img style="height: 110px;" src="<?php echo e(asset('assets/logo1.png')); ?>" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- عرض اسم المسؤول -->
        <div class="user-info text-center p-3 rounded">
            <h6 class="mb-0">مرحبًا،  <?php echo e(auth()->user()->name); ?></h6>
            <small class="text-muted"><?php echo e(auth()->user()->role); ?></small>
        </div>
        <nav class="sidebar-nav scroll-sidebar mt-3" data-simplebar>
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.dashboard')); ?>" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">لوحة التحكم</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('admin.profile') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.profile')); ?>" aria-expanded="false">
                        <span><i class="ti ti-user"></i></span>
                        <span class="hide-menu">الملف الشخصي</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                       class="sidebar-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                        <span><i class="ti ti-user"></i></span>
                        إدارة المستخدمين
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.workout-plans.index')); ?>"
                       class="sidebar-link <?php echo e(request()->routeIs('admin.workout-plans.*') ? 'active' : ''); ?>">
                        <span><i class="fa fa-dumbbell"></i></span>
                        خطط التمارين
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.nutrition-plans.index')); ?>"
                       class="sidebar-link <?php echo e(request()->routeIs('admin.nutrition-plans.*') ? 'active' : ''); ?>">
                        <span><i class="fas fa-utensils"></i></span>
                        الخطط الغذائية
                    </a>
                </li>


                <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.feedback.index')); ?>"
                       class="sidebar-link <?php echo e(request()->routeIs('admin.feedback.*') ? 'active' : ''); ?>">
                        <span><i class="fas fa-star"></i></span>
                       تقيمات المستخدمين
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH C:\laragon\www\ubs\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>