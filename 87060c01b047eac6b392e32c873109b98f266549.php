<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Course Management</h1>
        <p class="page-description">Manage all courses, add new courses, and update existing ones</p>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Toolbar -->
        <div class="toolbar">

            <div class="toolbar-filters">
                <form method="GET" action="<?php echo e(route('admin.courses.index')); ?>" class="d-flex gap-2 align-items-center">


                    <select name="department" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">All Departments</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->Dept_ID); ?>" <?php echo e(request('department') == $department->Dept_ID ? 'selected' : ''); ?>>
                                <?php echo e($department->Dept_Name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="rating" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="">All Ratings</option>
                        <option value="4" <?php echo e(request('rating') == '4' ? 'selected' : ''); ?>>4+ Stars</option>
                        <option value="3" <?php echo e(request('rating') == '3' ? 'selected' : ''); ?>>3+ Stars</option>
                        <option value="2" <?php echo e(request('rating') == '2' ? 'selected' : ''); ?>>2+ Stars</option>
                    </select>

                    <select name="sort" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest First</option>
                        <option value="name" <?php echo e(request('sort') == 'name' ? 'selected' : ''); ?>>Name A-Z</option>
                        <option value="code" <?php echo e(request('sort') == 'code' ? 'selected' : ''); ?>>Course Code</option>
                        <option value="ratings" <?php echo e(request('sort') == 'ratings' ? 'selected' : ''); ?>>Most Rated</option>
                        <option value="difficulty" <?php echo e(request('sort') == 'difficulty' ? 'selected' : ''); ?>>Most Difficult</option>
                    </select>

                    <div class="input-group" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search courses..." value="<?php echo e(request('search')); ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <?php if(request()->anyFilled(['search', 'department', 'rating', 'sort'])): ?>
                        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle"></i> Clear
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="toolbar-actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    <i class="bi bi-plus-circle"></i>
                    Add New Course
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

        <!-- Courses Table -->
        <div class="courses-table-container">
            <div class="table-header">
                <h3 class="table-title">All Courses (<?php echo e($courses->total()); ?>)</h3>
                <div class="table-controls">
                    <span class="text-muted">Showing <?php echo e($courses->firstItem()); ?> to <?php echo e($courses->lastItem()); ?> of <?php echo e($courses->total()); ?> courses</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover courses-table">
                    <thead class="table-light">
                    <tr>
                        <th >Course Code</th>
                        <th>Course Title</th>
                        <th >Credits</th>
                        <th>Department</th>
                        <th >Ratings</th>
                        <th >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="course-row">
                            <td>
                                <div class="course-code-badge">
                                    <span class=""><?php echo e($course->Course_Code); ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="course-info">
                                    <h6 class="course-title mb-1"><?php echo e($course->Course_Title); ?></h6>

                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark course-credits">
                                    <i class="bi bi-clock me-1"></i><?php echo e($course->Credit_Hours); ?>

                                </span>
                            </td>
                            <td>
                                <span class="department-badge">
                                    <i class="bi bi-building me-1"></i>
                                    <?php echo e($course->majors->first()->department->Dept_Name ?? 'N/A'); ?>

                                </span>
                            </td>
                            <td>
                                <div class="course-ratings">
                                    <div class="rating-stars small">
                                        <?php
                                            $avgRating = $course->student_ratings_avg_average_difficulty_rate ?? 0;
                                            $fullStars = floor($avgRating);
                                            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                        ?>
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?php echo e($i <= $fullStars ? '-fill' : ($i == $fullStars + 1 && $hasHalfStar ? '-half' : '')); ?> text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="rating-text small text-muted">
                                        <?php echo e(number_format($avgRating, 1)); ?> (<?php echo e($course->student_ratings_count); ?>)
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCourseModal<?php echo e($course->Course_ID); ?>"
                                            title="Edit Course">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteCourseModal<?php echo e($course->Course_ID); ?>"
                                            title="Delete Course">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <a href="<?php echo e(route('courses.show', $course->Course_ID)); ?>"
                                       class="btn btn-sm btn-outline-info"
                                       target="_blank"
                                       title="View Course">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Course Modal for each course -->
                        <div class="modal fade" id="editCourseModal<?php echo e($course->Course_ID); ?>" tabindex="-1" aria-labelledby="editCourseModalLabel<?php echo e($course->Course_ID); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCourseModalLabel<?php echo e($course->Course_ID); ?>">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Edit Course: <?php echo e($course->Course_Code); ?>

                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?php echo e(route('admin.courses.update', $course->Course_ID)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="editCourseCode<?php echo e($course->Course_ID); ?>" class="form-label">Course Code *</label>
                                                    <input type="text" class="form-control" id="editCourseCode<?php echo e($course->Course_ID); ?>"
                                                           name="Course_Code" value="<?php echo e($course->Course_Code); ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editCourseTitle<?php echo e($course->Course_ID); ?>" class="form-label">Course Title *</label>
                                                    <input type="text" class="form-control" id="editCourseTitle<?php echo e($course->Course_ID); ?>"
                                                           name="Course_Title" value="<?php echo e($course->Course_Title); ?>" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="editCourseCredits<?php echo e($course->Course_ID); ?>" class="form-label">Credit Hours *</label>
                                                    <select class="form-select" id="editCourseCredits<?php echo e($course->Course_ID); ?>" name="Credit_Hours" required>
                                                        <?php for($i = 1; $i <= 6; $i++): ?>
                                                            <option value="<?php echo e($i); ?>" <?php echo e($course->Credit_Hours == $i ? 'selected' : ''); ?>>
                                                                <?php echo e($i); ?> Credit<?php echo e($i > 1 ? 's' : ''); ?>

                                                            </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editCourseDepartment<?php echo e($course->Course_ID); ?>" class="form-label">Department *</label>
                                                    <select class="form-select" id="editCourseDepartment<?php echo e($course->Course_ID); ?>" name="major_id" required>
                                                        <option value="">Select Department</option>
                                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <optgroup label="<?php echo e($department->Dept_Name); ?>">
                                                                <?php $__currentLoopData = $department->majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($major->Major_ID); ?>"
                                                                        <?php echo e($course->majors->contains('Major_ID', $major->Major_ID) ? 'selected' : ''); ?>>
                                                                        <?php echo e($major->Major_Name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </optgroup>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="editCourseDescription<?php echo e($course->Course_ID); ?>" class="form-label">Course Description *</label>
                                                <textarea class="form-control" id="editCourseDescription<?php echo e($course->Course_ID); ?>"
                                                          name="Course_Description" rows="4" required><?php echo e($course->Course_Description); ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="editPrerequisites<?php echo e($course->Course_ID); ?>" class="form-label">Prerequisites</label>
                                                <select class="form-select" id="editPrerequisites<?php echo e($course->Course_ID); ?>" name="prerequisites[]" multiple size="4">
                                                    <?php $__currentLoopData = $allCourses ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prereqCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($prereqCourse->Course_ID); ?>"
                                                            <?php echo e($course->prerequisites->contains('Prerequisite_Course_ID', $prereqCourse->Course_ID) ? 'selected' : ''); ?>>
                                                            <?php echo e($prereqCourse->Course_Code); ?> - <?php echo e($prereqCourse->Course_Title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="form-text">Hold Ctrl (or Cmd on Mac) to select multiple prerequisites</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal for each course -->
                        <div class="modal fade" id="deleteCourseModal<?php echo e($course->Course_ID); ?>" tabindex="-1" aria-labelledby="deleteCourseModalLabel<?php echo e($course->Course_ID); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="delete-modal-icon text-warning">
                                            <i class="bi bi-exclamation-triangle display-4"></i>
                                        </div>
                                        <h4 class="delete-modal-title mt-3">Delete Course</h4>
                                        <p class="delete-modal-text text-muted">
                                            Are you sure you want to delete <strong><?php echo e($course->Course_Code); ?> - <?php echo e($course->Course_Title); ?></strong>?
                                            This action cannot be undone and will remove all associated ratings and prerequisites.
                                        </p>
                                        <form action="<?php echo e(route('admin.courses.destroy', $course->Course_ID)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <div class="d-flex justify-content-center gap-3 mt-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete Course</button>
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
                                    <i class="bi bi-journal-x display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No courses found</h5>
                                    <p class="text-muted mb-4">Get started by adding your first course.</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                                        <i class="bi bi-plus-circle"></i> Add New Course
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($courses->hasPages()): ?>
                <div class="pagination-container mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info text-muted">
                            Showing <?php echo e($courses->firstItem()); ?> to <?php echo e($courses->lastItem()); ?> of <?php echo e($courses->total()); ?> courses
                        </div>
                        <nav>
                            <?php echo e($courses->withQueryString()->links()); ?>

                        </nav>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add New Course
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Course_Code" class="form-label">Course Code *</label>
                                <input type="text" class="form-control" id="Course_Code" name="Course_Code"
                                       placeholder="e.g., CS-101" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Course_Title" class="form-label">Course Title *</label>
                                <input type="text" class="form-control" id="Course_Title" name="Course_Title"
                                       placeholder="e.g., Introduction to Programming" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Credit_Hours" class="form-label">Credit Hours *</label>
                                <select class="form-select" id="Credit_Hours" name="Credit_Hours" required>
                                    <option value="">Select Credits</option>
                                    <?php for($i = 1; $i <= 6; $i++): ?>
                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Credit<?php echo e($i > 1 ? 's' : ''); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="major_id" class="form-label">Department *</label>
                                <select class="form-select" id="major_id" name="major_id" required>
                                    <option value="">Select Department</option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <optgroup label="<?php echo e($department->Dept_Name); ?>">
                                            <?php $__currentLoopData = $department->majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($major->Major_ID); ?>"><?php echo e($major->Major_Name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </optgroup>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Course_Description" class="form-label">Course Description *</label>
                            <textarea class="form-control" id="Course_Description" name="Course_Description"
                                      rows="4" placeholder="Enter detailed course description..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="prerequisites" class="form-label">Prerequisites</label>
                            <select class="form-select" id="prerequisites" name="prerequisites[]" multiple size="4">
                                <?php $__currentLoopData = $allCourses ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prereqCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($prereqCourse->Course_ID); ?>">
                                        <?php echo e($prereqCourse->Course_Code); ?> - <?php echo e($prereqCourse->Course_Title); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="form-text">Hold Ctrl (or Cmd on Mac) to select multiple prerequisites</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .course-row:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .course-code-badge {
            background: #6da649 ;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            text-align: center;
            display: inline-block;
        }

        .course-info .course-title {
            font-weight: 600;
            color: #2c3e50;
        }

        .course-info .course-description {
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .department-badge {
            background-color: #e9ecef;
            color: #495057;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .course-ratings .rating-stars {
            margin-bottom: 2px;
        }

        .course-ratings .rating-text {
            font-size: 0.8rem;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .action-buttons .btn {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
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

        .toolbar-filters .form-select,
        .toolbar-filters .input-group {
            margin-bottom: 0;
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
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/admin/courses.blade.php ENDPATH**/ ?>