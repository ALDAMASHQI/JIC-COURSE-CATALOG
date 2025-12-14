

<?php $__env->startSection('title', 'تعديل خطة تمارين'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit"></i> تعديل: <?php echo e($plan->title); ?></h4>
                <a href="<?php echo e(route('admin.workout-plans.index')); ?>" class="btn btn-outline-secondary">عودة للقائمة</a>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?> <div class="alert alert-success"><?php echo e(session('success')); ?></div> <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger"><strong>تنبيه:</strong> تحقق من الحقول أدناه.</div>
                <?php endif; ?>

                <?php echo $__env->make('admin.workouts.form', [
                    'action'       => route('admin.workout-plans.update', $plan),
                    'method'       => 'PUT',
                    'plan'         => $plan,
                    'difficulties' => $difficulties,
                    'sessions'     => $sessions,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/workouts/edit.blade.php ENDPATH**/ ?>