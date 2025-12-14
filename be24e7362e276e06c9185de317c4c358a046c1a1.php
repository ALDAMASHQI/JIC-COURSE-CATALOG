

<?php $__env->startSection('title', 'من نحن'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Hero Section with Background Image -->
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg.jpg')); ?>') center/cover no-repeat; height: 70vh;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.6;"></div>
        <div class="container position-relative z-2">
            <h1 class="display-3 fw-bold mb-3">من نحن</h1>
            <p class="lead mb-4">تعرف على رسالتنا ورؤيتنا في FitNow لمساعدتك على تحقيق حياة أكثر صحة وتوازناً.</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about-us" class="container py-5">
        <div class="row align-items-center bg-white p-4">
            <!-- About Text -->
            <div class="col-lg-8 mb-4">
                <h2 class="fw-bold mb-4">قصتنا</h2>
                <p class="text-secondary mb-3">
                    FitNow هي منصة متكاملة للصحة واللياقة تم تطويرها لمساعدة الأفراد على تحسين حياتهم من خلال الجمع بين
                    التمارين الرياضية، خطط التغذية، والمتابعة الذكية للتقدم.
                </p>
                <p class="text-secondary mb-3">
                    هدفنا هو جعل الوصول إلى نمط حياة صحي سهلاً ومتاحاً للجميع، عبر حلول مرنة تناسب احتياجاتك سواء كنت مبتدئاً
                    أو محترفاً.
                </p>
                <h3 class="fw-bold mt-4">رسالتنا</h3>
                <p class="text-secondary mb-3">
                    تقديم حلول صحية مبتكرة وشاملة تجمع بين التكنولوجيا والخبرة الإنسانية لتحقيق أفضل النتائج لمستخدمينا.
                </p>
                <h3 class="fw-bold mt-4">رؤيتنا</h3>
                <p class="text-secondary">
                    أن نصبح المنصة الرائدة في تعزيز الصحة واللياقة على مستوى العالم العربي من خلال تجربة رقمية مميزة وداعمة.
                </p>
            </div>

            <!-- About Image -->
            <div class="col-lg-4">
                <img src="<?php echo e(asset('assets/logo1.png')); ?>" alt="فريق FitNow"
                     class="img-fluid rounded">
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section id="values" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">قيمنا الأساسية</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card border-0 shadow h-100 p-4">
                        <i class="fas fa-heartbeat fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold">الصحة أولاً</h5>
                        <p class="text-secondary">نضع صحة مستخدمينا في المقام الأول ونقدم حلولاً عملية وآمنة.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow h-100 p-4">
                        <i class="fas fa-lightbulb fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">الابتكار المستمر</h5>
                        <p class="text-secondary">نطور منصتنا باستمرار لنواكب أحدث الأساليب العلمية والتقنية.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow h-100 p-4">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold">مجتمع داعم</h5>
                        <p class="text-secondary">نسعى لبناء مجتمع صحي يشجع على الاستمرارية والتحفيز المتبادل.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/website/about.blade.php ENDPATH**/ ?>