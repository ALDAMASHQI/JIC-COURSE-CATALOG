<?php $__env->startSection('title', 'Products - Pharmahub'); ?>

<?php $__env->startSection('content'); ?>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="display-6 fw-bold mb-4">Explore All Products </h1>
                </div>
            </div>
        </div>
    </section>




    <div class="container mt-5 pt-4">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <?php if($selectedVendor): ?>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body d-flex align-items-center">
                                    <div class="vendor-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-4" style="width:70px; height:70px;">
                                        <i class="fas fa-clinic-medical fa-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1"><?php echo e($selectedVendor->pharmacy_name); ?></h4>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-map-marker-alt me-2"></i><?php echo e($selectedVendor->location); ?>

                                        </p>
                                        <div class="text-warning mb-2">
                                            <?php
                                                $vendorRating = \App\Models\Review::join('products', 'reviews.product_id', '=', 'products.product_id') ->where('products.vendor_id', $selectedVendor->vendor_id) ->avg('reviews.rating') ?? 0;
                                              $vendorReviewCount = \App\Models\Review::join('products', 'reviews.product_id', '=', 'products.product_id')
                                              ->where('products.vendor_id', $selectedVendor->vendor_id)
                                              ->count();
                                                $reviews = \App\Models\Review::join('products', 'reviews.product_id', '=', 'products.product_id')
                                              ->where('products.vendor_id', $selectedVendor->vendor_id)
                                              ->get();
                                            ?>
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
                                        <p class="mb-0 small text-secondary">
                                            <?php echo e($selectedVendor->pharmacy_name); ?> is a trusted pharmacy providing quality medicines.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Section -->
                        <div class="col-md-12 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Recent Reviews</h5>
                                </div>
                                <div class="card-body">
                                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="mb-3 pb-3 border-bottom">
                                            <div class="d-flex justify-content-between">
                                                <strong><?php echo e($review->user->name ?? 'Anonymous'); ?></strong>
                                                <small class="text-muted"><?php echo e($review->created_at->format('M d, Y')); ?></small>
                                            </div>
                                            <div class="text-warning small mb-1">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="<?php echo e($i <= $review->rating ? 'fas' : 'far'); ?> fa-star"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <p class="mb-0 text-muted"><?php echo e($review->comment); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p class="text-muted">No reviews yet for this pharmacy.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Filters</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" method="GET" action="<?php echo e(route('products.index')); ?>">
                            <!-- Search -->
                            <div class="mb-3">
                                <label class="form-label">Search</label>
                                <input type="text" name="search" class="form-control"
                                       value="<?php echo e(request('search')); ?>" placeholder="Search products...">
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->category_id); ?>"
                                            <?php echo e(request('category') == $category->category_id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Vendor -->
                            <div class="mb-3">
                                <label class="form-label">Pharmacy</label>
                                <select name="vendor" class="form-select">
                                    <option value="">All Pharmacies</option>
                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vendor->vendor_id); ?>"
                                            <?php echo e(request('vendor') == $vendor->vendor_id ? 'selected' : ''); ?>>
                                            <?php echo e($vendor->pharmacy_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-3">
                                <label class="form-label">Price Range</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control"
                                               value="<?php echo e(request('min_price')); ?>" placeholder="Min" min="0">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control"
                                               value="<?php echo e(request('max_price')); ?>" placeholder="Max" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Checkboxes -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="prescription_required"
                                           value="1" id="prescriptionCheck" <?php echo e(request('prescription_required') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="prescriptionCheck">
                                        Prescription Required
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="in_stock"
                                           value="1" id="stockCheck" <?php echo e(request('in_stock') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="stockCheck">
                                        In Stock Only
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                        </form>
                    </div>
                </div>
                    <?php endif; ?>
            </div>

            <!-- Products List -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-0">
                            <?php if(isset($category)): ?>
                                <?php echo e($category->name); ?> Products
                            <?php else: ?>
                                All Products
                            <?php endif; ?>
                        </h2>
                        <p class="text-muted mb-0">Showing <?php echo e($products->total()); ?> products</p>
                    </div>

                    <!-- Sort Options -->
                    <div class="d-flex align-items-center gap-3">
                        <label class="form-label mb-0">Sort by:</label>
                        <select class="form-select" style="width: auto;" onchange="this.form.submit()" name="sort" form="filter-form">
                            <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest</option>
                            <option value="price_low" <?php echo e(request('sort') == 'price_low' ? 'selected' : ''); ?>>Price: Low to High</option>
                            <option value="price_high" <?php echo e(request('sort') == 'price_high' ? 'selected' : ''); ?>>Price: High to Low</option>
                            <option value="name" <?php echo e(request('sort') == 'name' ? 'selected' : ''); ?>>Name A-Z</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="card product-card h-100">
                                <?php if($product->prescription_required): ?>
                                    <span class="badge bg-danger badge-prescription">Prescription</span>
                                <?php endif; ?>
                                <?php if($product->stock_quantity == 0): ?>
                                    <span class="badge bg-secondary badge-stock">Out of Stock</span>
                                <?php elseif($product->stock_quantity < 10): ?>
                                    <span class="badge bg-warning text-dark badge-stock">Low Stock</span>
                                <?php endif; ?>

                                <img src="<?php echo e($product->image_url ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=300&fit=crop'); ?>"
                                     class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo e(Str::limit($product->name, 50)); ?></h5>
                                    <p class="text-muted small"><?php echo e($product->category->name); ?></p>

                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold text-primary">SAR <?php echo e(number_format($product->price, 2)); ?></span>
                                        <small class="text-muted">By: <?php echo e($product->vendor->pharmacy_name); ?></small>
                                    </div>

                                    <!-- Rating -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
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
                                        <span class="badge bg-light text-dark"><?php echo e($product->dosage_form); ?></span>
                                    </div>

                                    <div class="d-flex w-100 gap-2 mt-auto">
                                        <a style="border-radius: 2px;" href="<?php echo e(route('products.show', $product->product_id)); ?>" class="btn btn-outline-primary  w-50">
                                            <i class="fas fa-eye me-2"></i>
                                        </a>
                                        <?php if($product->stock_quantity > 0): ?>
                                            <button style="border-radius: 5px;" class="btn btn-primary add-to-cart  border-0 w-50"
                                                    data-product-id="<?php echo e($product->product_id); ?>">
                                                <i class="fa fa-cart-plus me-2" aria-hidden="true"></i>

                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-danger" disabled>Out of Stock</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <h4>No products found</h4>
                                <p class="text-muted">Try adjusting your filters or search terms</p>
                                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">Clear Filters</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if($products->hasPages()): ?>
                    <div class="d-flex justify-content-center mt-5">
                        <?php echo e($products->appends(request()->query())->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const button = this;

                    // Show loading state
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
                    button.disabled = true;

                    fetch('<?php echo e(route("cart.add")); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // ✅ Native JS alert
                                alert(" Success: " + data.message);
                                updateCartCount();
                            } else {
                                if (data.login_required) {
                                    window.location.href = '<?php echo e(route("login")); ?>';
                                } else {
                                    alert(" Error: " + data.message);
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("⚠️ Error: An error occurred");
                        })
                        .finally(() => {
                            // Reset button state
                            button.innerHTML = '<i class="fa fa-cart-plus me-2" aria-hidden="true"></i>';
                            button.disabled = false;
                        });
                });
            });

            function updateCartCount() {
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmahub\resources\views/products/index.blade.php ENDPATH**/ ?>