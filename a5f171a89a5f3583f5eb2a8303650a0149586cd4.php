

<?php $__env->startSection('title', 'خطط التمارين'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="ti ti-dumbbell"></i> خطط التمارين</h4>
                <a href="<?php echo e(route('admin.workout-plans.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> خطة جديدة
                </a>
            </div>

            <div class="card-body">
                <?php if(session('success')): ?> <div class="alert alert-success"><?php echo e(session('success')); ?></div> <?php endif; ?>
                <?php if(session('error')): ?>   <div class="alert alert-danger"><?php echo e(session('error')); ?></div>   <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered text-center  align-middle" id="datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>الصعوبة</th>
                            <th>المدة (د)</th>
                            <th>عدد الجلسات</th>
                            <th>تاريخ الإنشاء</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $diffBadge = match($plan->difficulty){
                                    'easy' => 'bg-success',
                                    'medium' => 'bg-warning text-dark',
                                    'hard' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                                $sessionsCount = 0;
                                if (!empty($plan->sessions_json)) {
                                    $tmp = is_string($plan->sessions_json) ? json_decode($plan->sessions_json, true) : $plan->sessions_json;
                                    $sessionsCount = is_array($tmp) ? count($tmp) : 0;
                                }
                            ?>
                            <tr>
                                <td><?php echo e($loop->iteration + (($plans->currentPage()-1) * $plans->perPage())); ?></td>
                                <td class="fw-semibold"><?php echo e($plan->title); ?></td>
                                <td><span class="badge <?php echo e($diffBadge); ?>">
                                <?php echo e(['easy'=>'سهل','medium'=>'متوسط','hard'=>'صعب'][$plan->difficulty] ?? 'غير محدد'); ?>

                            </span></td>
                                <td><?php echo e($plan->duration_minutes ?? '—'); ?></td>
                                <td><?php echo e($sessionsCount); ?></td>
                                <td class="text-muted"><?php echo e($plan->created_at?->format('Y-m-d') ?? '—'); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?php echo e(route('admin.workout-plans.edit', $plan)); ?>" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i> تعديل
                                        </a>
                                        <form action="<?php echo e(route('admin.workout-plans.destroy', $plan)); ?>" method="POST"
                                              onsubmit="return confirm('تأكيد حذف الخطة؟');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="8" class="text-muted">لا توجد خطط بعد.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/workouts/index.blade.php ENDPATH**/ ?>