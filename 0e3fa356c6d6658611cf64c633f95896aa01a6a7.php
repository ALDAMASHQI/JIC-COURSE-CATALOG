

<?php $__env->startSection('content'); ?>
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-content">
            <h1>Welcome back, Admin!</h1>
            <p>Here's what's happening with JIC Course Catalog today.</p>

            <div class="welcome-stats">
                <div class="welcome-stat">
                    <div class="welcome-stat-value"><?php echo e($totalCourses); ?></div>
                    <div class="welcome-stat-label">Total Courses</div>
                </div>
                <div class="welcome-stat">
                    <div class="welcome-stat-value"><?php echo e(number_format($totalStudents)); ?></div>
                    <div class="welcome-stat-label">Registered Students</div>
                </div>
                <div class="welcome-stat">
                    <div class="welcome-stat-value"><?php echo e(number_format($totalRatings)); ?></div>
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
                <div class="stat-value"><?php echo e($totalCourses); ?></div>
                <div class="stat-label">Total Courses</div>
                <div class="stat-change <?php echo e($newCoursesThisMonth > 0 ? 'positive' : ''); ?>">
                    <?php if($newCoursesThisMonth > 0): ?>
                        <i class="bi bi-arrow-up-right"></i>
                        <span><?php echo e($newCoursesThisMonth); ?> new this month</span>
                    <?php else: ?>
                        <span>No new courses</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="stat-card students">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="stat-value"><?php echo e(number_format($totalStudents)); ?></div>
                <div class="stat-label">Registered Students</div>
                <div class="stat-change <?php echo e($studentGrowth > 0 ? 'positive' : ''); ?>">
                    <?php if($studentGrowth > 0): ?>
                        <i class="bi bi-arrow-up-right"></i>
                        <span><?php echo e(number_format($studentGrowth, 1)); ?>% growth</span>
                    <?php else: ?>
                        <span>Stable</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="stat-card ratings">
            <div class="stat-icon">
                <i class="bi bi-star"></i>
            </div>
            <div>
                <div class="stat-value"><?php echo e(number_format($totalRatings)); ?></div>
                <div class="stat-label">Course Ratings</div>
                <div class="stat-change <?php echo e($newRatingsToday > 0 ? 'positive' : ''); ?>">
                    <?php if($newRatingsToday > 0): ?>
                        <i class="bi bi-arrow-up-right"></i>
                        <span><?php echo e($newRatingsToday); ?> new today</span>
                    <?php else: ?>
                        <span>No new ratings</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="stat-card departments">
            <div class="stat-icon">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <div class="stat-value"><?php echo e($totalDepartments); ?></div>
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

                    <a href="<?php echo e(route('admin.courses.index')); ?>" class="action-btn">
                        <i class="bi bi-pencil-square"></i>
                        <span>Manage Courses</span>
                    </a>
                    <a href="<?php echo e(route('admin.students.index')); ?>" class="action-btn">
                        <i class="bi bi-person-plus"></i>
                        <span>Manage Students</span>
                    </a>
                    <a href="<?php echo e(route('admin.ratings.index')); ?>" class="action-btn">
                        <i class="bi bi-star"></i>
                        <span>View Ratings</span>
                    </a>
                    <a href="<?php echo e(route('admin.departments.index')); ?>" class="action-btn">
                        <i class="bi bi-building"></i>
                        <span>Departments</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="dashboard-card">
                <h3 class="section-title">Recent Activity</h3>
                <ul class="activity-list">
                    <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="activity-item">
                            <div class="activity-icon <?php echo e($activity['type']); ?>">
                                <i class="bi bi-<?php echo e($activity['icon']); ?>"></i>
                            </div>
                            <div class="activity-details">
                                <div class="activity-title"><?php echo e($activity['title']); ?></div>
                                <div class="activity-meta"><?php echo e($activity['description']); ?></div>
                                <div class="activity-meta"><?php echo e($activity['time']); ?></div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="activity-item">
                            <div class="activity-details text-center text-muted py-3">
                                No recent activity
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Popular Courses -->
            <div class="dashboard-card">
                <h3 class="section-title">Most Rated Courses</h3>
                <div class="course-list">
                    <?php $__empty_1 = true; $__currentLoopData = $mostRatedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="course-item">
                            <div class="course-icon">
                                <?php echo e(substr($course->Course_Code, 0, 2)); ?>

                            </div>
                            <div class="course-details">
                                <div class="course-name"><?php echo e($course->Course_Title); ?></div>
                                <div class="course-meta"><?php echo e($course->Course_Code); ?></div>
                            </div>
                            <div class="course-rating">
                                <i class="bi bi-star-fill"></i>
                                <span><?php echo e(number_format($course->student_ratings_avg_average_difficulty_rate ?? 0, 1)); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center text-muted py-3">
                            No courses with ratings yet
                        </div>
                    <?php endif; ?>
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
                        <div class="status-value status-good"><?php echo e(round(microtime(true) - LARAVEL_START, 1)); ?>s</div>
                        <div class="status-label">Response Time</div>
                    </div>
                    <div class="status-item">
                        <?php
                            $diskUsage = disk_free_space('/') / disk_total_space('/') * 100;
                            $statusClass = $diskUsage > 80 ? 'status-warning' : 'status-good';
                        ?>
                        <div class="status-value <?php echo e($statusClass); ?>"><?php echo e(100 - round($diskUsage)); ?>%</div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>