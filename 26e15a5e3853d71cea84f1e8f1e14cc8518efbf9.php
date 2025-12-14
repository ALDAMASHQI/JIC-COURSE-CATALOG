<?php $__env->startSection('title', $plan->name); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg.jpg')); ?>') center/cover no-repeat; min-height: 50vh;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity:.55;"></div>
        <div class="container position-relative">
            <h1 class="display-5 fw-bold mb-2"><?php echo e($plan->name); ?></h1>
            <p class="lead text-white-50 mb-0">نظام غذائي متكامل يوازن بين السعرات والماكروز</p>
        </div>
    </section>

    <?php
        $dietLabels = [
            'balanced'     => 'متوازن',
            'high-protein' => 'بروتين مرتفع',
            'keto'         => 'كيتو',
            'kids'         => 'أطفال',
        ];
        $badgeClass = match($plan->diet_type){
            'balanced'     => 'bg-success',
            'high-protein' => 'bg-primary',
            'keto'         => 'bg-warning text-dark',
            'kids'         => 'bg-info text-dark',
            default        => 'bg-secondary'
        };
        $cal = $plan->calories ? number_format($plan->calories) . ' سعرة' : 'غير محدد';
        $p   = $plan->protein !== null ? rtrim(rtrim(number_format($plan->protein, 2), '0'), '.') . ' جم بروتين' : 'غير محدد';
        $c   = $plan->carbs   !== null ? rtrim(rtrim(number_format($plan->carbs,   2), '0'), '.') . ' جم كربوهيدرات' : 'غير محدد';
        $f   = $plan->fats    !== null ? rtrim(rtrim(number_format($plan->fats,    2), '0'), '.') . ' جم دهون' : 'غير محدد';
    ?>

    <section class="container py-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($dietLabels[$plan->diet_type] ?? 'غير محدد'); ?></span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-fire ms-1 text-danger"></i> السعرات: <?php echo e($cal); ?>

                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-egg ms-1 text-primary"></i> <?php echo e($p); ?>

                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-bread-slice ms-1 text-warning"></i> <?php echo e($c); ?>

                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-cheese ms-1 text-success"></i> <?php echo e($f); ?>

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

                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h6 fw-bold mb-3">إرشادات عامة</h3>
                        <ul class="list-unstyled text-secondary mb-0">
                            <li class="mb-2"><i class="fas fa-check ms-1 text-success"></i> وزّع الوجبات على 3–5 وجبات يومياً.</li>
                            <li class="mb-2"><i class="fas fa-check ms-1 text-success"></i> احرص على شرب الماء بكميات كافية.</li>
                            <li class="mb-2"><i class="fas fa-check ms-1 text-success"></i> عدّل الحصص حسب مستوى النشاط اليومي.</li>
                        </ul>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="h6 fw-bold mb-3">ابدأ هذه الخطة الآن</h4>
                        <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('user.my.nutrition.start', $plan->id)); ?>" method="POST" class="d-grid gap-2">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-success btn-lg">
                                    اعتماد الخطة <i class="fas fa-check me-1"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-success btn-lg w-100">سجّل الدخول للبدء</a>
                        <?php endif; ?>

                        <hr class="my-4">

                        <h5 class="h6 fw-bold mb-3">روابط مفيدة</h5>
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('plans.nutritions.index')); ?>" class="btn btn-outline-secondary">كل الخطط الغذائية</a>
                            <a href="<?php echo e(route('plans.workouts.index')); ?>" class="btn btn-outline-secondary">خطط التمارين المقترحة</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-8">
                
                <?php echo $__env->make('website.feedback_card', [
                    'feedback'   => $feedback,
                    'avgRating'  => $avg ?? null,
                    'count'      => $cnt ?? null,
                    'targetType' => 'nutrition',
                    'targetId'   => $plan->id,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/website/nutritions/show.blade.php ENDPATH**/ ?>