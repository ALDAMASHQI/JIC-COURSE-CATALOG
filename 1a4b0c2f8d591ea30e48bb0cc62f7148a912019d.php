

<?php $__env->startSection('title', 'تواصل معنا'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Hero Section with Background Image -->
    <section class="hero-section position-relative text-white text-center d-flex align-items-center"
             style="background: url('<?php echo e(asset('assets/bg.jpg')); ?>') center/cover no-repeat; height: 70vh;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.6;"></div>
        <div class="container position-relative z-2">
            <h1 class="display-3 fw-bold mb-3">تواصل معنا</h1>
            <p class="lead mb-4">يسعدنا تواصلك معنا في أي وقت، نحن هنا لمساعدتك والرد على استفساراتك.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact-us" class="container py-5">
        <div class="row align-items-center bg-white p-4">


            <!-- Contact Info -->
            <div class="col-lg-12">
                <h2 class="fw-bold mb-4">معلومات التواصل</h2>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt text-success me-2"></i>
                        الرياض، المملكة العربية السعودية
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        support@fitnow.com
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-phone-alt text-warning me-2"></i>
                        +966 500 000 000
                    </li>
                </ul>
                <div class="mt-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.04609317461!2d46.6753!3d24.7136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f0388e6f0b0cf%3A0x8a76a4f44d6f51b4!2sRiyadh!5e0!3m2!1sen!2ssa!4v1672928283923!5m2!1sen!2ssa"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\fit_now\resources\views/website/contact.blade.php ENDPATH**/ ?>