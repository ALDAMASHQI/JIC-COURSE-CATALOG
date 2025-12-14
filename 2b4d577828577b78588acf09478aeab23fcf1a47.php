<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'نظام إدارة الميزانية'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/images/logo.png')); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('admin/css/rtl.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/custom.css')); ?>" />
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <?php echo $__env->make('user.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
      <?php echo $__env->make('user.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--  Header End -->
        <div class="container-fluid">
            <?php echo $__env->yieldContent('content'); ?>
            <div class="py-6 px-6 text-center">
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('user.layouts.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\ubs\resources\views/user/layouts/app.blade.php ENDPATH**/ ?>