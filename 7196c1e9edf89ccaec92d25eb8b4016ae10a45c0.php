<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'FitNow'); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/custom.css')); ?>">
</head>
<body class="bg-gray-100">
<!-- Navbar -->
<nav class="bg-white shadow-sm">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <img style="height: 100px;" src="<?php echo e(asset('assets/logo1.png')); ?>">
        </div>
        <div class="hidden md:flex items-center space-x-8 space-x-reverse">
            <a href="<?php echo e(route('home')); ?>" class="  <?php echo e(request()->routeIs('home') ? 'active2' : ''); ?> text-gray-600 hover:text-gray-900 font-medium">الرئيسية</a>

            <a href="<?php echo e(route('plans.workouts.index')); ?>" class="<?php echo e(request()->routeIs('plans.workouts.*') ? 'active2' : ''); ?> text-gray-600 hover:text-gray-900 font-medium">
                خطط التمارين
            </a>
            <a href="<?php echo e(route('plans.nutritions.index')); ?>" class="<?php echo e(request()->routeIs('plans.nutritions.*') ? 'active2' : ''); ?> text-gray-600 hover:text-gray-900 font-medium">
                الخطط الغذائية
            </a>

            <a href="<?php echo e(route('services')); ?>" class="  <?php echo e(request()->routeIs('services') ? 'active2' : ''); ?> text-gray-600 hover:text-gray-900 font-medium">الخدمات</a>
            <a href="<?php echo e(route('about')); ?>" class="  <?php echo e(request()->routeIs('about') ? 'active2' : ''); ?> text-gray-600 hover:text-gray-900 font-medium">عنّا</a>
            <a href="<?php echo e(route('contact')); ?>" class="  <?php echo e(request()->routeIs('contact') ? 'active2' : ''); ?> text-gray-600 hover:text-gray-900 font-medium">تواصل معنا</a>
        </div>
        
        <div class="hidden md:flex items-center">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('auth.login')); ?>"
                   class="px-2 py-2 border border-teal-500 text-sm font-medium rounded-md text-teal-500 hover:bg-teal-50 mr-2">
                    <i class="fas fa-sign-in-alt ml-2"></i> تسجيل الدخول
                </a>
                <a href="<?php echo e(route('auth.register')); ?>"
                   class="px-2 py-2 border border-teal-500 text-sm font-medium rounded-md text-teal-500 hover:bg-teal-50 mr-2">
                    <i class="fas fa-user-plus ml-2"></i> التسجيل
                </a>
            <?php else: ?>
                <?php $isAdmin = auth()->user()->role === 'admin'; ?>

                <a href="<?php echo e($isAdmin ? route('admin.dashboard') : route('user.dashboard')); ?>"
                   class="px-2 py-2 border border-teal-500 text-sm font-medium rounded-md text-teal-600 hover:bg-teal-50 mr-2">
                    <i class="fas fa-tachometer-alt ml-2"></i>  الصفحة الشخصية
                </a>

                <form action="<?php echo e(route('auth.logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                            class="px-2 py-2 border border-rose-500 text-sm font-medium rounded-md text-rose-600 hover:bg-rose-50 mr-2">
                        <i class="fas fa-sign-out-alt ml-2"></i> تسجيل الخروج
                    </button>
                </form>
            <?php endif; ?>
        </div>

    </div>
</nav>
<!-- Page Content -->
<?php echo $__env->yieldContent('content'); ?>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-3 mt-9">
    <div class="container mx-auto px-6 text-center">
        <div class="flex flex-col md:flex-row justify-between items-center mb-0">
            <div class="flex items-center mb-4 md:mb-0">
                <img style="height: 66px;
    background: white;
    border-radius: 39px;" src="<?php echo e(asset('assets/logo1.png')); ?>">
            </div>
            <div class="space-x-4 space-x-reverse">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-white transition-colors duration-300">الرئيسية</a>
                <a href="<?php echo e(route('services')); ?>" class="hover:text-white transition-colors duration-300">الخدمات</a>
                <a href="<?php echo e(route('about')); ?>" class="hover:text-white transition-colors duration-300">عنّا</a>
                <a href="<?php echo e(route('contact')); ?>" class="hover:text-white transition-colors duration-300">تواصل معنا</a>
            </div>
        </div>
        <p style="    border-top: 1px solid #3c3c3c;
    padding-top: 10px;" class="text-sm">&copy; 2025 FitNow. جميع الحقوق محفوظة.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\fit_now\resources\views/website/layouts/app.blade.php ENDPATH**/ ?>