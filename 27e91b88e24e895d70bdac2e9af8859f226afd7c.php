

<?php $__env->startSection('title', 'خدماتنا'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Hero Section with Background Image -->
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg.jpg')); ?>') center/cover no-repeat; height: 70vh;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.6;"></div>
        <div class="container position-relative z-2">
            <h1 class="display-3 fw-bold mb-3">حلول صحية متكاملة</h1>
            <p class="lead mb-4">خدماتنا صممت خصيصاً لمساعدتك على تحقيق أهدافك في اللياقة البدنية والتغذية الصحية.</p>
            <a href="<?php echo e(route('auth.login')); ?>" class="btn btn-lg btn-success px-5">ابدأ الآن</a>
        </div>
    </section>

    <!-- Services Details Section -->
    <section id="services-details" class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">خدماتنا الرئيسية</h2>
            <p class="text-muted">نوفر لك مجموعة متكاملة من الحلول الصحية تجمع بين التدريب والتغذية والمتابعة.</p>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Service Card 1 -->
            <div class="col">
                <div class="card h-100 text-center p-4 border-0 shadow service-card">
                    <div class="service-icon-container mx-auto mb-4 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-dumbbell fa-2x text-success"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title h4 fw-bold text-dark">خطط تمارين مخصصة</h3>
                        <p class="card-text text-secondary">برامج تدريبية فردية تناسب مستوى لياقتك وأهدافك، سواء كنت في الصالة أو المنزل، مع فيديوهات تعليمية لضمان الأداء الصحيح.</p>
                    </div>
                </div>
            </div>

            <!-- Service Card 2 -->
            <div class="col">
                <div class="card h-100 text-center p-4 border-0 shadow service-card">
                    <div class="service-icon-container mx-auto mb-4 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-carrot fa-2x text-warning"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title h4 fw-bold text-dark">برامج تغذية صحية</h3>
                        <p class="card-text text-secondary">خطط غذائية متوازنة مع حساب السعرات والمغذيات الأساسية لمساعدتك على إنقاص الوزن، بناء العضلات أو الحفاظ على صحتك العامة.</p>
                    </div>
                </div>
            </div>

            <!-- Service Card 3 -->
            <div class="col">
                <div class="card h-100 text-center p-4 border-0 shadow service-card">
                    <div class="service-icon-container mx-auto mb-4 rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-chart-line fa-2x text-primary"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title h4 fw-bold text-dark">تتبع التقدم والنتائج</h3>
                        <p class="card-text text-secondary">نظام متابعة متكامل لوزنك، قياسات جسمك ونشاطك البدني، يمنحك رؤية واضحة حول تقدمك في رحلتك الصحية.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\fit_now\resources\views/website/services.blade.php ENDPATH**/ ?>