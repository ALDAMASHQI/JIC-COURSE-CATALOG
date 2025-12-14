 
<?php $__env->startSection('title', 'My Orders'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h2 class="mb-4">My Orders</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($orders->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->order_id); ?></td>
                            <td><?php echo e($order->order_date->format('d M Y')); ?></td>
                            <td>SAR <?php echo e(number_format($order->total_amount, 2)); ?></td>
                            <td>
                                <span class="badge
                                    <?php if($order->status == 'Pending'): ?> bg-warning
                                    <?php elseif($order->status == 'Completed'): ?> bg-success
                                    <?php else: ?> bg-secondary <?php endif; ?>">
                                    <?php echo e($order->status); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($order->payment): ?>
                                    <?php echo e(ucfirst($order->payment->payment_method)); ?>

                                    (<?php echo e(ucfirst($order->payment->payment_status)); ?>)
                                <?php else: ?>
                                    <span class="text-muted">Unpaid</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('customer.orderDetails', $order->order_id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-file-invoice"></i> Show Invoice
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">You have no orders yet.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/customer/orders.blade.php ENDPATH**/ ?>