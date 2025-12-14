<?php $__env->startSection('title', 'Manage Products - Pharmahub'); ?>
<?php $__env->startSection('page-title', 'Manage Products'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- Success/Error Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Header Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-darkblue"><i class="fas fa-pills"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-2"><?php echo e($products->count()); ?></h5>
                        <small>Total Products</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-success"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-2"><?php echo e($products->where('status', 'active')->count()); ?></h5>
                        <small>Active Products</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-warning"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-2"><?php echo e($products->where('stock_quantity', '<', 10)->count()); ?></h5>
                        <small>Low Stock</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-info"><i class="fas fa-prescription"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-2"><?php echo e($products->where('prescription_required', true)->count()); ?></h5>
                        <small>Prescription Required</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Products List</h5>
                <a href="<?php echo e(route('vendor.products.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Product
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="productsTable">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Prescription</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>"
                                         class="product-thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                </td>
                                <td>
                                    <div>
                                        <strong><?php echo e($product->name); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo e($product->dosage_form); ?></small>
                                    </div>
                                </td>
                                <td><?php echo e($product->category->name); ?></td>
                                <td>
                                    <strong class="text-primary">SAR <?php echo e(number_format($product->price, 2)); ?></strong>
                                </td>
                                <td>
                                <span class="badge bg-<?php echo e($product->stock_quantity > 10 ? 'success' : ($product->stock_quantity > 0 ? 'warning' : 'danger')); ?>">
                                    <?php echo e($product->stock_quantity); ?>

                                </span>
                                </td>
                                <td>
                                    <form action="<?php echo e(route('vendor.products.update-status', $product->product_id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="btn btn-sm btn-<?php echo e($product->status === 'active' ? 'success' : 'danger'); ?>">
                                            <?php echo e(ucfirst($product->status)); ?>

                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <?php if($product->prescription_required): ?>
                                        <span class="badge bg-danger">Required</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Not Required</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo e(route('vendor.products.edit', $product->product_id)); ?>"
                                           class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('vendor.products.destroy', $product->product_id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Simple DataTable functionality
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('productsTable');
            if (table) {
                // Add search functionality
                const searchInput = document.createElement('input');
                searchInput.type = 'text';
                searchInput.placeholder = 'Search products...';
                searchInput.className = 'form-control mb-3';
                searchInput.style.maxWidth = '300px';

                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const rows = table.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });

                table.parentNode.insertBefore(searchInput, table);
            }

            // Auto-dismiss alerts
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    if (alert.parentNode) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                });
            }, 5000);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmahub\resources\views/vendor/products/index.blade.php ENDPATH**/ ?>