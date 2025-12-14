<ul class="secondary-nav-menu">
    <li class="nav-item">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('admin.students.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.students*') ? 'active' : ''); ?>">
            <i class="bi bi-people"></i>
            Students
            <span class="nav-badge"><?php echo e(App\Models\Student::count()); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('admin.courses.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.courses*') ? 'active' : ''); ?>">
            <i class="bi bi-journal-text"></i>
            Courses
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo e(route('admin.majors.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.majors*') ? 'active' : ''); ?>">
            <i class="bi bi-journals"></i>
            Majors
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('admin.departments.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.departments*') ? 'active' : ''); ?>">
            <i class="bi bi-building"></i>
            Departments
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('admin.ratings.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.ratings*') ? 'active' : ''); ?>">
            <i class="bi bi-star"></i>
            Ratings
            <span class="nav-badge bg-danger"><?php echo e(App\Models\StudentCourse::count()); ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-gear"></i>
            Settings
        </a>
    </li>
</ul>
<?php /**PATH C:\laragon\www\jic_catalog\resources\views/layouts/nav_admin.blade.php ENDPATH**/ ?>