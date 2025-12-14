<?php $__env->startSection('title', $product->name . ' - Pharmahub'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="text-decoration-none"><i class="fas fa-home me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>" class="text-decoration-none">Products</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('products.category', $product->category->category_id)); ?>" class="text-decoration-none"><?php echo e($product->category->name); ?></a></li>
                <li class="breadcrumb-item active"><?php echo e(Str::limit($product->name, 25)); ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-image-container">
                    <div class="main-image mb-4">
                        <img src="<?php echo e($product->image_url ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&h=400&fit=crop'); ?>"
                             class="img-fluid rounded-3 shadow-sm" alt="<?php echo e($product->name); ?>" id="mainProductImage">
                    </div>
                    <?php if($product->prescription_required): ?>
                        <div class="prescription-badge">
                            <i class="fas fa-prescription me-2"></i>Prescription Required
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-details-card">
                    <div class="product-header mb-4">
                        <h1 class="product-title"><?php echo e($product->name); ?></h1>
                        <p class="product-category"><i class="fas fa-tag me-2"></i><?php echo e($product->category->name); ?> • <?php echo e($product->dosage_form); ?></p>

                        <!-- Rating -->
                        <div class="rating-section mb-3">
                            <div class="rating-stars">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($i <= floor($average_rating)): ?>
                                        <i class="fas fa-star filled"></i>
                                    <?php elseif($i == ceil($average_rating) && $average_rating != floor($average_rating)): ?>
                                        <i class="fas fa-star-half-alt filled"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <span class="rating-value ms-2"><?php echo e(number_format($average_rating, 1)); ?></span>
                            </div>
                            <span class="review-count">(<?php echo e($review_count); ?> reviews)</span>
                        </div>
                    </div>

                    <!-- Price & Stock -->
                    <div class="price-section mb-4">
                        <div class="price-tag">SAR <?php echo e(number_format($product->price, 2)); ?></div>
                        <div class="stock-status <?php echo e($product->stock_quantity > 0 ? 'in-stock' : 'out-of-stock'); ?>">
                            <i class="fas <?php echo e($product->stock_quantity > 0 ? 'fa-check-circle' : 'fa-times-circle'); ?> me-2"></i>
                            <?php echo e($product->stock_quantity > 0 ? 'In Stock (' . $product->stock_quantity . ' available)' : 'Out of Stock'); ?>

                        </div>
                    </div>

                    <!-- Vendor Info -->
                    <div class="vendor-card mb-4">
                        <div class="vendor-info">
                            <div class="vendor-avatar">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="vendor-details">
                                <h6>Sold by <?php echo e($product->vendor->pharmacy_name); ?></h6>
                                <p class="vendor-location"><i class="fas fa-map-marker-alt me-1"></i><?php echo e($product->vendor->location); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart Section -->
                    <?php if($product->stock_quantity > 0): ?>
                        <div class="cart-section mb-4">
                            <div class="quantity-selector">
                                <label class="form-label">Quantity:</label>
                                <div class="quantity-controls">
                                    <button class="quantity-btn" id="decreaseQty">-</button>
                                    <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>">
                                    <button class="quantity-btn" id="increaseQty">+</button>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add-to-cart w-100" data-product-id="<?php echo e($product->product_id); ?>">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="out-of-stock-section">
                            <button class="btn btn-secondary w-100" disabled>
                                <i class="fas fa-ban me-2"></i>Out of Stock
                            </button>
                            <p class="text-muted text-center mt-2">We'll notify you when this product is back in stock</p>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="product-tabs">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">Product Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews (<?php echo e($review_count); ?>)</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="p-4">
                                <h4>About this product</h4>
                                <p class="lead"><?php echo e($product->description ?: 'No description available for this product.'); ?></p>
                            </div>
                        </div>

                        <!-- Details Tab -->
                        <div class="tab-pane fade" id="details" role="tabpanel">
                            <div class="p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-striped">
                                            <tr>
                                                <th width="40%">Product Name</th>
                                                <td><?php echo e($product->name); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Dosage Form</th>
                                                <td><?php echo e($product->dosage_form); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td><?php echo e($product->category->name); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped">
                                            <tr>
                                                <th width="40%">Prescription Required</th>
                                                <td>
                                                    <span class="badge <?php echo e($product->prescription_required ? 'bg-warning' : 'bg-success'); ?>">
                                                        <?php echo e($product->prescription_required ? 'Yes' : 'No'); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Vendor</th>
                                                <td><?php echo e($product->vendor->pharmacy_name); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Stock Status</th>
                                                <td>
                                                    <span class="badge <?php echo e($product->stock_quantity > 0 ? 'bg-success' : 'bg-danger'); ?>">
                                                        <?php echo e($product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock'); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="p-4">
                                <?php if($review_count > 0): ?>
                                    <div class="reviews-container">
                                        <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="review-item">
                                                <div class="review-header">
                                                    <div class="reviewer-info">
                                                        <div class="reviewer-avatar">
                                                            <?php echo e(substr($review->user->name, 0, 1)); ?>

                                                        </div>
                                                        <div>
                                                            <strong><?php echo e($review->user->name); ?></strong>
                                                            <div class="rating-stars">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <i class="fas fa-star<?php echo e($i <= $review->rating ? ' filled' : ''); ?>"></i>
                                                                <?php endfor; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="review-date"><?php echo e($review->created_at->format('F d, Y')); ?></span>
                                                </div>
                                                <p class="review-comment"><?php echo e($review->comment); ?></p>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                        <h5>No reviews yet</h5>
                                        <p class="text-muted">Be the first to review this product!</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <?php if($related_products->count() > 0): ?>
            <section class="related-products mt-5">
                <div class="section-header mb-4">
                    <h3>You might also like</h3>
                    <p class="text-muted">Similar products you may be interested in</p>
                </div>
                <div class="row g-4">
                    <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-card related-product-card">
                                <div class="product-image">
                                    <img src="<?php echo e($related_product->image_url ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=300&fit=crop'); ?>"
                                         alt="<?php echo e($related_product->name); ?>">
                                    <?php if($related_product->prescription_required): ?>
                                        <span class="prescription-badge-sm">RX</span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name"><?php echo e(Str::limit($related_product->name, 50)); ?></h6>
                                    <p class="product-category"><?php echo e($related_product->category->name); ?></p>
                                    <div class="product-price">SAR <?php echo e(number_format($related_product->price, 2)); ?></div>
                                    <a href="<?php echo e(route('products.show', $related_product->product_id)); ?>" class="btn btn-outline-primary btn-sm w-100">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity controls
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decreaseQty');
            const increaseBtn = document.getElementById('increaseQty');

            if (decreaseBtn && increaseBtn) {
                decreaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });

                increaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    let maxValue = parseInt(quantityInput.max);
                    if (currentValue < maxValue) {
                        quantityInput.value = currentValue + 1;
                    }
                });

                quantityInput.addEventListener('change', function() {
                    let value = parseInt(this.value);
                    let maxValue = parseInt(this.max);
                    let minValue = parseInt(this.min);

                    if (value < minValue) this.value = minValue;
                    if (value > maxValue) this.value = maxValue;
                });
            }

            // Add to cart functionality
            const addToCartBtn = document.querySelector('.btn-add-to-cart');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const quantity = document.getElementById('quantity').value;
                    const button = this;

                    // Show loading state
                    const originalText = button.innerHTML;
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
                            quantity: parseInt(quantity)
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // ✅ Native alert
                                alert("✅ Success: " + data.message);
                                updateCartCount();

                                // Add success animation
                                button.innerHTML = '<i class="fas fa-check me-2"></i>Added to Cart!';
                                setTimeout(() => {
                                    button.innerHTML = originalText;
                                }, 2000);
                            } else {
                                if (data.login_required) {
                                    window.location.href = '<?php echo e(route("login")); ?>';
                                } else {
                                    alert("❌ Error: " + data.message);
                                    button.innerHTML = originalText;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("⚠️ Error: An error occurred");
                            button.innerHTML = originalText;
                        })
                        .finally(() => {
                            button.disabled = false;
                        });
                });
            }

            function updateCartCount() {
                fetch('<?php echo e(route("cart.count")); ?>')
                    .then(response => response.json())
                    .then(data => {
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.count;
                            // Add animation to cart count
                            cartCount.classList.add('pulse');
                            setTimeout(() => {
                                cartCount.classList.remove('pulse');
                            }, 500);
                        }
                    });
            }

            // Tab functionality
            const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
            tabLinks.forEach(link => {
                link.addEventListener('click', function() {
                    tabLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmahub\resources\views/products/show.blade.php ENDPATH**/ ?>