<form action="<?php echo e($action); ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>
    <?php if(isset($method) && in_array($method, ['PUT','PATCH','DELETE'])): ?>
        <?php echo method_field($method); ?>
    <?php endif; ?>

    <div class="row g-3">
        
        <div class="col-md-6">
            <label class="form-label">العنوان <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   value="<?php echo e(old('title', $plan->title ?? '')); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="col-md-3">
            <label class="form-label">الصعوبة <span class="text-danger">*</span></label>
            <select name="difficulty" class="form-select <?php $__errorArgs = ['difficulty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">— اختر —</option>
                <?php $__currentLoopData = $difficulties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php echo e(old('difficulty', $plan->difficulty ?? '') === $key ? 'selected':''); ?>>
                        <?php echo e($label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['difficulty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="col-md-3">
            <label class="form-label">المدة (بالدقائق)</label>
            <input type="number" name="duration_minutes" min="1" max="600"
                   class="form-control <?php $__errorArgs = ['duration_minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   value="<?php echo e(old('duration_minutes', $plan->duration_minutes ?? '')); ?>">
            <?php $__errorArgs = ['duration_minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="col-12">
            <label class="form-label">الوصف <span class="text-danger">*</span></label>
            <textarea name="description" rows="5" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('description', $plan->description ?? '')); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="h6 fw-bold mb-2">الجلسات (اختياري)</h5>
                    <p class="text-muted small mb-2">
                        يمكنك لصق JSON مباشرة أو بناء الجلسات كسطور. في حال تعبئة الحقلين سيتم اعتماد JSON.
                    </p>

                    
                    <div class="mb-3">
                        <label class="form-label">Sessions JSON</label>
                        <textarea name="sessions_json" rows="4" placeholder='[{"icon":"fas fa-dumbbell","text":"إحماء 5–10 دقائق"}]'
                                  class="form-control <?php $__errorArgs = ['sessions_json'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('sessions_json')); ?></textarea>
                        <?php $__errorArgs = ['sessions_json'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small text-muted">منشئ الجلسات</span>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSessionRow()">+ إضافة سطر</button>
                        </div>

                        <div id="session-rows" class="row g-2">
                            <?php
                                $rows = old('sessions', []);
                                // إن لم يكن old() موجودًا، استعمل $sessions القادم من الكنترولر (edit)
                                if (!$rows && !empty($sessions) && is_array($sessions)) {
                                    $rows = $sessions;
                                }
                            ?>

                            <?php if($rows && is_array($rows)): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-5">
                                        <input type="text" name="sessions_icon[]" class="form-control" placeholder="fas fa-dumbbell"
                                               value="<?php echo e($r['icon'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="sessions_text[]" class="form-control" placeholder="نص الجلسة"
                                               value="<?php echo e($r['text'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-1 d-grid">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeSessionRow(this)">حذف</button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                
                                <div class="col-md-5">
                                    <input type="text" name="sessions_icon[]" class="form-control" placeholder="fas fa-dumbbell">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="sessions_text[]" class="form-control" placeholder="نص الجلسة">
                                </div>
                                <div class="col-md-1 d-grid">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeSessionRow(this)">حذف</button>
                                </div>
                            <?php endif; ?>
                        </div>

                        <template id="session-row-template">
                            <div class="col-md-5">
                                <input type="text" name="sessions_icon[]" class="form-control" placeholder="fas fa-dumbbell">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="sessions_text[]" class="form-control" placeholder="نص الجلسة">
                            </div>
                            <div class="col-md-1 d-grid">
                                <button type="button" class="btn btn-outline-danger" onclick="removeSessionRow(this)">حذف</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 d-flex gap-2 mt-2">
            <button class="btn btn-success">حفظ</button>
            <a href="<?php echo e(route('admin.workout-plans.index')); ?>" class="btn btn-outline-secondary">إلغاء</a>
        </div>
    </div>
</form>

<?php $__env->startPush('js'); ?>

    <script>
        function addSessionRow(){
            const t = document.getElementById('session-row-template');
            const frag = t.content.cloneNode(true);
            document.getElementById('session-rows').appendChild(frag);
        }
        function removeSessionRow(btn){
            // إزالة الأعمدة الثلاثة (icon/text/button) الخاصة بالصف
            const col = btn.closest('.col-md-1');
            const row = col.previousElementSibling?.previousElementSibling; // icon col
            const row2 = col.previousElementSibling; // text col
            if (row) row.remove();
            if (row2) row2.remove();
            col.remove();
        }
    </script>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\ubs\resources\views/admin/workouts/form.blade.php ENDPATH**/ ?>