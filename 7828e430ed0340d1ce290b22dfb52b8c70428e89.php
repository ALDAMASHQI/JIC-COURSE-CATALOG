<?php $__env->startSection('content'); ?>
    <!-- Course Listing Header -->
    <header class="course-listing-header">
        <div class="container text-center">
            <h1>Explore Our Course Catalog</h1>
            <p class="lead opacity-75">Discover <?php echo e($totalCourses); ?>+ professional and academic courses to advance your career at Jubail Industrial College.</p>
        </div>
    </header>

    <!-- Main Course Content -->
    <section class="course-listing-content bg-light">
        <div class="container">
            <div class="row">
                <!-- Filter Sidebar (lg: 3 columns) -->
                <div class="col-lg-3">
                    <form id="filter-form" method="GET" action="<?php echo e(route('courses.index')); ?>">
                        <div class="filter-sidebar">
                            <h4 class="mb-4 text-center text-lg-start" style="color: var(--dark-gray); font-weight: 800;">Filters</h4>

                            <!-- Search Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-search me-2 text-muted"></i> Search Course</h6>
                                <input type="text"
                                       class="form-control"
                                       name="search"
                                       id="course-search-input"
                                       placeholder="Keyword or code"
                                       value="<?php echo e(request('search')); ?>">
                            </div>

                            <!-- Category Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-layer-group me-2 text-muted"></i> Department</h6>
                                <select class="form-select" name="category" id="course-category">
                                    <option value="">All Departments</option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->Dept_Name); ?>"
                                            <?php echo e(request('category') == $department->Dept_Name ? 'selected' : ''); ?>>
                                            <?php echo e($department->Dept_Name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Difficulty Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-bar-chart me-2 text-muted"></i> Difficulty Level</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="beginner" id="diffBeginner"
                                        <?php echo e(request('difficulty') == 'beginner' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="diffBeginner">Beginner (≤ 2.5)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="intermediate" id="diffIntermediate"
                                        <?php echo e(request('difficulty') == 'intermediate' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="diffIntermediate">Intermediate (2.6-3.5)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="advanced" id="diffAdvanced"
                                        <?php echo e(request('difficulty') == 'advanced' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="diffAdvanced">Advanced (≥ 3.6)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="" id="diffAll"
                                        <?php echo e(!request('difficulty') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="diffAll">All Levels</label>
                                </div>
                            </div>

                            <!-- Rating Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-star me-2 text-muted"></i> Minimum Rating</h6>
                                <div class="star-filter d-flex gap-3" id="star-filter">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi bi-star rating-star fs-4"
                                           data-value="<?php echo e($i); ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" name="min_rating" id="min_rating"
                                       value="<?php echo e(request('min_rating')); ?>">
                            </div>


                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-accent mt-3">Apply Filters</button>
                                <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-outline-secondary">Clear Filters</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Course Results (lg: 9 columns) -->
                <div class="col-lg-9">
                    <!-- Results Summary -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="results-summary mb-0">
                            Showing <span id="course-count"><?php echo e($courses->count()); ?></span> of <?php echo e($courses->total()); ?> total courses.
                        </p>
                        <form id="sort-form" method="GET" class="d-inline">
                            <?php if(request('search')): ?>
                                <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                            <?php endif; ?>
                            <?php if(request('category')): ?>
                                <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                            <?php endif; ?>
                            <?php if(request('difficulty')): ?>
                                <input type="hidden" name="difficulty" value="<?php echo e(request('difficulty')); ?>">
                            <?php endif; ?>
                            <?php if(request('min_rating')): ?>
                                <input type="hidden" name="min_rating" value="<?php echo e(request('min_rating')); ?>">
                            <?php endif; ?>
                            <select class="form-select w-auto" name="sort" id="sort-by-select" onchange="this.form.submit()">
                                <option value="relevance" <?php echo e(request('sort') == 'relevance' ? 'selected' : ''); ?>>Sort by Relevance</option>
                                <option value="rating" <?php echo e(request('sort') == 'rating' ? 'selected' : ''); ?>>Top Rated</option>
                                <option value="duration" <?php echo e(request('sort') == 'duration' ? 'selected' : ''); ?>>Duration (Shortest)</option>
                                <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest</option>
                            </select>
                        </form>
                    </div>

                    <!-- Course Grid Container -->
                    <div class="row" id="course-results-container">
                        <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card course-card h-100">
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
                                            <span class="ms-1">
                                                <?php echo e($avgRating ? number_format($avgRating, 1) : 'No ratings'); ?>/5
                                            </span>

                                        </div>
                                    </div>
                                    <div class="course-card-body">
                                        <p class="card-text">
                                            <?php echo e(Str::limit($course->Course_Description, 50)); ?>

                                        </p>
                                        <div class="course-meta">
                                            <span class="course-badge">
                                                <i class="bi bi-clock me-1"></i>
                                                <?php echo e($course->Credit_Hours); ?> Credits
                                            </span>
                                            <span class="text-muted">
                                                <i class="bi bi-bar-chart-fill me-1"></i>
                                                Difficulty:
                                                <strong class="<?php if($avgRating >= 4): ?> text-danger <?php elseif($avgRating >= 3): ?> text-warning <?php elseif($avgRating > 0): ?> text-info <?php else: ?> text-muted <?php endif; ?>">
                                                    <?php echo e($avgRating ? number_format($avgRating, 1) : 'N/A'); ?>/5
                                                </strong>
                                            </span>
                                        </div>
                                        <?php if($course->student_ratings_count > 0): ?>
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    <i class="bi bi-people me-1"></i>
                                                    <?php echo e($course->student_ratings_count); ?> ratings
                                                </small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="course-card-footer">
                                        <a href="<?php echo e(route('courses.show', $course->Course_ID)); ?>" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No courses found matching your criteria. Try adjusting your filters.
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if($courses->hasPages()): ?>
                        <div class="d-flex justify-content-center mt-5">
                            <nav aria-label="Course pagination">
                                <ul class="pagination shadow-sm rounded-pill">
                                    
                                    <?php if($courses->onFirstPage()): ?>
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                            </span>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($courses->previousPageUrl()); ?>" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    
                                    <?php $__currentLoopData = $courses->getUrlRange(1, $courses->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="page-item <?php echo e($page == $courses->currentPage() ? 'active' : ''); ?>">
                                            <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <?php if($courses->hasMorePages()): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($courses->nextPageUrl()); ?>" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                            </span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        // Update rating value display
        document.getElementById('rating-range').addEventListener('input', function() {
            document.getElementById('rating-value').textContent = this.value + '+';
        });

        // Auto-submit form when filters change (optional)
        document.querySelectorAll('#filter-form input, #filter-form select').forEach(element => {
            element.addEventListener('change', function() {
                // For better UX, you might want to debounce this or use a submit button
                // document.getElementById('filter-form').submit();
            });
        });

        // Course search with debounce
        let searchTimeout;
        document.getElementById('course-search-input').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filter-form').submit();
            }, 500);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll(".rating-star");
            const input = document.getElementById("min_rating");
            const selected = parseFloat(input.value) || 0; // default no selection

            function highlightStars(value) {
                stars.forEach(star => {
                    const starValue = parseInt(star.dataset.value);
                    if (value >= starValue) {
                        star.classList.remove("bi-star");
                        star.classList.add("bi-star-fill", "text-warning");
                    } else {
                        star.classList.add("bi-star");
                        star.classList.remove("bi-star-fill", "text-warning");
                    }
                });
            }

            // Restore previous selection if exists
            if (selected > 0) {
                highlightStars(selected);
            }

            stars.forEach(star => {
                star.addEventListener("click", function () {
                    const value = parseFloat(this.dataset.value);

                    // Toggle: if user clicks same value → reset to none
                    if (input.value == value) {
                        input.value = "";
                        highlightStars(0);
                        return;
                    }

                    input.value = value;
                    highlightStars(value);
                });
            });
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/courses/index.blade.php ENDPATH**/ ?>