<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Major Management</h1>
        <p class="page-description">Manage all majors and their requirements</p>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Toolbar -->
        <div class="toolbar">


            <div class="toolbar-filters">
                <form method="GET" action="<?php echo e(route('admin.majors.index')); ?>" class="d-flex gap-2 align-items-center">


                    <select name="department" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">All Departments</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department->Dept_ID); ?>" <?php echo e(request('department') == $department->Dept_ID ? 'selected' : ''); ?>>
                                <?php echo e($department->Dept_Name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select name="sort" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="name" <?php echo e(request('sort') == 'name' ? 'selected' : ''); ?>>Name A-Z</option>
                        <option value="courses" <?php echo e(request('sort') == 'courses' ? 'selected' : ''); ?>>Most Courses</option>
                        <option value="students" <?php echo e(request('sort') == 'students' ? 'selected' : ''); ?>>Most Students</option>
                        <option value="credits" <?php echo e(request('sort') == 'credits' ? 'selected' : ''); ?>>Most Credits</option>
                        <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest First</option>
                    </select>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search majors..." value="<?php echo e(request('search')); ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <?php if(request()->anyFilled(['search', 'department', 'sort'])): ?>
                        <a href="<?php echo e(route('admin.majors.index')); ?>" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle"></i> Clear
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="toolbar-actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMajorModal">
                    <i class="bi bi-journal-plus"></i>
                    Add New Major
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

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Majors Table -->
        <div class="majors-table-container">
            <div class="table-header">
                <h3 class="table-title">All Majors (<?php echo e($majors->total()); ?>)</h3>
                <div class="table-controls">
                    <span class="text-muted">Showing <?php echo e($majors->firstItem()); ?> to <?php echo e($majors->lastItem()); ?> of <?php echo e($majors->total()); ?> majors</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover majors-table">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Major Name</th>
                        <th>Department</th>
                        <th>Required Credits</th>
                        <th>Courses</th>
                        <th>Students</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="major-row">
                            <td>
                                <span class="major-id">#<?php echo e($major->Major_ID); ?></span>
                            </td>
                            <td>
                                <div class="major-info">
                                    <h6 class="major-name mb-1"><?php echo e($major->Major_Name); ?></h6>
                                    <small class="text-muted">Major Program</small>
                                </div>
                            </td>
                            <td>
                                <span class="department-badge">
                                    <i class="bi bi-building me-1"></i>
                                    <?php echo e($major->department->Dept_Name); ?>

                                </span>
                            </td>
                            <td>
                                <span class="credits-badge">
                                    <i class="bi bi-award me-1"></i>
                                    <?php echo e($major->Required_Credits); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info text-white courses-count">
                                    <i class="bi bi-journals me-1"></i><?php echo e($major->courses_count); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge text-white bg-success students-count">
                                    <i class="bi bi-people me-1"></i><?php echo e($major->students_count); ?>

                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editMajorModal<?php echo e($major->Major_ID); ?>"
                                            title="Edit Major">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteMajorModal<?php echo e($major->Major_ID); ?>"
                                            title="Delete Major">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info btn-view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewMajorModal<?php echo e($major->Major_ID); ?>"
                                            title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Major Modal for each major -->
                        <div class="modal fade" id="editMajorModal<?php echo e($major->Major_ID); ?>" tabindex="-1" aria-labelledby="editMajorModalLabel<?php echo e($major->Major_ID); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editMajorModalLabel<?php echo e($major->Major_ID); ?>">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Edit Major
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?php echo e(route('admin.majors.update', $major->Major_ID)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="editMajorName<?php echo e($major->Major_ID); ?>" class="form-label">Major Name *</label>
                                                <input type="text" class="form-control" id="editMajorName<?php echo e($major->Major_ID); ?>"
                                                       name="Major_Name" value="<?php echo e($major->Major_Name); ?>" required
                                                       placeholder="Enter major name">
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="editRequiredCredits<?php echo e($major->Major_ID); ?>" class="form-label">Required Credits *</label>
                                                    <input type="number" class="form-control" id="editRequiredCredits<?php echo e($major->Major_ID); ?>"
                                                           name="Required_Credits" value="<?php echo e($major->Required_Credits); ?>" min="1" max="200" required
                                                           placeholder="Total credits required">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editDeptID<?php echo e($major->Major_ID); ?>" class="form-label">Department *</label>
                                                    <select class="form-select" id="editDeptID<?php echo e($major->Major_ID); ?>" name="Dept_ID" required>
                                                        <option value="">Select Department</option>
                                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($department->Dept_ID); ?>"
                                                                <?php echo e($major->Dept_ID == $department->Dept_ID ? 'selected' : ''); ?>>
                                                                <?php echo e($department->Dept_Name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="major-info-card">
                                                <div class="info-item">
                                                    <span class="info-label">Major ID:</span>
                                                    <span class="info-value">#<?php echo e($major->Major_ID); ?></span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Total Courses:</span>
                                                    <span class="info-value"><?php echo e($major->courses_count); ?></span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Total Students:</span>
                                                    <span class="info-value"><?php echo e($major->students_count); ?></span>
                                                </div>
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

                        <!-- View Major Modal for each major -->
                        <div class="modal fade" id="viewMajorModal<?php echo e($major->Major_ID); ?>" tabindex="-1" aria-labelledby="viewMajorModalLabel<?php echo e($major->Major_ID); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewMajorModalLabel<?php echo e($major->Major_ID); ?>">
                                            <i class="bi bi-journal-text me-2"></i>
                                            Major Details: <?php echo e($major->Major_Name); ?>

                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-card">
                                                    <h6>Basic Information</h6>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Major ID:</span>
                                                        <span class="detail-value">#<?php echo e($major->Major_ID); ?></span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Major Name:</span>
                                                        <span class="detail-value"><?php echo e($major->Major_Name); ?></span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Department:</span>
                                                        <span class="detail-value"><?php echo e($major->department->Dept_Name); ?></span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Required Credits:</span>
                                                        <span class="detail-value badge bg-primary text-white"><?php echo e($major->Required_Credits); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-card">
                                                    <h6>Statistics</h6>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Total Courses:</span>
                                                        <span class="detail-value badge bg-info text-white"><?php echo e($major->courses_count); ?></span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Total Students:</span>
                                                        <span class="detail-value badge bg-success text-white"><?php echo e($major->students_count); ?></span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Status:</span>
                                                        <span class="detail-value badge bg-success text-white">Active</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if($major->courses->count() > 0): ?>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div class="detail-card">
                                                        <h6>Associated Courses</h6>
                                                        <div class="courses-list">
                                                            <?php $__currentLoopData = $major->courses->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="course-item">
                                                                    <i class="bi bi-journal-text text-primary me-2"></i>
                                                                    <span><?php echo e($course->Course_Code); ?> - <?php echo e($course->Course_Title); ?></span>
                                                                    <small class="text-muted ms-2">(<?php echo e($course->Credit_Hours); ?> credits)</small>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($major->courses->count() > 5): ?>
                                                                <div class="text-center mt-2">
                                                                    <small class="text-muted">+<?php echo e($major->courses->count() - 5); ?> more courses</small>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMajorModal<?php echo e($major->Major_ID); ?>">
                                            <i class="bi bi-pencil me-1"></i> Edit Major
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal for each major -->
                        <div class="modal fade" id="deleteMajorModal<?php echo e($major->Major_ID); ?>" tabindex="-1" aria-labelledby="deleteMajorModalLabel<?php echo e($major->Major_ID); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="delete-modal-icon text-warning">
                                            <i class="bi bi-exclamation-triangle display-4"></i>
                                        </div>
                                        <h4 class="delete-modal-title mt-3">Delete Major</h4>

                                        <?php if($major->students_count > 0 || $major->courses_count > 0): ?>
                                            <div class="alert alert-warning mt-3">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                <?php if($major->students_count > 0 && $major->courses_count > 0): ?>
                                                    This major has <?php echo e($major->students_count); ?> student(s) and <?php echo e($major->courses_count); ?> course(s) associated with it.
                                                <?php elseif($major->students_count > 0): ?>
                                                    This major has <?php echo e($major->students_count); ?> student(s) associated with it.
                                                <?php else: ?>
                                                    This major has <?php echo e($major->courses_count); ?> course(s) associated with it.
                                                <?php endif; ?>
                                            </div>
                                            <p class="delete-modal-text text-muted">
                                                You cannot delete <strong><?php echo e($major->Major_Name); ?></strong> because it has associated records.
                                                Please remove all students and courses first before deleting this major.
                                            </p>
                                            <div class="d-flex justify-content-center gap-3 mt-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewMajorModal<?php echo e($major->Major_ID); ?>">
                                                    View Details
                                                </button>
                                            </div>
                                        <?php else: ?>
                                            <p class="delete-modal-text text-muted">
                                                Are you sure you want to delete <strong><?php echo e($major->Major_Name); ?></strong>?
                                                This action cannot be undone.
                                            </p>
                                            <form action="<?php echo e(route('admin.majors.destroy', $major->Major_ID)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <div class="d-flex justify-content-center gap-3 mt-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete Major</button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-journal-x display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No majors found</h5>
                                    <p class="text-muted mb-4">Get started by adding your first major.</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMajorModal">
                                        <i class="bi bi-journal-plus"></i> Add New Major
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($majors->hasPages()): ?>
                <div class="pagination-container mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info text-muted">
                            Showing <?php echo e($majors->firstItem()); ?> to <?php echo e($majors->lastItem()); ?> of <?php echo e($majors->total()); ?> majors
                        </div>
                        <nav>
                            <?php echo e($majors->withQueryString()->links()); ?>

                        </nav>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Major Modal -->
    <div class="modal fade" id="addMajorModal" tabindex="-1" aria-labelledby="addMajorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMajorModalLabel">
                        <i class="bi bi-journal-plus me-2"></i>
                        Add New Major
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('admin.majors.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Major_Name" class="form-label">Major Name *</label>
                            <input type="text" class="form-control" id="Major_Name" name="Major_Name"
                                   placeholder="e.g., Computer Science, Business Administration" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Required_Credits" class="form-label">Required Credits *</label>
                                <input type="number" class="form-control" id="Required_Credits" name="Required_Credits"
                                       min="1" max="200" value="120" required
                                       placeholder="Total credits required">
                                <div class="form-text">Typically 120-140 credits</div>
                            </div>
                            <div class="col-md-6">
                                <label for="Dept_ID" class="form-label">Department *</label>
                                <select class="form-select" id="Dept_ID" name="Dept_ID" required>
                                    <option value="">Select Department</option>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->Dept_ID); ?>"><?php echo e($department->Dept_Name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Major</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .major-row:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .major-id {
            background-color: #e9ecef;
            color: #495057;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .major-info .major-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .department-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .credits-badge {
            background-color: #fff3cd;
            color: #856404;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .courses-count, .students-count {
            font-size: 0.8rem;
            padding: 8px 10px;
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

        .major-info-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
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

        .detail-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            height: 100%;
        }

        .detail-card h6 {
            color: #495057;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .detail-item {
            display: flex;
            justify-content: between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #495057;
            flex: 1;
        }

        .detail-value {
            color: #6c757d;
            font-weight: 600;
        }

        .courses-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .course-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .course-item:last-child {
            border-bottom: none;
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

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/admin/majors.blade.php ENDPATH**/ ?>