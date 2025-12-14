<?php $__env->startPush('css'); ?>
    <style>
        .text-primary {
            --bs-text-opacity: 1;
            color: rgb(200 159 75) !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <h1 class="hero-title">Plan Your Academic Journey with Confidence</h1>
                        <p class="hero-subtitle">Access comprehensive course information, difficulty ratings, and student feedback from Jubail Industrial College to make informed decisions about your education.</p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-primary btn-lg"><i class="bi bi-search me-2"></i> Browse Courses</a>
                            <a href="<?php echo e(route('majors.index')); ?>" class="btn btn-outline-light btn-lg"><i class="bi bi-list-columns me-2"></i> Explore Majors</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">How Our System Helps You Succeed</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-search-heart"></i>
                        </div>
                        <h4>Smart Course Search</h4>
                        <p>Find courses by name, code, department, or keywords with detailed information including prerequisites and learning outcomes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Difficulty Ratings</h4>
                        <p>See how other students rated course difficulty and workload to balance your semester schedule effectively.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h4>Detailed Course Information</h4>
                        <p>Access comprehensive course details including descriptions, credit hours, assessment methods, and learning styles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="<?php echo e($totalCourses); ?>"><?php echo e($totalCourses); ?>+</div>
                        <div class="stat-label">Courses</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="<?php echo e($totalMajors); ?>"><?php echo e($totalMajors); ?>+</div>
                        <div class="stat-label">Majors</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="<?php echo e($totalRatings); ?>"><?php echo e(number_format($totalRatings)); ?>+</div>
                        <div class="stat-label">Student Ratings</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="<?php echo e($satisfactionRate); ?>"><?php echo e($satisfactionRate); ?>%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Popular Courses & Student Favorites</h2>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $popularCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card course-card">
                            <div class="course-card-header">
                                <h5 class="mb-2 text-white"><?php echo e($course->Course_Title); ?></h5>
                                <div class="course-rating">
                                    <span class="rating-stars">
                                        <?php
                                            $avgRating = $course->student_ratings_avg_average_difficulty_rate ?? 0;
                                            $fullStars = floor($avgRating);
                                            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                        ?>

                                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>

                                        <?php if($hasHalfStar): ?>
                                            <i class="bi bi-star-half"></i>
                                        <?php endif; ?>

                                        <?php for($i = 0; $i < $emptyStars; $i++): ?>
                                            <i class="bi bi-star"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <span class="ms-1"><?php echo e(number_format($avgRating, 1)); ?>/5</span>
                                </div>
                            </div>
                            <div class="course-card-body">
                                <p class="card-text"><?php echo e(Str::limit($course->Course_Description, 50)); ?></p>
                                <div class="course-meta">
                                    <span class="course-badge"><i class="bi bi-clock me-1"></i> <?php echo e($course->Credit_Hours); ?> Credits</span>
                                    <span class="text-muted">
                                        <i class="bi bi-bar-chart-fill me-1"></i>
                                        Difficulty:
                                        <strong class="<?php if($avgRating >= 4): ?> text-danger <?php elseif($avgRating >= 3): ?> text-warning <?php else: ?> text-info <?php endif; ?>">
                                            <?php echo e(number_format($avgRating, 1)); ?>/5
                                        </strong>
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>
                                        <?php echo e($course->total_ratings); ?> ratings
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            No courses with ratings available yet. Be the first to rate a course!
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-5">
                <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-accent btn-lg px-5 shadow-sm"><i class="bi bi-journals me-2"></i> Explore Full Catalog</a>
            </div>
        </div>
    </section>

    <section id="FeaturedMajors" class="py-5 bg-light">
        <div class="container">
            <h2  class="section-title">Featured Majors</h2>
            <div  class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $featuredMajors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card major-card text-center h-100">
                            <div class="major-card-header">
                                <div class="major-icon">
                                    <i class="bi bi-laptop"></i>
                                </div>
                                <h5><?php echo e($major->Major_Name); ?></h5>
                                <span class="department-badge"><?php echo e($major->department->Dept_Name ?? 'General'); ?></span>
                            </div>
                            <div class="major-card-body">
                                <p class="card-text"><?php echo e(Str::limit($major->Major_Description ?? 'Comprehensive program offering in-depth knowledge and practical skills.', 100)); ?></p>
                                <div class="major-meta">
                                    <span class="credits-badge">
                                        <i class="bi bi-award me-1"></i>
                                        <?php echo e($major->Required_Credits); ?> Credits Required
                                    </span>
                                </div>
                            </div>
                            <div class="major-card-footer">
                                <a href="<?php echo e(route('courses.index')); ?>?Major_ID=<?php echo e($major->Major_ID); ?>" class="btn btn-outline-primary btn-sm">Explore Courses</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            No majors available at the moment.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="Departments" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">Departments</h2>

            <div class="row g-4">
                <?php $__currentLoopData = \App\Models\Department::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-diagram-3 fs-1 text-primary"></i>
                                </div>
                                <h5 class="card-title"><?php echo e($department->Dept_Name); ?></h5>

                                <p class="text-muted mb-2">
                                    <?php echo e($department->majors->count()); ?> Majors
                                </p>

                                <a href="<?php echo e(route('courses.index', ['category' => $department->Dept_Name])); ?>"
                                   class="btn btn-outline-primary btn-sm">
                                    Explore Courses
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if(\App\Models\Department::all()->isEmpty()): ?>
                <div class="alert alert-info text-center mt-4">
                    <i class="bi bi-info-circle"></i> No departments available yet.
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/home.blade.php ENDPATH**/ ?>