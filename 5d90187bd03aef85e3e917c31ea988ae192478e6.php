<?php $__env->startSection('title', 'Vendor Dashboard - Pharmahub'); ?>
<?php $__env->startSection('page-title', 'Dashboard Overview'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Stats Row -->
    <h5 class="section-title"><i class="fas fa-chart-bar me-2"></i>Business Overview</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="stat-icon icon-darkblue"><i class="fas fa-pills"></i></div>
                <div>
                    <h5 class="mb-0 text-center mt-2"><?php echo e($stats['total_products']); ?></h5>
                    <small>Total Products</small><br>
                    <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo e($stats['active_products']); ?> active</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="stat-icon icon-earth"><i class="fas fa-shopping-cart"></i></div>
                <div>
                    <h5 class="mb-0 text-center mt-2"><?php echo e($stats['total_orders']); ?></h5>
                    <small>Total Orders</small><br>
                    <span class="text-success"><i class="fas fa-arrow-up"></i> SAR <?php echo e(number_format($stats['total_sales'], 2)); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="stat-icon icon-gray"><i class="fas fa-star"></i></div>
                <div>
                    <h5 class="mb-0 text-center mt-2"><?php echo e($stats['total_reviews']); ?></h5>
                    <small>Customer Reviews</small><br>
                    <span class="text-success"><i class="fas fa-arrow-up"></i> <?php echo e(number_format($stats['avg_rating'], 1)); ?> avg</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="stat-icon icon-darkblue"><i class="fas fa-box"></i></div>
                <div>
                    <h5 class="mb-0 text-center mt-2"><?php echo e($stats['low_stock']); ?></h5>
                    <small>Low Stock Items</small><br>
                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Needs attention</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Highlight Section -->
    <h5 class="section-title"><i class="fas fa-star me-2"></i>Priority Items</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card highlight-card critical">
                <h6 style="color: var(--earth);"><i class="fas fa-exclamation-circle me-2"></i>Low Stock</h6>
                <h3><?php echo e($stats['low_stock']); ?></h3>
                <small>Products need restocking</small>
                <div class="progress mt-3">
                    <div class="progress-bar" style="width: <?php echo e(min(($stats['low_stock'] / $stats['total_products']) * 100, 100)); ?>%; background: var(--earth);"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card highlight-card due">
                <h6 style="color: var(--dark-blue);"><i class="fas fa-calendar-day me-2"></i>Pending Orders</h6>
                <h3><?php echo e($stats['pending_orders']); ?></h3>
                <small>Orders to process</small>
                <div class="progress mt-3">
                    <div class="progress-bar" style="width: <?php echo e(min(($stats['pending_orders'] / max($stats['total_orders'], 1)) * 100, 100)); ?>%; background: var(--dark-blue);"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card highlight-card compliance">
                <h6 style="color: var(--dark-blue);"><i class="fas fa-chart-line me-2"></i>Sales This Month</h6>
                <h3>SAR <?php echo e(number_format($stats['monthly_sales'], 2)); ?></h3>
                <small>Current month revenue</small>
                <div class="progress mt-3">
                    <div class="progress-bar" style="width: <?php echo e(min(($stats['monthly_sales'] / max($stats['total_sales'], 1)) * 100, 100)); ?>%; background: var(--dark-blue);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <h5 class="section-title"><i class="fas fa-history me-2"></i>Recent Activity</h5>

    <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="activity-item activity-<?php echo e($activity['type']); ?>">
            <i class="<?php echo e($activity['icon']); ?> me-2"></i><strong><?php echo e($activity['title']); ?></strong>
            <div class="text-muted small mt-1"><i class="fas fa-clock me-1"></i><?php echo e($activity['time']); ?></div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Recent Orders Table -->
    <h5 class="section-title mt-5"><i class="fas fa-shopping-cart me-2"></i>Recent Orders</h5>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>#<?php echo e($order->order_id); ?></td>
                            <td><?php echo e($order->customer->name); ?></td>
                            <td>SAR <?php echo e(number_format($order->total_amount, 2)); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'primary')); ?>">
                                    <?php echo e(ucfirst($order->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($order->order_date->format('M d, Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No orders found</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmahub\resources\views/vendor/dashboard.blade.php ENDPATH**/ ?>