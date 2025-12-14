<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1 class="page-title">Add New Course</h1>
        <p class="page-description">Create a new course for the catalog</p>
    </div>

    <div class="content-area">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <!-- Form fields same as in modal but for create page -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="Course_Code" class="form-label">Course Code *</label>
                            <input type="text" class="form-control" id="Course_Code" name="Course_Code" required>
                        </div>
                        <div class="col-md-6">
                            <label for="Course_Title" class="form-label">Course Title *</label>
                            <input type="text" class="form-control" id="Course_Title" name="Course_Title" required>
                        </div>
                    </div>
                    <!-- Add other form fields -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Create Course</button>
                        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\jic_catalog\resources\views/admin/courses-create.blade.php ENDPATH**/ ?>