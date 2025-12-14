<?php $__env->startSection('title', 'خطة التمارين الخاصة بي'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 shadow-sm"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body p-3 p-md-4 d-flex flex-column">
                        <h2 class="h6 fw-bold mb-3"><i class="ti ti-dumbbell ms-1 text-success"></i> اختر خطة تمارين</h2>

                        <input type="text" class="form-control mb-3" placeholder="ابحث عن خطة…"
                               oninput="filterList(this, '#workout-plan-list')">

                        <?php
                            $labels = ['easy'=>'سهل','medium'=>'متوسط','hard'=>'صعب'];
                        ?>

                        <div id="workout-plan-list" class="list-group flex-grow-1 overflow-auto" style="max-height: 55vh;">
                            <?php $__empty_1 = true; $__currentLoopData = $allWorkoutPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $active = isset($plan) && $plan && $plan->id === $p->id;
                                    $badgeClass = match($p->difficulty){
                                        'easy' => 'bg-success','medium' => 'bg-warning text-dark','hard' => 'bg-danger', default => 'bg-secondary'
                                    };
                                ?>
                                <div class="list-group-item d-flex align-items-center justify-content-between <?php echo e($active ? 'border-success' : ''); ?>">
                                    <div class="me-2">
                                        <div class="fw-semibold small mb-1"><?php echo e($p->title); ?></div>
                                        <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($labels[$p->difficulty] ?? 'غير محدد'); ?></span>
                                    </div>
                                    <?php if(!$active): ?>
                                        <form action="<?php echo e(route('user.my.workout.start', $p->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-outline-success">اعتماد</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="badge bg-success">نشطة</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center text-muted py-4">لا توجد خطط متاحة.</div>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo e(route('plans.workouts.index')); ?>" class="btn btn-outline-secondary mt-3">فتح صفحة جميع الخطط</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <?php if($plan): ?>
                            <?php
                                $badgeClass = match($plan->difficulty){
                                    'easy' => 'bg-success','medium' => 'bg-warning text-dark','hard' => 'bg-danger', default => 'bg-secondary'
                                };
                                $duration = $plan->duration_minutes ? $plan->duration_minutes.' دقيقة' : 'غير محدد';
                                $sessions = [];
                                if (!empty($plan->sessions_json)) {
                                    $decoded = is_string($plan->sessions_json) ? json_decode($plan->sessions_json, true) : $plan->sessions_json;
                                    if (is_array($decoded)) $sessions = $decoded;
                                }
                            ?>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h1 class="h5 fw-bold mb-0"><?php echo e($plan->title); ?></h1>
                                <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($labels[$plan->difficulty] ?? 'غير محدد'); ?></span>
                            </div>
                            <p class="text-muted"><?php echo e($plan->description); ?></p>

                            <ul class="list-unstyled small text-secondary mb-4">
                                <li class="mb-1"><i class="ti ti-clock ms-1 text-success"></i> المدة: <?php echo e($duration); ?></li>
                                <li class="mb-1"><i class="ti ti-calendar ms-1 text-primary"></i> بدأت: <?php echo e(($plan->pivot->start_date)); ?></li>
                                <li class="mb-1"><i class="ti ti-info-circle ms-1 text-secondary"></i> الحالة: <?php echo e($plan->pivot->status); ?></li>
                            </ul>

                            <?php if(count($sessions)): ?>
                                <h3 class="h6 fw-bold mb-3">محتوى الجلسات</h3>
                                <ul class="list-unstyled text-secondary mb-0">
                                    <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="mb-2">
                                            <i class="<?php echo e($item['icon'] ?? 'fas fa-dumbbell'); ?> ms-1 text-success"></i>
                                            <?php echo e($item['text'] ?? ''); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                            <hr>
                            
                            <?php
                                $statusLabels = ['ongoing'=>'نشطة','paused'=>'موقوفة مؤقتًا','completed'=>'مكتملة'];
                                $currentStatus = $plan->pivot->status ?? 'paused';
                                $pivotStart = !empty($plan->pivot->start_date)
                                    ? \Illuminate\Support\Carbon::parse($plan->pivot->start_date)->format('Y-m-d')
                                    : null;
                                $today = \Illuminate\Support\Carbon::now()->format('Y-m-d');
                            ?>

                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body p-3 p-md-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="h6 fw-bold mb-0"><i class="ti ti-adjustments ms-1 text-success"></i> إدارة حالة الخطة</h4>
                                        <span class="badge bg-light text-dark">الحالة الحالية: <?php echo e($statusLabels[$currentStatus] ?? $currentStatus); ?></span>
                                    </div>

                                    <form action="<?php echo e(route('user.my.workout.status', $plan->id)); ?>" method="POST" class="row g-2">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-md-6">
                                            <label class="form-label">الحالة</label>
                                            <select name="status" class="form-select">
                                                <option value="ongoing"  <?php echo e($currentStatus === 'ongoing'  ? 'selected' : ''); ?>>نشطة</option>
                                                <option value="paused"   <?php echo e($currentStatus === 'paused'   ? 'selected' : ''); ?>>موقوفة مؤقتًا</option>
                                                <option value="completed"<?php echo e($currentStatus === 'completed'? 'selected' : ''); ?>>مكتملة</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">تاريخ البدء</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control"
                                                   value="<?php echo e(old('start_date', $pivotStart)); ?>">
                                            <div class="form-text">لو تركته فارغًا، سيتم ضبطه تلقائيًا عند تفعيل الخطة.</div>
                                        </div>
                                        <div class="col-12 d-grid mt-1">
                                            <button class="btn btn-success">تحديث</button>
                                        </div>
                                    </form>

                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        <form action="<?php echo e(route('user.my.workout.status', $plan->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="ongoing">
                                            <input type="hidden" name="start_date" value="<?php echo e($pivotStart ?? $today); ?>">
                                            <button class="btn btn-outline-success btn-sm">تفعيل الآن</button>
                                        </form>

                                        <form action="<?php echo e(route('user.my.workout.status', $plan->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="paused">
                                            <button class="btn btn-outline-secondary btn-sm">إيقاف مؤقت</button>
                                        </form>

                                        <form action="<?php echo e(route('user.my.workout.status', $plan->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="completed">
                                            <button class="btn btn-outline-primary btn-sm">وضع مكتملة</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="<?php echo e(route('plans.workouts.show', $plan->id)); ?>" class="btn btn-outline-success">فتح صفحة الخطة العامة</a>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <h2 class="h6 fw-bold mb-2">لا توجد خطة تمارين نشطة</h2>
                                <p class="text-muted mb-3">اختر خطة من القائمة على اليسار أو من الصفحة العامة.</p>
                                <a href="<?php echo e(route('plans.workouts.index')); ?>" class="btn btn-success">استعراض خطط التمارين</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterList(input, listSelector){
            const val = input.value.trim().toLowerCase();
            document.querySelectorAll(listSelector + ' .list-group-item').forEach(li=>{
                const text = li.innerText.toLowerCase();
                li.style.display = text.includes(val) ? '' : 'none';
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/user/my-workout.blade.php ENDPATH**/ ?>