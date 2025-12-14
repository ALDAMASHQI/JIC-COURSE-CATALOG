


<?php $__env->startSection('title', 'الخطط الغذائية'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $dietMap = ['balanced'=>'متوازن','high-protein'=>'بروتين مرتفع','keto'=>'كيتو','kids'=>'أطفال'];
    ?>

    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="ti ti-restaurant"></i> الخطط الغذائية</h4>
                <a href="<?php echo e(route('admin.nutrition-plans.create')); ?>" class="btn btn-primary">
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
                            <th>الاسم</th>
                            <th>الوصف</th>
                            <th>نوع الحِمية</th>
                            <th>السعرات</th>
                            <th>بروتين/كربوه/دهون (جم)</th>
                            <th>إجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $badge = match($plan->diet_type){
                                    'balanced' => 'bg-success',
                                    'high-protein' => 'bg-primary',
                                    'keto' => 'bg-warning text-dark',
                                    'kids' => 'bg-info text-dark',
                                    default => 'bg-secondary'
                                };
                                $p = is_null($plan->protein) ? '—' : rtrim(rtrim(number_format($plan->protein,2), '0'), '.');
                                $c = is_null($plan->carbs)   ? '—' : rtrim(rtrim(number_format($plan->carbs,  2), '0'), '.');
                                $f = is_null($plan->fats)    ? '—' : rtrim(rtrim(number_format($plan->fats,   2), '0'), '.');
                            ?>
                            <tr>
                                <td><?php echo e($loop->iteration + (($plans->currentPage()-1) * $plans->perPage())); ?></td>
                                <td class="fw-semibold"><?php echo e($plan->name); ?></td>
                                <td class="text-muted" style="max-width:340px"><?php echo e(\Illuminate\Support\Str::limit($plan->description, 90)); ?></td>
                                <td><span class="badge <?php echo e($badge); ?>"><?php echo e($dietMap[$plan->diet_type] ?? 'غير محدد'); ?></span></td>
                                <td><?php echo e(is_null($plan->calories) ? '—' : number_format($plan->calories)); ?></td>
                                <td><?php echo e($p); ?> / <?php echo e($c); ?> / <?php echo e($f); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?php echo e(route('admin.nutrition-plans.edit', $plan)); ?>" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i> تعديل
                                        </a>
                                        <form action="<?php echo e(route('admin.nutrition-plans.destroy', $plan)); ?>" method="POST"
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/nutritions/index.blade.php ENDPATH**/ ?>