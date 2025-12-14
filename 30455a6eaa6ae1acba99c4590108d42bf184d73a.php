

<?php $__env->startSection('title', 'إدارة المستخدمين'); ?>

<?php $__env->startSection('content'); ?>

    <?php
        $genderLabels = ['male' => 'ذكر', 'female' => 'أنثى', 'other' => 'أخرى'];
        $goalLabels = [
            'slimming' => 'تخسيس',
            'bulking'  => 'زيادة كتلة',
            'healthy'  => 'صحة عامة',
            'kids'     => 'أطفال',
        ];
    ?>

    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="ti ti-users"></i> قائمة المستخدمين</h4>
            </div>

            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered text-center  align-middle" id="datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الحالة</th>
                            <th>العمر</th>
                            <th>النوع</th>
                            <th>الهدف</th>
                            <th>الطول/الوزن</th>
                            <th>BMI</th>
                            <th>الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $roleLabel   = $user->role === 'admin' ? 'مشرف' : 'مستخدم';
                                $statusLabel = $user->status === 'active' ? 'نشط' : 'غير نشط';
                                $statusClass = $user->status === 'active' ? 'bg-success' : 'bg-danger';

                                $genderLabel = $genderLabels[$user->gender] ?? '—';
                                $goalLabel   = $goalLabels[$user->goal] ?? '—';

                                $height = $user->height_cm ? $user->height_cm . ' سم' : '—';
                                $weight = $user->weight_kg !== null ? rtrim(rtrim(number_format($user->weight_kg, 2), '0'), '.') . ' كجم' : '—';
                                $bmi    = $user->bmi !== null ? number_format($user->bmi, 2) : '—';
                            ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td class="fw-semibold"><?php echo e($user->full_name); ?></td>
                                <td class="text-muted"><?php echo e($user->email); ?></td>
                                <td><span class="badge <?php echo e($statusClass); ?>"><?php echo e($statusLabel); ?></span></td>
                                <td><?php echo e($user->age ?? '—'); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark"><?php echo e($genderLabel); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark"><?php echo e($goalLabel); ?></span>
                                </td>
                                <td><?php echo e($height); ?> / <?php echo e($weight); ?></td>
                                <td>
                                    <?php if($user->bmi !== null): ?>
                                        <span class="badge
                                            <?php if($user->bmi < 18.5): ?> bg-info text-dark
                                            <?php elseif($user->bmi < 25): ?> bg-success
                                            <?php elseif($user->bmi < 30): ?> bg-warning text-dark
                                            <?php else: ?> bg-danger <?php endif; ?>">
                                            <?php echo e($bmi); ?>

                                        </span>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        
                                        <form action="<?php echo e(route('admin.users.status', $user)); ?>" method="POST" class="d-inline-flex align-items-center gap-2">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <select name="status" class="form-select form-select-sm">
                                                <option value="active"   <?php echo e($user->status === 'active' ? 'selected' : ''); ?>>نشط</option>
                                                <option value="inactive" <?php echo e($user->status === 'inactive' ? 'selected' : ''); ?>>غير نشط</option>
                                            </select>
                                            <button class="btn btn-sm btn-outline-success">تحديث</button>
                                        </form>

                                        
                                        <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="d-inline"
                                              onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="12" class="text-muted">لا توجد بيانات.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/users/index.blade.php ENDPATH**/ ?>