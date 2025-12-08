@extends('layouts.app_admin')

@section('content')
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-content">
            <h1>Welcome back, Admin!</h1>
            <p>Here's what's happening with JIC Course Catalog today.</p>

            <div class="welcome-stats">
                <div class="welcome-stat">
                    <div class="welcome-stat-value">{{ $totalCourses }}</div>
                    <div class="welcome-stat-label">Total Courses</div>
                </div>
                <div class="welcome-stat">
                    <div class="welcome-stat-value">{{ number_format($totalStudents) }}</div>
                    <div class="welcome-stat-label">Registered Students</div>
                </div>
                <div class="welcome-stat">
                    <div class="welcome-stat-value">{{ number_format($totalRatings) }}</div>
                    <div class="welcome-stat-label">Course Ratings</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card courses">
            <div class="stat-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalCourses }}</div>
                <div class="stat-label">Total Courses</div>
                <div class="stat-change {{ $newCoursesThisMonth > 0 ? 'positive' : '' }}">
                    @if($newCoursesThisMonth > 0)
                        <i class="bi bi-arrow-up-right"></i>
                        <span>{{ $newCoursesThisMonth }} new this month</span>
                    @else
                        <span>No new courses</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="stat-card students">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="stat-value">{{ number_format($totalStudents) }}</div>
                <div class="stat-label">Registered Students</div>
                <div class="stat-change {{ $studentGrowth > 0 ? 'positive' : '' }}">
                    @if($studentGrowth > 0)
                        <i class="bi bi-arrow-up-right"></i>
                        <span>{{ number_format($studentGrowth, 1) }}% growth</span>
                    @else
                        <span>Stable</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="stat-card ratings">
            <div class="stat-icon">
                <i class="bi bi-star"></i>
            </div>
            <div>
                <div class="stat-value">{{ number_format($totalRatings) }}</div>
                <div class="stat-label">Course Ratings</div>
                <div class="stat-change {{ $newRatingsToday > 0 ? 'positive' : '' }}">
                    @if($newRatingsToday > 0)
                        <i class="bi bi-arrow-up-right"></i>
                        <span>{{ $newRatingsToday }} new today</span>
                    @else
                        <span>No new ratings</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="stat-card departments">
            <div class="stat-icon">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalDepartments }}</div>
                <div class="stat-label">Departments</div>
                <div class="stat-change">
                    <span>Active</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Left Column -->
        <div>
            <!-- Quick Actions -->
            <div class="dashboard-card">
                <h3 class="section-title">Quick Actions</h3>
                <div class="actions-grid">

                    <a href="{{ route('admin.courses.index') }}" class="action-btn">
                        <i class="bi bi-pencil-square"></i>
                        <span>Manage Courses</span>
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="action-btn">
                        <i class="bi bi-person-plus"></i>
                        <span>Manage Students</span>
                    </a>
                    <a href="{{ route('admin.ratings.index') }}" class="action-btn">
                        <i class="bi bi-star"></i>
                        <span>View Ratings</span>
                    </a>
                    <a href="{{ route('admin.departments.index') }}" class="action-btn">
                        <i class="bi bi-building"></i>
                        <span>Departments</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="dashboard-card">
                <h3 class="section-title">Recent Activity</h3>
                <ul class="activity-list">
                    @forelse($recentActivities as $activity)
                        <li class="activity-item">
                            <div class="activity-icon {{ $activity['type'] }}">
                                <i class="bi bi-{{ $activity['icon'] }}"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title">{{ $activity['title'] }}</div>
                                <div class="activity-meta">{{ $activity['description'] }}</div>
                                <div class="activity-meta">{{ $activity['time'] }}</div>
                            </div>
                        </li>
                    @empty
                        <li class="activity-item">
                            <div class="activity-details text-center text-muted py-3">
                                No recent activity
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Popular Courses -->
            <div class="dashboard-card">
                <h3 class="section-title">Most Rated Courses</h3>
                <div class="course-list">
                    @forelse($mostRatedCourses as $course)
                        <div class="course-item">
                            <div class="course-icon">
                                {{ substr($course->Course_Code, 0, 2) }}
                            </div>
                            <div class="course-details">
                                <div class="course-name">{{ $course->Course_Title }}</div>
                                <div class="course-meta">{{ $course->Course_Code }}</div>
                            </div>
                            <div class="course-rating">
                                <i class="bi bi-star-fill"></i>
                                <span>{{ number_format($course->student_ratings_avg_average_difficulty_rate ?? 0, 1) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-3">
                            No courses with ratings yet
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- System Status -->
            <div class="dashboard-card">
                <h3 class="section-title">System Status</h3>
                <div class="status-grid">
                    <div class="status-item">
                        <div class="status-value status-good">100%</div>
                        <div class="status-label">Uptime</div>
                    </div>
                    <div class="status-item">
                        <div class="status-value status-good">{{ round(microtime(true) - LARAVEL_START, 1) }}s</div>
                        <div class="status-label">Response Time</div>
                    </div>
                    <div class="status-item">
                        @php
                            $diskUsage = disk_free_space('/') / disk_total_space('/') * 100;
                            $statusClass = $diskUsage > 80 ? 'status-warning' : 'status-good';
                        @endphp
                        <div class="status-value {{ $statusClass }}">{{ 100 - round($diskUsage) }}%</div>
                        <div class="status-label">Storage Free</div>
                    </div>
                    <div class="status-item">
                        <div class="status-value status-good">Live</div>
                        <div class="status-label">System</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
