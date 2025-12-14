<?php
    $avg = isset($avgRating) ? round((float)$avgRating, 1) : null;
    $count = isset($count) ? (int)$count : ($feedback?->count() ?? 0);
?>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="h6 fw-bold mb-0"><i class="fas fa-star ms-1 text-warning"></i> آراء المستخدمين</h5>
            <span class="small text-muted">
                <?php if($count > 0): ?>
                    متوسط: <strong><?php echo e($avg); ?></strong> / 5 — (<?php echo e($count); ?> تقييم)
                <?php else: ?>
                    لا توجد تقييمات بعد
                <?php endif; ?>
            </span>
        </div>

        
        <?php if($count > 0): ?>
            <ul class="list-unstyled mb-3">
                <?php $__currentLoopData = $feedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mb-3 border rounded p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fw-semibold">
                                <?php echo e($row->user?->full_name ?? 'مستخدم'); ?>

                                <span class="text-muted small">— <?php echo e($row->created_at?->diffForHumans()); ?></span>
                            </div>
                            <div>
                                <?php for($i=1;$i<=5;$i++): ?>
                                    <i class="fas fa-star <?php echo e($i <= (int)$row->rating ? 'text-warning' : 'text-muted'); ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php if(!empty($row->content)): ?>
                            <p class="text-secondary mb-0 mt-2"><?php echo e($row->content); ?></p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

        
        <?php if(auth()->guard()->check()): ?>
            <hr class="my-3">
            <h6 class="fw-bold mb-2">أضف تقييمك</h6>
            <form action="<?php echo e(route('user.feedback.store', [$targetType, $targetId])); ?>" method="POST" class="row g-2">
                <?php echo csrf_field(); ?>
                <div class="col-md-3">
                    <label class="form-label">التقييم</label>
                    <select name="rating" class="form-select <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="">— اختر —</option>
                        <?php for($i=5;$i>=1;$i--): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(old('rating') == $i ? 'selected' : ''); ?>>
                                <?php echo e($i); ?> / 5
                            </option>
                        <?php endfor; ?>
                    </select>
                    <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-9">
                    <label class="form-label">تعليق (اختياري)</label>
                    <input type="text" name="content" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('content')); ?>" placeholder="اكتب رأيك هنا...">
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-success"><i class="fas fa-paper-plane ms-1"></i> إرسال التقييم</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-light border mt-3 mb-0">
                <i class="fas fa-lock ms-1"></i> يرجى <a href="<?php echo e(route('auth.login')); ?>">تسجيل الدخول</a> لإضافة تقييمك.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\ubs\resources\views/website/feedback_card.blade.php ENDPATH**/ ?>