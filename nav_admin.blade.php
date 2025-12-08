<ul class="secondary-nav-menu">
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            Students
            <span class="nav-badge">{{ App\Models\Student::count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i>
            Courses
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.majors.index') }}" class="nav-link {{ request()->routeIs('admin.majors*') ? 'active' : '' }}">
            <i class="bi bi-journals"></i>
            Majors
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.departments.index') }}" class="nav-link {{ request()->routeIs('admin.departments*') ? 'active' : '' }}">
            <i class="bi bi-building"></i>
            Departments
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.ratings.index') }}" class="nav-link {{ request()->routeIs('admin.ratings*') ? 'active' : '' }}">
            <i class="bi bi-star"></i>
            Ratings
            <span class="nav-badge bg-danger">{{ App\Models\StudentCourse::count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="bi bi-gear"></i>
            Settings
        </a>
    </li>
</ul>
