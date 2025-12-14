<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Rating Management</h1>
        <p class="page-description">Manage and moderate all course ratings and reviews from students</p>
    </div>
    <div class="content-area">
        <div class="toolbar">
            <div class="toolbar-filters">
                <form method="GET" action="<?php echo e(route('admin.ratings.index')); ?>" class="d-flex gap-2 align-items-center">

                    <select name="course" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">All Courses</option>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($course->Course_ID); ?>" <?php echo e(request('course') == $course->Course_ID ? 'selected' : ''); ?>>
                                <?php echo e($course->Course_Code); ?> - <?php echo e(Str::limit($course->Course_Title, 25)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="student" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">All Students</option>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($student->Student_ID); ?>" <?php echo e(request('student') == $student->Student_ID ? 'selected' : ''); ?>>
                                <?php echo e($student->Student_Name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="rating" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                        <option value="">All Ratings</option>
                        <option value="5" <?php echo e(request('rating') == '5' ? 'selected' : ''); ?>>5 Stars</option>
                        <option value="4" <?php echo e(request('rating') == '4' ? 'selected' : ''); ?>>4+ Stars</option>
                        <option value="3" <?php echo e(request('rating') == '3' ? 'selected' : ''); ?>>3+ Stars</option>
                        <option value="2" <?php echo e(request('rating') == '2' ? 'selected' : ''); ?>>2+ Stars</option>
                        <option value="1" <?php echo e(request('rating') == '1' ? 'selected' : ''); ?>>1 Star</option>
                    </select>

                    <select name="sort" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest First</option>
                        <option value="rating_high" <?php echo e(request('sort') == 'rating_high' ? 'selected' : ''); ?>>Highest Rating</option>
                        <option value="rating_low" <?php echo e(request('sort') == 'rating_low' ? 'selected' : ''); ?>>Lowest Rating</option>
                        <option value="student" <?php echo e(request('sort') == 'student' ? 'selected' : ''); ?>>Student A-Z</option>
                        <option value="course" <?php echo e(request('sort') == 'course' ? 'selected' : ''); ?>>Course A-Z</option>
                    </select>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search ratings..." value="<?php echo e(request('search')); ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <?php if(request()->anyFilled(['search', 'course', 'student', 'rating', 'sort'])): ?>
                        <a href="<?php echo e(route('admin.ratings.index')); ?>" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle"></i> Clear
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="toolbar-actions">
                <button type="button" class="btn btn-outline-danger" id="bulkDeleteBtn" style="display: none;">
                    <i class="bi bi-trash"></i>
                    Delete Selected
                </button>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Ratings Table -->
        <div class="ratings-table-container">
            <div class="table-header">
                <h3 class="table-title">All Ratings (<?php echo e($ratings->total()); ?>)</h3>
                <div class="table-controls">
                    <span class="text-muted">Showing <?php echo e($ratings->firstItem()); ?> to <?php echo e($ratings->lastItem()); ?> of <?php echo e($ratings->total()); ?> ratings</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover ratings-table">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 40px;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th>Rating</th>
                        <th>Student & Review</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="rating-row">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input rating-checkbox" type="checkbox"
                                           value="<?php echo e($rating->Student_ID); ?>_<?php echo e($rating->Course_ID); ?>">
                                </div>
                            </td>
                            <td>
                                <div class="rating-display">
                                    <div class="rating-stars">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?php echo e($i <= $rating->Average_difficulty_rate ? '-fill' : ''); ?> text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="rating-value">
                                        <strong><?php echo e(number_format($rating->Average_difficulty_rate, 1)); ?>/5</strong>
                                    </div>
                                    <div class="rating-difficulty">
                                        <small class="text-muted">
                                            <?php if($rating->Average_difficulty_rate >= 4): ?>
                                                <span class="text-danger">Very Difficult</span>
                                            <?php elseif($rating->Average_difficulty_rate >= 3): ?>
                                                <span class="text-warning">Moderate</span>
                                            <?php else: ?>
                                                <span class="text-success">Easy</span>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="student-review">
                                    <div class="student-info">
                                        <h6 class="student-name mb-1">
                                            <?php echo e($rating->student->Student_Name); ?>

                                        </h6>
                                        <p class="student-email mb-2 text-muted small">
                                            <i class="bi bi-envelope me-1"></i><?php echo e($rating->student->Student_Email); ?>

                                        </p>
                                    </div>
                                    <?php if($rating->Rating_Comment): ?>
                                        <div class="review-comment">
                                            <p class="mb-0 fst-italic">
                                                "<?php echo e($rating->Rating_Comment); ?>"
                                            </p>
                                        </div>
                                    <?php else: ?>
                                        <div class="no-comment">
                                            <small class="text-muted">No comment provided</small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="course-info">
                                    <div class="course-code-badge">
                                        <?php echo e($rating->course->Course_Code); ?>

                                    </div>
                                    <h6 class="course-title mb-1">
                                        <?php echo e($rating->course->Course_Title); ?>

                                    </h6>
                                    <div class="course-meta">
                                        <small class="text-muted">
                                            <i class="bi bi-building me-1"></i>
                                            <?php echo e($rating->course->majors->first()->department->Dept_Name ?? 'N/A'); ?>

                                        </small>
                                    </div>
                                    <div class="course-meta">
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            <?php echo e($rating->course->Credit_Hours); ?> Credits
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="rating-date">
                                    <div class="date-display">
                                        <?php echo e($rating->created_at->format('M d, Y')); ?>

                                    </div>
                                    <div class="time-display text-muted small">
                                        <?php echo e($rating->created_at->format('h:i A')); ?>

                                    </div>
                                    <div class="time-ago text-muted small">
                                        <?php echo e($rating->created_at->diffForHumans()); ?>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-danger btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteRatingModal<?php echo e($rating->Student_ID); ?>_<?php echo e($rating->Course_ID); ?>"
                                            title="Delete Rating">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal for each rating -->
                        <div class="modal fade" id="deleteRatingModal<?php echo e($rating->Student_ID); ?>_<?php echo e($rating->Course_ID); ?>" tabindex="-1" aria-labelledby="deleteRatingModalLabel<?php echo e($rating->Student_ID); ?>_<?php echo e($rating->Course_ID); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="delete-modal-icon text-warning">
                                            <i class="bi bi-exclamation-triangle display-4"></i>
                                        </div>
                                        <h4 class="delete-modal-title mt-3">Delete Rating</h4>
                                        <p class="delete-modal-text text-muted">
                                            Are you sure you want to delete the rating from
                                            <strong><?php echo e($rating->student->Student_Name); ?></strong> for
                                            <strong><?php echo e($rating->course->Course_Code); ?></strong>?
                                        </p>
                                        <div class="rating-preview mb-3">
                                            <div class="rating-stars">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="bi bi-star<?php echo e($i <= $rating->Average_difficulty_rate ? '-fill' : ''); ?> text-warning"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <?php if($rating->Rating_Comment): ?>
                                                <p class="mt-2 mb-0 fst-italic text-muted">
                                                    "<?php echo e(Str::limit($rating->Rating_Comment, 100)); ?>"
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <form action="<?php echo e(route('admin.ratings.destroy', ['student' => $rating->Student_ID, 'course' => $rating->Course_ID])); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <div class="d-flex justify-content-center gap-3 mt-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete Rating</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-star display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No ratings found</h5>
                                    <p class="text-muted mb-4">No course ratings have been submitted yet.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bulk Delete Form -->
            <form id="bulkDeleteForm" action="<?php echo e(route('admin.ratings.bulk-delete')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <input type="hidden" name="rating_ids" id="bulkRatingIds">
            </form>

            <!-- Pagination -->
            <?php if($ratings->hasPages()): ?>
                <div class="pagination-container mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info text-muted">
                            Showing <?php echo e($ratings->firstItem()); ?> to <?php echo e($ratings->lastItem()); ?> of <?php echo e($ratings->total()); ?> ratings
                        </div>
                        <nav>
                            <?php echo e($ratings->withQueryString()->links()); ?>

                        </nav>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.rating-checkbox');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');
            const bulkRatingIds = document.getElementById('bulkRatingIds');

            // Select all functionality
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                toggleBulkDeleteBtn();
            });

            // Individual checkbox change
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleBulkDeleteBtn);
            });

            // Toggle bulk delete button
            function toggleBulkDeleteBtn() {
                const checkedBoxes = document.querySelectorAll('.rating-checkbox:checked');
                if (checkedBoxes.length > 0) {
                    bulkDeleteBtn.style.display = 'inline-block';
                } else {
                    bulkDeleteBtn.style.display = 'none';
                }
            }

            // Bulk delete action
            bulkDeleteBtn.addEventListener('click', function() {
                const checkedBoxes = document.querySelectorAll('.rating-checkbox:checked');
                const ratingIds = Array.from(checkedBoxes).map(checkbox => checkbox.value);

                if (ratingIds.length > 0 && confirm(`Are you sure you want to delete ${ratingIds.length} rating(s)?`)) {
                    bulkRatingIds.value = JSON.stringify(ratingIds);
                    bulkDeleteForm.submit();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .rating-row:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .rating-display {
            text-align: center;
        }

        .rating-stars {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .rating-value {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .rating-difficulty {
            margin-top: 2px;
        }

        .student-review .student-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .student-review .student-email {
            font-size: 0.875rem;
        }

        .review-comment {
            background: #f8f9fa;
            border-left: 3px solid #007bff;
            padding: 10px 12px;
            border-radius: 4px;
            margin-top: 8px;
        }

        .review-comment p {
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .no-comment {
            background: #f8f9fa;
            padding: 10px 12px;
            border-radius: 4px;
            margin-top: 8px;
            text-align: center;
        }

        .course-code-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 5px;
        }

        .course-info .course-title {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .course-meta {
            font-size: 0.8rem;
        }

        .rating-date {
            text-align: center;
        }

        .date-display {
            font-weight: 600;
            color: #2c3e50;
        }

        .time-display, .time-ago {
            font-size: 0.8rem;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            justify-content: center;
        }

        .action-buttons .btn {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .rating-info-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            justify-content: between;
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: 500;
            color: #495057;
            flex: 1;
        }

        .info-value {
            color: #6c757d;
            font-weight: 600;
        }

        .rating-input .rating-star-label {
            cursor: pointer;
            transition: transform 0.2s;
            padding: 5px;
            border-radius: 4px;
        }

        .rating-input .rating-star-label:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
        }

        .rating-preview {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
        }

        .empty-state {
            padding: 3rem 1rem;
        }

        .delete-modal-icon {
            margin-bottom: 1rem;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-check-input {
            cursor: pointer;
        }

        #bulkDeleteBtn {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .toolbar-filters {
                flex-direction: column;
                gap: 10px;
            }

            .toolbar-filters .d-flex {
                flex-wrap: wrap;
            }

            .toolbar-filters .form-select,
            .toolbar-filters .input-group {
                width: 100% !important;
            }

            .rating-input .d-flex {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/admin/ratings.blade.php ENDPATH**/ ?>