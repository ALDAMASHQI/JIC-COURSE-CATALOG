

<?php $__env->startSection('title', 'الرئيسية'); ?>

<?php $__env->startSection('content'); ?>


<!-- Hero Slider (Bootstrap Carousel) -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('<?php echo e(asset('assets/5.jpg')); ?>');">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4">صحتك تبدأ الآن</h1>
                <p class="text-lg md:text-xl font-light mb-8">منصة متكاملة لتخصيص خططك الرياضية والغذائية، ومتابعة تقدمك نحو حياة أكثر صحة.</p>
                <a href="#features" class="inline-block px-8 py-4 bg-white text-teal-600 font-semibold text-lg rounded-lg shadow-lg hover:bg-gray-100 transition-colors duration-300">ابدأ رحلتك الآن</a>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('<?php echo e(asset('assets/4.jpg')); ?>');">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4">خطط تغذية مخصصة</h1>
                <p class="text-lg md:text-xl font-light mb-8">اكتشف برامج غذائية مصممة خصيصاً لتناسب احتياجاتك وأهدافك الصحية.</p>
                <a href="#features" class="inline-block px-8 py-4 bg-white text-teal-600 font-semibold text-lg rounded-lg shadow-lg hover:bg-gray-100 transition-colors duration-300">اكتشف المزيد</a>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('<?php echo e(asset('assets/1.webp')); ?>');">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4">تمارين في أي مكان</h1>
                <p class="text-lg md:text-xl font-light mb-8">اختر من بين مئات التمارين التي يمكنك القيام بها في المنزل أو في النادي.</p>
                <a href="#features" class="inline-block px-8 py-4 bg-white text-teal-600 font-semibold text-lg rounded-lg shadow-lg hover:bg-gray-100 transition-colors duration-300">شاهد التمارين</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">السابق</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">التالي</span>
    </button>
</div>

<!-- Features Section -->
<section id="features" class="container mx-auto px-2 py-4">
    <div class="text-center mb-12">
        <h2 class="section-title">مميزاتنا</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="feature-card bg-white p-6 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-transform duration-300">
            <div class="p-4 rounded-full bg-teal-100 inline-flex items-center justify-center mb-4">
                <i class="fas fa-dumbbell text-3xl text-teal-600"></i>
            </div>
            <h3 class="text-xl font-bold mb-2 text-gray-800">خطط تمارين مخصصة</h3>
            <p class="text-gray-600">تخصيص خطط تمارين تناسب أهدافك ومستواك، سواء للمبتدئين أو المحترفين.</p>
        </div>
        <div class="feature-card bg-white p-6 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-transform duration-300">
            <div class="p-4 rounded-full bg-teal-100 inline-flex items-center justify-center mb-4">
                <i class="fas fa-carrot text-3xl text-teal-600"></i>
            </div>
            <h3 class="text-xl font-bold mb-2 text-gray-800">برامج تغذية صحية</h3>
            <p class="text-gray-600">برامج غذائية مصممة لتلبية احتياجاتك من السعرات الحرارية والمغذيات الضرورية.</p>
        </div>
        <div class="feature-card bg-white p-6 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-transform duration-300">
            <div class="p-4 rounded-full bg-teal-100 inline-flex items-center justify-center mb-4">
                <i class="fas fa-chart-line text-3xl text-teal-600"></i>
            </div>
            <h3 class="text-xl font-bold mb-2 text-gray-800">تتبع التقدم والنتائج</h3>
            <p class="text-gray-600">تتبع وزنك وقياساتك وتقدمك نحو تحقيق أهدافك بانتظام.</p>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="section-title mb-6">عن فيت ناو</h2>
            <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                <strong>فيت ناو</strong> هو منصة صحة ولياقة بدنية رقمية مصممة لمساعدة الأفراد على تحسين نمط حياتهم من خلال مزيج من خطط التمارين المخصصة، وبرامج التغذية، والمحتوى التوعوي الصحي.
            </p>
            <p class="text-gray-600 mb-4 leading-relaxed">
                من خلال عملية تسجيل بسيطة، ينشئ المستخدمون حساباتهم، ويدخلون معلوماتهم الصحية الأساسية (العمر، الوزن، الطول، والأهداف)، ويكتسبون الوصول إلى مجموعة واسعة من موارد اللياقة والتغذية.
            </p>
            <p class="text-gray-600 leading-relaxed">
                يعتمد النظام على بنية تقنية حديثة، مما يضمن قابلية التوسع والأمان والأداء، ويتم استضافته على السحابة لضمان التوفر والموثوقية للمستخدمين.
            </p>
        </div>
        <div>
            <img src="<?php echo e(asset('assets/logo1.png')); ?>" alt="" class="rounded-2xl shadow-xl">
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-gray-800 text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-12">إحصائياتنا</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-6 bg-gray-700 rounded-2xl shadow-lg">
                <h3 class="text-4xl font-extrabold mb-2">120+</h3>
                <p class="text-lg font-medium text-gray-300">خطة تمارين مخصصة</p>
            </div>
            <div class="p-6 bg-gray-700 rounded-2xl shadow-lg">
                <h3 class="text-4xl font-extrabold mb-2">300+</h3>
                <p class="text-lg font-medium text-gray-300">برنامج غذائي</p>
            </div>
            <div class="p-6 bg-gray-700 rounded-2xl shadow-lg">
                <h3 class="text-4xl font-extrabold mb-2">500+</h3>
                <p class="text-lg font-medium text-gray-300">مستخدم نشط</p>
            </div>
            <div class="p-6 bg-gray-700 rounded-2xl shadow-lg">
                <h3 class="text-4xl font-extrabold mb-2">500+</h3>
                <p class="text-lg font-medium text-gray-300">مستخدم نشط</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-10 mt-9 bg-gradient-to-r from-teal-500 to-teal-600 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">ابدأ رحلتك نحو الأفضل اليوم!</h2>
        <p class="text-lg mb-8">سجل الآن واكتشف كيف يمكن أن يغير فيت ناو حياتك.</p>
        <a href="#" class="inline-block px-2 py-1 bg-white text-teal-600 font-semibold text-lg rounded-full shadow-lg hover:bg-gray-100 transition-colors duration-300">سجل مجاناً <i class="fas fa-arrow-left mr-2"></i></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/website/home.blade.php ENDPATH**/ ?>