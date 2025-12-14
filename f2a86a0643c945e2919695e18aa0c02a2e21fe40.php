<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Your Health, Our Priority</h1>
                    <p class="lead mb-4">Find all your medical needs from trusted pharmacies. Fast delivery, genuine medicines,
                        and expert care.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-light btn-lg">Shop Now <i class="fas fa-arrow-right ms-2"></i></a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-light btn-lg">Become a Vendor</a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Quick Order</h5>
                            <form action="<?php echo e(route('products.search')); ?>" method="GET">
                                <div class="mb-3">
                                    <label class="form-label text-dark">Search Medicines</label>
                                    <input type="text" name="search" class="form-control" placeholder="Medicine name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-dark">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="">All Categories</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->category_id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="prescription_required" class="form-check-input" id="prescriptionCheck">
                                    <label class="form-check-label" for="prescriptionCheck">Prescription Required</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Search Medicines</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="cats" class="py-5">
        <div class="container">
            <h2 class="section-title">Shop by Category</h2>
            <div class="row g-4">
                <?php $__currentLoopData = $categories->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="category-card card text-center p-4">
                            <?php
                                $icons = [
                                    'Pain Relief' => 'fa-tablets',
                                    'Antibiotics' => 'fa-prescription-bottle',
                                    'Vitamins & Supplements' => 'fa-capsules',
                                    'Cold & Flu' => 'fa-head-side-cough',
                                    'Digestive Health' => 'fa-stomach',
                                    'Skin Care' => 'fa-allergies',
                                    'Cardiovascular' => 'fa-heartbeat',
                                    'Diabetes Care' => 'fa-syringe',
                                    'Allergy' => 'fa-allergies',
                                    'Mental Health' => 'fa-brain'
                                ];
                                $icon = $icons[$category->name] ?? 'fa-pills';
                            ?>
                            <i class="fas <?php echo e($icon); ?> feature-icon"></i>
                            <h5><?php echo e($category->name); ?></h5>
                            <?php
                                $productCount = \App\Models\Product::where('category_id', $category->category_id)
                                    ->where('status', 'active')
                                    ->count();
                            ?>
                            <p class="text-muted"><?php echo e($productCount); ?> products</p>
                            <a href="<?php echo e(route('products.category', $category->category_id)); ?>" class="btn btn-outline-primary mt-2">Explore</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </section>

    <!-- Featured Medicines -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">Featured Medicines</h2>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">View All <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
            <div class="row g-4">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="medicine-card card h-100">
                            <?php if($product->prescription_required): ?>
                                <span class="badge bg-danger badge-prescription">Prescription</span>
                            <?php endif; ?>
                            <img src="<?php echo e($product->image_url ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=300&fit=crop'); ?>"
                                 class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                <p class="text-muted"><?php echo e($product->category->name); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">SAR <?php echo e(number_format($product->price, 2)); ?></span>
                                    <span class="badge <?php echo e($product->stock_quantity > 10 ? 'bg-success' : ($product->stock_quantity > 0 ? 'bg-warning text-dark' : 'bg-danger')); ?>">
                                    <?php echo e($product->stock_quantity > 10 ? 'In Stock' : ($product->stock_quantity > 0 ? 'Low Stock' : 'Out of Stock')); ?>

                                </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="text-muted">By: <?php echo e($product->vendor->pharmacy_name); ?></small>
                                    <div class="text-warning">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= floor($product->average_rating)): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif($i == ceil($product->average_rating) && $product->average_rating != floor($product->average_rating)): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span class="text-muted ms-1">(<?php echo e($product->review_count); ?>)</span>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-auto pt-3">
                                    <?php if($product->stock_quantity > 0): ?>
                                        <button class="btn btn-outline-primary add-to-cart" data-product-id="<?php echo e($product->product_id); ?>">
                                            Add to Cart
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary" disabled>Out of Stock</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">How It Works</h2>
            <p class="text-center text-muted mb-5">Simple steps to get your medicines</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="how-it-works-step">
                        <div class="step-number">1</div>
                        <i class="fas fa-search feature-icon"></i>
                        <h5>Search Medicines</h5>
                        <p class="text-muted">Find the medicines you need by name, category or symptoms</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-it-works-step">
                        <div class="step-number">2</div>
                        <i class="fas fa-prescription feature-icon"></i>
                        <h5>Upload Prescription</h5>
                        <p class="text-muted">Upload prescription for medicines that require it (if needed)</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-it-works-step">
                        <div class="step-number">3</div>
                        <i class="fas fa-truck feature-icon"></i>
                        <h5>Get Delivery</h5>
                        <p class="text-muted">Receive your order at your doorstep with fast delivery</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Vendors -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Featured Pharmacies</h2>
            <p class="text-muted mb-4">Trusted pharmacies on our platform</p>
            <div class="row g-4">
                <?php $__currentLoopData = $featuredVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card vendor-card h-100">
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

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');

                    // Here you would typically make an AJAX request to add to cart
                    fetch('<?php echo e(route("cart.add")); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Product added to cart successfully!');
                                // Update cart count in navbar if you have one
                                updateCartCount();
                            } else {
                                alert('Error adding product to cart: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error adding product to cart');
                        });
                });
            });

            function updateCartCount() {
                // Update cart count in navbar
                fetch('<?php echo e(route("cart.count")); ?>')
                    .then(response => response.json())
                    .then(data => {
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.count;
                        }
                    });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/home.blade.php ENDPATH**/ ?>