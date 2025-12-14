<?php $__env->startSection('title', 'خطط التمارين'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section position-relative text-white d-flex align-items-center"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.55), rgba(0,0,0,0.85)), url('<?php echo e(asset('assets/bg2.jpg')); ?>') center/cover no-repeat; min-height: 60vh;">
        <div class="container py-5 text-center position-relative z-index-1">
            <h1 class="display-3 fw-bold mb-3">خطط التمارين</h1>
            <p class="lead mb-4 fw-light">اختر الخطة المناسبة لهدفك، مستوى لياقتك، ووقتك المتاح — وابدأ اليوم.</p>
        </div>
    </section>

    
    <section id="main-content" class="container py-5">
        
        <div class="card p-3 p-md-4 rounded-3 shadow-sm mb-5">
            <form class="row g-4 align-items-end" method="GET" action="<?php echo e(route('plans.workouts.index')); ?>">
                
                <div class="col-lg-3 col-md-6">
                    <label class="form-label text-muted">بحث</label>
                    <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="ابحث بالعنوان أو الوصف…">
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <label class="form-label text-muted">المستوى</label>
                    <select name="difficulty" class="form-select">
                        <option value="">الكل</option>
                        <option value="easy" @selected(request('difficulty')==='easy')>سهل</option>
                        <option value="medium" @selected(request('difficulty')==='medium')>متوسط</option>
                        <option value="hard" @selected(request('difficulty')==='hard')>صعب</option>
                    </select>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <label class="form-label text-muted">الترتيب</label>
                    <select name="sort" class="form-select">
                        <option value="new" @selected(request('sort')==='new')>الأحدث</option>
                        <option value="duration"@selected(request('sort')==='duration')>المدة</option>
                        <option value="title" @selected(request('sort')==='title')>العنوان</option>
                    </select>
                </div>

                
                <div class="col-lg-3 col-md-6  gap-2">
                    <button class="btn btn-success fw-bold"><i class="fas fa-filter me-1"></i> تطبيق</button>
                    <a href="<?php echo e(route('plans.workouts.index')); ?>" class="btn btn-outline-secondary">إزالة الفلاتر</a>
                </div>
            </form>
        </div>

        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h2 class="h4 fw-bold mb-0">النتائج</h2>
            <?php if($plans instanceof \Illuminate\Pagination\AbstractPaginator): ?>
                <span class="text-muted small">عرض <?php echo e($plans->count()); ?> خطة</span>
            <?php endif; ?>
        </div>

        
        <?php if($plans->count()): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $badgeClass = match($plan->difficulty){
                            'easy' => 'bg-success',
                            'medium' => 'bg-warning text-dark',
                            'hard' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        $duration = $plan->duration_minutes ? $plan->duration_minutes.' دقيقة' : '—';
                          $labels = [
        'easy'   => 'سهل',
        'medium' => 'متوسط',
        'hard'   => 'صعب',
    ];
                    ?>

                    <div class="col">
                        <div class="card h-100 border-0 rounded-3 custom-shadow hover-lift">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h3 class="h5 fw-bold text-dark mb-0"><?php echo e($plan->title); ?></h3>
                                    <span class="badge <?php echo e($badgeClass); ?> rounded-pill ms-2 p-2"><?php echo e($labels[$plan->difficulty] ?? 'غير محدد'); ?></span>
                                </div>

                                <p class="text-muted small mb-3">
                                    <?php echo e(\Illuminate\Support\Str::limit($plan->description, 140)); ?>

                                </p>

                                <ul class="list-unstyled small text-secondary mb-4">
                                    <li class="mb-1">
                                        <i class="fas fa-stopwatch me-2 text-success"></i> <span class="fw-bold">المدة:</span> <?php echo e($duration); ?>

                                    </li>
                                    <li class="mb-1">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i> <span class="fw-bold">أضيفت:</span> <?php echo e($plan->created_at?->diffForHumans()); ?>

                                    </li>
                                </ul>

                                <div class="mt-auto">
                                    <a href="<?php echo e(route('plans.workouts.show', $plan->id)); ?>"
                                       class="btn btn-outline-success fw-bold w-100">
                                        عرض الخطة <i class="fas fa-arrow-left me-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="mt-5 d-flex justify-content-center">
                <?php echo e($plans->withQueryString()->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <img src="<?php echo e(asset('images/empty-state.svg')); ?>" alt="لا توجد نتائج" class="mb-3" style="max-width: 220px;">
                <h3 class="h5 fw-bold text-dark">لا توجد خطط متاحة حالياً</h3>
                <p class="text-muted mb-4">جرّب تعديل الفلاتر أو العودة لاحقاً.</p>
                <a href="<?php echo e(route('services')); ?>" class="btn btn-success px-4">استكشاف خدماتنا</a>
            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/website/workouts/index.blade.php ENDPATH**/ ?>