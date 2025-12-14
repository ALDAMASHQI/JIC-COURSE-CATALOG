<?php $__env->startSection('title', 'الخطط الغذائية'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg.jpg')); ?>') center/cover no-repeat; min-height: 60vh;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity:.55;"></div>
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-3">الخطط الغذائية</h1>
            <p class="lead mb-4">اختر نظامك الغذائي وفق السعرات والهدف ونسبة الماكروز المناسبة لك.</p>
            <a href="#filters" class="btn btn-success btn-lg px-5">فلترة الخطط</a>
        </div>
    </section>

    <section id="filters" class="container py-5">
        
        <div class="row align-items-end g-3 bg-light rounded-3 shadow-sm p-3 p-md-4 mb-4">
            <form class="row g-3" method="GET" action="<?php echo e(route('plans.nutritions.index')); ?>">
                
                <div class="col-lg-4">
                    <label class="form-label">بحث</label>
                    <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control"
                           placeholder="ابحث بالاسم أو الوصف…">
                </div>
                
                <div class="col-lg-3">
                    <label class="form-label">نوع الحمية</label>
                    <select name="diet_type" class="form-select">
                        <option value="">الكل</option>
                        <option value="balanced"     @selected(request('diet_type')==='balanced')>متوازن</option>
                        <option value="high-protein" @selected(request('diet_type')==='high-protein')>بروتين مرتفع</option>
                        <option value="keto"         @selected(request('diet_type')==='keto')>كيتو</option>
                        <option value="kids"         @selected(request('diet_type')==='kids')>أطفال</option>
                    </select>
                </div>
                
                <div class="col-lg-3">
                    <label class="form-label">السعرات</label>
                    <select name="calories" class="form-select">
                        <option value="">الكل</option>
                        <option value="<1600"   @selected(request('calories')==='&lt;1600')>أقل من 1600</option>
                        <option value="1600-2000" @selected(request('calories')==='1600-2000')>1600–2000</option>
                        <option value="2001-2500" @selected(request('calories')==='2001-2500')>2001–2500</option>
                        <option value=">2500"   @selected(request('calories')==='&gt;2500')>أكثر من 2500</option>
                    </select>
                </div>
                
                <div class="col-lg-2">
                    <label class="form-label">الترتيب</label>
                    <select name="sort" class="form-select">
                        <option value="new"      @selected(request('sort')==='new')>الأحدث</option>
                        <option value="calories" @selected(request('sort')==='calories')>السعرات</option>
                        <option value="name"     @selected(request('sort')==='name')>الاسم</option>
                    </select>
                </div>

                <div class="col-12 d-flex gap-2">
                    <button class="btn btn-success px-4"><i class="fas fa-filter ms-1"></i> تطبيق</button>
                    <a href="<?php echo e(route('plans.nutritions.index')); ?>" class="btn btn-outline-secondary">إزالة الفلاتر</a>
                </div>
            </form>
        </div>

        
        <?php
            $dietLabels = [
                'balanced'     => 'متوازن',
                'high-protein' => 'بروتين مرتفع',
                'keto'         => 'كيتو',
                'kids'         => 'أطفال',
            ];
        ?>

        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 fw-bold mb-0">النتائج</h2>
            <?php if($plans instanceof \Illuminate\Pagination\AbstractPaginator): ?>
                <span class="text-muted">عدد العناصر في هذه الصفحة: <?php echo e($plans->count()); ?></span>
            <?php endif; ?>
        </div>

        
        <?php if($plans->count()): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $badgeClass = match($plan->diet_type){
                            'balanced'     => 'bg-success',
                            'high-protein' => 'bg-primary',
                            'keto'         => 'bg-warning text-dark',
                            'kids'         => 'bg-info text-dark',
                            default        => 'bg-secondary'
                        };
                        $cal = $plan->calories ? number_format($plan->calories) . ' سعرة' : '—';
                        $p   = $plan->protein !== null ? rtrim(rtrim(number_format($plan->protein, 2), '0'), '.') . ' جم بروتين' : '—';
                        $c   = $plan->carbs   !== null ? rtrim(rtrim(number_format($plan->carbs,   2), '0'), '.') . ' جم كربوهيدرات' : '—';
                        $f   = $plan->fats    !== null ? rtrim(rtrim(number_format($plan->fats,    2), '0'), '.') . ' جم دهون' : '—';
                    ?>

                    <div class="col">
                        <div class="card h-100 border-0 shadow">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <h3 class="h5 fw-bold text-dark mb-0"><?php echo e($plan->name); ?></h3>
                                    <span class="badge <?php echo e($badgeClass); ?> ms-2">
                                        <?php echo e($dietLabels[$plan->diet_type] ?? 'غير محدد'); ?>

                                    </span>
                                </div>

                                <p class="text-muted mb-3">
                                    <?php echo e(\Illuminate\Support\Str::limit($plan->description, 140)); ?>

                                </p>

                                <ul class="list-unstyled small text-secondary mb-4">
                                    <li class="mb-1"><i class="fas fa-fire ms-1 text-danger"></i> السعرات: <?php echo e($cal); ?></li>
                                    <li class="mb-1"><i class="fas fa-egg ms-1 text-primary"></i> <?php echo e($p); ?></li>
                                    <li class="mb-1"><i class="fas fa-bread-slice ms-1 text-warning"></i> <?php echo e($c); ?></li>
                                    <li class="mb-1"><i class="fas fa-cheese ms-1 text-success"></i> <?php echo e($f); ?></li>
                                    <li class="mb-1"><i class="fas fa-calendar-alt ms-1 text-primary"></i>
                                        أضيفت: <?php echo e($plan->created_at?->diffForHumans()); ?>

                                    </li>
                                </ul>

                                <div class="mt-auto">
                                    <a href="<?php echo e(route('plans.nutritions.show', $plan->id)); ?>" class="btn btn-outline-success w-100">
                                        عرض الخطة <i class="fas fa-arrow-left me-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($plans->withQueryString()->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <img src="<?php echo e(asset('images/empty-state.svg')); ?>" alt="لا توجد نتائج" class="mb-3" style="max-width: 220px;">
                <h3 class="h5 fw-bold">لا توجد خطط متاحة حالياً</h3>
                <p class="text-muted mb-3">جرّب تعديل الفلاتر أو العودة لاحقاً.</p>
                <a href="<?php echo e(route('services')); ?>" class="btn btn-success">استكشاف خدماتنا</a>
            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/website/nutritions/index.blade.php ENDPATH**/ ?>