<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <!-- Vendor Header -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-4">
                    <div class="vendor-avatar bg-primary text-white d-flex align-items-center justify-content-center rounded-circle" style="width:80px; height:80px; font-size:1.5rem;">
                        <i class="fas fa-clinic-medical"></i>
                    </div>
                </div>
                <div>
                    <h3 class="mb-1"><?php echo e($vendor->pharmacy_name); ?></h3>
                    <p class="text-muted mb-1"><i class="fas fa-map-marker-alt me-2"></i><?php echo e($vendor->location); ?></p>
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
                </div>
            </div>
        </div>

        <!-- Vendor Description -->
        <div class="mb-5">
            <h4>About Pharmacy</h4>
            <p class="text-muted">
                <?php echo e($vendor->description ?? 'This pharmacy provides high quality medicines with trusted service to customers.'); ?>

            </p>
        </div>

        <!-- Medicines -->
        <div>
            <h4 class="mb-4">Medicines Available</h4>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $vendor->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card medicine-card h-100">
                            <div class="position-relative">
                                <img src="<?php echo e($product->image_url ?? asset('default-medicine.png')); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height:200px; object-fit:cover;">
                                <?php if($product->prescription_required): ?>
                                    <span class="badge bg-danger badge-prescription">Rx</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                <p class="text-muted small"><?php echo e($product->category); ?></p>
                                <p class="fw-bold text-primary mb-2">$<?php echo e(number_format($product->price, 2)); ?></p>
                                <a href="<?php echo e(route('products.show', $product->product_id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                <button class="btn btn-sm btn-outline-success add-to-cart mt-2" data-product-id="<?php echo e($product->product_id); ?>">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">No medicines listed by this pharmacy yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/vendor.blade.php ENDPATH**/ ?>