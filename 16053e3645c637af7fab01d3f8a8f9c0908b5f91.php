<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="text-nowrap logo-img">
                <img style="height: 110px;" src="<?php echo e(asset('assets/logo1.png')); ?>" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- عرض اسم المستخدم ودوره -->
        <div class="user-info text-center p-3 rounded">
            <h6 class="mb-0">مرحبًا بك، <?php echo e(auth()->user()->name); ?></h6>
        </div>

        <nav class="sidebar-nav scroll-sidebar mt-3" data-simplebar>
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>"
                       href="<?php echo e(route('user.dashboard')); ?>" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu"> الصفحة الرئيسية </span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('user.profile') ? 'active' : ''); ?>"
                       href="<?php echo e(route('user.profile')); ?>" aria-expanded="false">
                        <span><i class="ti ti-user"></i></span>
                        <span class="hide-menu">الملف الشخصي</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('user.my.workout') ? 'active' : ''); ?>"
                       href="<?php echo e(route('user.my.workout')); ?>">
                        <span><i class="fa fa-dumbbell"></i></span>
                        <span class="hide-menu">خطة التمارين الخاصة بي</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('user.my.nutrition') ? 'active' : ''); ?>"
                       href="<?php echo e(route('user.my.nutrition')); ?>">
                        <span><i class="fas fa-utensils"></i></span>

                        <span class="hide-menu">الخطة الغذائية الخاصة بي</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo e(route('home')); ?>" target="_blank" rel="noopener"
                       class="sidebar-link">
                        <span><i class="fas fa-external-link-alt"></i></span>
                        الموقع
                    </a>
                </li>



            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH C:\laragon\www\ubs\resources\views/user/layouts/sidebar.blade.php ENDPATH**/ ?>