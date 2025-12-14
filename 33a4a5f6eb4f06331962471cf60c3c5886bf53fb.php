<?php $__env->startSection('title', $plan->title); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg2.jpg')); ?>') center/cover no-repeat; min-height: 50vh;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity:.55;"></div>
        <div class="container position-relative">
            <h1 class="display-5 fw-bold mb-2"><?php echo e($plan->title); ?></h1>
            <p class="lead text-white-50 mb-0">خطة تمارين مصممة بعناية لتحقق أهدافك</p>
        </div>
    </section>

    <?php
        $labels = ['easy'=>'سهل','medium'=>'متوسط','hard'=>'صعب'];
        $badgeClass = match($plan->difficulty){
            'easy' => 'bg-success',
            'medium' => 'bg-warning text-dark',
            'hard' => 'bg-danger',
            default => 'bg-secondary'
        };
        $duration = $plan->duration_minutes ? $plan->duration_minutes.' دقيقة' : 'غير محدد';
    ?>

    <section class="container py-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($labels[$plan->difficulty] ?? 'غير محدد'); ?></span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-stopwatch ms-1 text-success"></i> المدة: <?php echo e($duration); ?>

                            </span>
                            <?php if($plan->created_at): ?>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-calendar-alt ms-1 text-primary"></i>
                                    أضيفت: <?php echo e($plan->created_at->diffForHumans()); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <h2 class="h5 fw-bold mb-3">وصف الخطة</h2>
                        <p class="text-secondary mb-0">
                            <?php echo e($plan->description ?: 'لا يوجد وصف متاح لهذه الخطة حالياً.'); ?>

                        </p>
                    </div>
                </div>

                <?php
                    $sessions = [];
                    if (!empty($plan->sessions_json)) {
                        $decoded = is_string($plan->sessions_json)
                            ? json_decode($plan->sessions_json, true)
                            : $plan->sessions_json;
                        if (is_array($decoded)) $sessions = $decoded;
                    }
                ?>

                <?php if(count($sessions)): ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-bold mb-3">محتوى الجلسات</h3>
                            <ul class="list-unstyled text-secondary mb-0">
                                <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-2">
                                        <i class="<?php echo e($item['icon'] ?? 'fas fa-dumbbell'); ?> ms-1 text-success"></i>
                                        <?php echo e($item['text'] ?? ''); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="h6 fw-bold mb-3">ابدأ الخطة الآن</h4>
                        <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('user.my.workout.start', $plan->id)); ?>" method="POST" class="d-grid gap-2">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-success btn-lg">
                                    اعتماد الخطة <i class="fas fa-check me-1"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('auth.login')); ?>" class="btn btn-success btn-lg w-100">سجّل الدخول للبدء</a>
                        <?php endif; ?>

                        <hr class="my-4">

                        <h5 class="h6 fw-bold mb-3">معلومات سريعة</h5>
                        <ul class="list-unstyled text-secondary small mb-0">
                            <li class="mb-2"><i class="fas fa-bolt ms-1 text-warning"></i> مستوى: <?php echo e($labels[$plan->difficulty] ?? 'غير محدد'); ?></li>
                            <li class="mb-2"><i class="fas fa-stopwatch ms-1 text-success"></i> مدة الجلسة: <?php echo e($duration); ?></li>
                            <li class="mb-2"><i class="fas fa-shield-alt ms-1 text-primary"></i> احرص على الإحماء والتدرّج في الشدة</li>
                        </ul>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <h5 class="h6 fw-bold mb-3">قد يفيدك أيضاً</h5>
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('plans.workouts.index')); ?>" class="btn btn-outline-secondary">
                                جميع خطط التمارين
                            </a>
                            <a href="<?php echo e(route('plans.nutritions.index')); ?>" class="btn btn-outline-secondary">
                                الخطط الغذائية المقترحة
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">
                <?php echo $__env->make('website.feedback_card', [
       'feedback'   => $feedback,
       'avgRating'  => $avg ?? null,
       'count'      => $cnt ?? null,
       'targetType' => 'workout',
       'targetId'   => $plan->id,
   ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/website/workouts/show.blade.php ENDPATH**/ ?>