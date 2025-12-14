<?php $__env->startSection('content'); ?>
    <!-- Course Detail Header -->
    <header class="detail-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('courses.index')); ?>" class="text-white opacity-75">Courses</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page"><?php echo e($course->Course_Title); ?></li>
                </ol>
            </nav>
            <h1><?php echo e($course->Course_Title); ?></h1>
            <p class="lead opacity-90 mt-3"><?php echo e($course->Course_Description); ?></p>
            <div class="course-badges mt-3">
                <span class="badge bg-light text-dark me-2">
                    <i class="bi bi-clock me-1"></i><?php echo e($course->Credit_Hours); ?> Credits
                </span>
                <span class="badge bg-light text-dark me-2">
                    <i class="bi bi-journals me-1"></i><?php echo e($course->Course_Code); ?>

                </span>
                <?php $__currentLoopData = $course->majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge bg-primary me-2"><?php echo e($major->Major_Name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </header>

    <!-- Main Course Content -->
    <section class="course-detail-section pt-0">
        <div class="container">
            <div class="row">
                <!-- Course Overview & Rating (Left Column) -->
                <div class="col-lg-8">
                    <!-- Course Overview Card -->
                    <div class="detail-card p-4 p-md-5 mb-4">
                        <h3 class="mb-4" style="color: var(--dark-gray); font-weight: 700;">Course Details</h3>

                        <div class="mb-4">
                            <h5 style="color: var(--accent-gold); font-weight: 600;">Course Description</h5>
                            <p class="fs-5"><?php echo e($course->Course_Description); ?></p>
                        </div>

                        <hr class="my-4">

                        <!-- Prerequisites -->
                        <?php if($course->prerequisites->count() > 0): ?>
                            <div class="mb-4">
                                <h5 style="color: var(--accent-gold); font-weight: 600;">Prerequisites</h5>
                                <ul class="list-unstyled">
                                    <?php $__currentLoopData = $course->prerequisites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prereq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><i class="bi bi-arrow-right me-2 text-primary"></i>
                                            <a href="<?php echo e(route('courses.show', $prereq->prerequisite->Course_ID)); ?>" class="text-decoration-none">
                                                <?php echo e($prereq->prerequisite->Course_Code); ?> - <?php echo e($prereq->prerequisite->Course_Title); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Associated Majors -->
                        <?php if($course->majors->count() > 0): ?>
                            <div class="mb-4">
                                <h5 style="color: var(--accent-gold); font-weight: 600;">Available in Majors</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $course->majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-info text-dark"><?php echo e($major->Major_Name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="alert alert-info mt-4" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            Course Code: <span class="fw-bold"><?php echo e($course->Course_Code); ?></span> |
                            Credit Hours: <span class="fw-bold"><?php echo e($course->Credit_Hours); ?></span>
                        </div>
                    </div>

                    <!-- Rating Summary and Reviews Section -->
                    <div  class="detail-card p-4 p-md-5 mb-4">
                        <h3 class="mb-4" style="color: var(--primary-dark); font-weight: 700;">Student Ratings & Reviews</h3>

                        <?php if($totalRatings > 0): ?>
                            <div class="row align-items-center mb-4">
                                <div class="col-md-4 text-center">
                                    <div class="rating-display" style="font-size: 3.5rem; line-height: 1;">
                                        <?php echo e(number_format($course->student_ratings_avg_average_difficulty_rate, 1)); ?>

                                    </div>
                                    <div class="rating-stars mb-2" style="font-size: 1.5rem;">
                                        <?php
                                            $avgRating = $course->student_ratings_avg_average_difficulty_rate;
                                            $fullStars = floor($avgRating);
                                            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                        ?>
                                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        <?php endfor; ?>
                                        <?php if($hasHalfStar): ?>
                                            <i class="bi bi-star-half text-warning"></i>
                                        <?php endif; ?>
                                        <?php for($i = 0; $i < (5 - $fullStars - ($hasHalfStar ? 1 : 0)); $i++): ?>
                                            <i class="bi bi-star text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="text-muted mb-0 fw-bold">(Based on <?php echo e($totalRatings); ?> ratings)</p>
                                </div>
                                <div class="col-md-8">
                                    <!-- Rating bars -->
                                    <?php for($stars = 5; $stars >= 1; $stars--): ?>
                                        <div class="mb-2 d-flex align-items-center">
                                            <span class="me-2" style="width: 60px;"><?php echo e($stars); ?> Stars</span>
                                            <div class="progress flex-grow-1" style="height: 10px; border-radius: 5px;">
                                                <div class="progress-bar
                                                <?php if($stars >= 4): ?> bg-success
                                                <?php elseif($stars >= 3): ?> bg-info
                                                <?php elseif($stars >= 2): ?> bg-warning
                                                <?php else: ?> bg-danger
                                                <?php endif; ?>"
                                                     role="progressbar"
                                                     style="width: <?php echo e($ratingPercentages[$stars]); ?>%;"
                                                     aria-valuenow="<?php echo e($ratingPercentages[$stars]); ?>"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                            <span class="ms-2 text-muted fw-bold" style="width: 50px; text-align: right;">
                                            <?php echo e(number_format($ratingPercentages[$stars], 1)); ?>%
                                        </span>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <h5 class="mt-5 mb-3" style="color: var(--primary-dark); border-bottom: 2px solid var(--light-gray); padding-bottom: 5px;">
                                Recent Student Reviews:
                            </h5>

                            <!-- Student Reviews -->
                            <?php $__empty_1 = true; $__currentLoopData = $course->studentRatings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="p-3 border rounded-3 mb-3 bg-light">
                                    <div class="rating-stars text-warning mb-1">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?php echo e($i <= round($rating->Average_difficulty_rate) ? '-fill' : ''); ?>"></i>
                                        <?php endfor; ?>
                                        <span class="ms-2 fw-bold"><?php echo e(number_format($rating->Average_difficulty_rate, 1)); ?>/5</span>
                                    </div>
                                    <?php if($rating->Rating_Comment): ?>
                                        <p class="mb-1 fst-italic">"<?php echo e($rating->Rating_Comment); ?>"</p>
                                    <?php else: ?>
                                        <p class="mb-1 fst-italic text-muted">No comment provided.</p>
                                    <?php endif; ?>
                                    <small class="text-muted d-block">
                                        - <?php echo e($rating->student->Student_Name ?? 'Anonymous'); ?> |
                                        <?php echo e($rating->created_at ? $rating->created_at->format('M d, Y') : 'Unknown date'); ?>

                                    </small>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No reviews yet. Be the first to rate this course!
                                </div>
                            <?php endif; ?>

                        <?php else: ?>
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle me-2"></i>
                                No ratings yet for this course. Be the first to rate!
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Add New Rating Section -->
                    <?php if(auth()->guard()->check()): ?>
                        <div class="detail-card p-4 p-md-5">
                            <h3 class="mb-4" style="color: var(--primary-dark); font-weight: 700;">
                                <i class="bi bi-pencil me-2"></i> Rate This Course
                            </h3>
                            <form action="<?php echo e(route('courses.rate', $course->Course_ID)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Difficulty Rating:</label>
                                    <div class="rating-input">
                                        <div class="d-flex align-items-center">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="difficulty_rating"
                                                           id="rating<?php echo e($i); ?>" value="<?php echo e($i); ?>"
                                                        <?php echo e($i == 3 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label rating-star-label" for="rating<?php echo e($i); ?>">
                                                        <?php for($j = 1; $j <= $i; $j++): ?>
                                                            <i class="bi bi-star<?php echo e($j <= $i ? '-fill' : ''); ?> text-warning"></i>
                                                        <?php endfor; ?>
                                                        <span class="ms-1">(<?php echo e($i); ?>)</span>
                                                    </label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <small class="text-muted">1 = Very Easy, 5 = Very Difficult</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="rating_comment" class="form-label fw-bold">Your Review (Optional):</label>
                                    <textarea class="form-control" id="rating_comment" name="rating_comment"
                                              rows="4" placeholder="Share your experience with this course..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-3">Submit Rating</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="detail-card p-4 p-md-5 text-center">
                            <h4 class="mb-3">Want to rate this course?</h4>
                            <p class="text-muted mb-4">Please login to share your experience and help other students.</p>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg me-3">Login</a>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary btn-lg">Sign Up</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Course Metadata (Right Column/Sidebar) -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div style="    background-color: #f5f5f5;" class="detail-card sticky-sidebar">
                        <div class="text-center mb-3">
                            <div class="rating-stars" style="font-size: 1.8rem;">
                                <?php
                                    $avgRating = $course->student_ratings_avg_average_difficulty_rate ?? 0;
                                ?>
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i class="bi bi-star<?php echo e($i <= floor($avgRating) ? '-fill' : ($i == ceil($avgRating) && ($avgRating - floor($avgRating)) >= 0.5 ? '-half' : '')); ?> text-warning"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="fs-5 fw-bold" style="color: var(--accent-gold);">
                                <?php echo e($avgRating ? number_format($avgRating, 1) : 'No ratings'); ?>

                            </span>
                            <p class="text-muted mb-0">
                                <small><?php echo e($totalRatings); ?> Student Ratings</small>
                            </p>
                        </div>

                        <!-- Course Metadata -->
                        <div class="detail-meta-item d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-clock me-2"></i> <span class="detail-label">Credit Hours</span></div>
                            <span class="detail-value"><?php echo e($course->Credit_Hours); ?></span>
                        </div>

                        <div class="detail-meta-item d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-journals me-2"></i> <span class="detail-label">Course Code</span></div>
                            <span class="detail-value"><?php echo e($course->Course_Code); ?></span>
                        </div>

                        <?php if($course->majors->first()): ?>
                            <div class="detail-meta-item d-flex justify-content-between align-items-center">
                                <div><i class="bi bi-building me-2"></i> <span class="detail-label">Dept</span></div>
                                <span class="detail-value"><?php echo e($course->majors->first()->department->Dept_Name ?? 'N/A'); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="detail-meta-item d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-bar-chart me-2"></i> <span class="detail-label">Difficulty</span></div>
                            <span class="detail-value
                                <?php if($avgRating >= 4): ?> text-danger
                                <?php elseif($avgRating >= 3): ?> text-warning
                                <?php elseif($avgRating > 0): ?> text-info
                                <?php else: ?> text-muted
                                <?php endif; ?>">
                                <?php if($avgRating > 0): ?>
                                    <?php echo e(number_format($avgRating, 1)); ?>/5
                                <?php else: ?>
                                    Not rated
                                <?php endif; ?>
                            </span>
                        </div>

                        <!-- Related Courses -->
                        <?php if($relatedCourses->count() > 0): ?>
                            <div class="mt-4">
                                <h6 class="mb-3" style="color: var(--dark-gray);">Related Courses</h6>
                                <?php $__currentLoopData = $relatedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="related-course-item mb-2 p-2 border rounded">
                                        <a href="<?php echo e(route('courses.show', $relatedCourse->Course_ID)); ?>"
                                           class="text-decoration-none">
                                            <div class="fw-bold small"><?php echo e($relatedCourse->Course_Code); ?></div>
                                            <div class="text-muted small"><?php echo e(Str::limit($relatedCourse->Course_Title, 40)); ?></div>
                                            <div class="small">
                                            <span class="text-warning">
                                                <?php echo e(number_format($relatedCourse->student_ratings_avg_average_difficulty_rate ?? 0, 1)); ?>/5
                                            </span>
                                                <span class="text-muted ms-2">
                                                (<?php echo e($relatedCourse->student_ratings_count); ?> ratings)
                                            </span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>

        .navbar-brand span {
            color: var(--primary-dark);
            font-weight: 700;
        }

        /* Detail-specific styles */
        .course-detail-section {
            padding: 80px 0;
        }

        .detail-header {
            background-color: var(--accent-gold);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }

        .detail-header h1 {
            font-weight: 800;
            font-size: 2.8rem;
        }

        .detail-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow-card);
        }

        .detail-meta-item {
            padding: 20px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .detail-meta-item:last-child {
            border-bottom: none;
        }

        .detail-meta-item i {
            color: var(--primary-dark);
            font-size: 1.2rem;
            width: 30px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--dark-gray);
        }

        .detail-value {
            font-weight: 700;
            color: var(--accent-gold);
        }

        .rating-display {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 15px;
        }

        .rating-stars {
            color: #ffc107; /* Bootstrap warning color for stars */
        }

        .progress {
            background-color: var(--light-gray);
        }

        /* Sticky sidebar for friendly design */
        @media (min-width: 992px) {
            .sticky-sidebar {
                position: sticky;
                top: 100px; /* Offset for the navigation bar height */
            }
        }

        /* Review form styling */
        .rating-input .form-check-label {
            cursor: pointer;
            transition: color 0.2s;
            font-size: 1.5rem;
        }
        .rating-input .form-check-input:checked ~ .form-check-label i {
            color: #ffc107;
        }


    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        // Rating stars interaction
        document.querySelectorAll('.rating-star-label').forEach(label => {
            label.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });

        // Update star display on hover
        document.querySelectorAll('input[name="difficulty_rating"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // You can add visual feedback here if needed
                console.log('Selected rating:', this.value);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/courses/show.blade.php ENDPATH**/ ?>