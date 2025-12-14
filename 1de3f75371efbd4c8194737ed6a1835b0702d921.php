

<?php $__env->startSection('title', 'إنشاء خطة تمارين'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="ti ti-dumbbell"></i> إنشاء خطة تمارين</h4>
                <a href="<?php echo e(route('admin.workout-plans.index')); ?>" class="btn btn-outline-secondary">عودة للقائمة</a>
            </div>
            <div class="card-body">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger"><strong>تنبيه:</strong> تحقق من الحقول أدناه.</div>
                <?php endif; ?>

                <?php echo $__env->make('admin.workouts.form', [
                    'action'       => route('admin.workout-plans.store'),
                    'method'       => 'POST',
                    'plan'         => null,
                    'difficulties' => $difficulties,
                    'sessions'     => old('sessions', []),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/workouts/create.blade.php ENDPATH**/ ?>