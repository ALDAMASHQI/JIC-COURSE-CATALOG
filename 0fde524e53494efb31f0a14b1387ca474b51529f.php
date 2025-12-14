<?php $__env->startSection('content'); ?>
        <!-- Featured Vendors -->
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title">Our Pharmacies</h2>
                <p class="text-muted mb-4">Trusted pharmacies on our platform</p>
                <div class="row g-4">
                    <?php $__currentLoopData = $featuredVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="card vendor-card bg-white h-100">
                                <div class="card-body text-center">
                                    <h5><?php echo e($vendor->pharmacy_name); ?></h5>
                                    <p class="text-muted">Verified • <?php echo e($vendor->location); ?></p>
                                    <?php
                                        $vendorRating = \App\Models\Review::join('products', 'reviews.product_id', '=', 'products.product_id')
                                            ->where('products.vendor_id', $vendor->vendor_id)
                                            ->avg('reviews.rating') ?? 0;
                                        $vendorReviewCount = \App\Models\Review::join('products', 'reviews.product_id', '=', 'products.product_id')
                                            ->where('products.vendor_id', $vendor->vendor_id)
                                            ->count();
                                    ?>
                                    <div class="text-warning mb-2">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= floor($vendorRating)): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif($i == ceil($vendorRating) && $vendorRating != floor($vendorRating)): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span class="text-muted ms-1">(<?php echo e($vendorReviewCount); ?> reviews)</span>
                                    </div>
                                    <p class="card-text"><?php echo e($vendor->pharmacy_name); ?> provides quality medicines with reliable service.</p>
                                    <a href="<?php echo e(route('products.index').'?vendor='.$vendor->vendor_id); ?>" class="btn btn-outline-primary">View Medicines</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/vendors.blade.php ENDPATH**/ ?>