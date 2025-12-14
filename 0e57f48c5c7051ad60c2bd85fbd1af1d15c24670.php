<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h2 class="mb-4">Order #<?php echo e($order->order_id); ?></h2>

        
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Date:</strong> <?php echo e($order->order_date->format('d M Y, h:i A')); ?></p>
                <p><strong>Status:</strong>
                    <span class="badge
                    <?php if($order->status == 'Pending'): ?> bg-warning
                    <?php elseif($order->status == 'Completed'): ?> bg-success
                    <?php else: ?> bg-secondary <?php endif; ?>">
                    <?php echo e($order->status); ?>

                </span>
                </p>
                <p><strong>Total Amount:</strong> $<?php echo e(number_format($order->total_amount, 2)); ?></p>
                <p><strong>Payment Method:</strong>
                    <?php if($order->payment): ?>
                        <?php echo e(ucfirst($order->payment->payment_method)); ?>

                        (<?php echo e(ucfirst($order->payment->payment_status)); ?>)
                    <?php else: ?>
                        <span class="text-muted">Unpaid</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header bg-dark text-white">Order Items</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered m-0">
                        <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->product->name); ?></td>
                                <td>SAR <?php echo e(number_format($item->price, 2)); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td>SAR <?php echo e(number_format($item->quantity * $item->price, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>SAR <?php echo e(number_format($order->total_amount, 2)); ?></strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="mt-4">
            <a href="<?php echo e(route('customer.orders')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                <i class="fas fa-file-invoice"></i> Print Invoice
            </button>
        </div>
    </div>


    <!-- Print Invoice Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice #<?php echo e($order->order_id); ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="invoiceContent">
                    <h4 class="mb-3">PharmaHub</h4>
                    <p><strong>Customer:</strong> <?php echo e($order->customer->name); ?></p>
                    <p><strong>Date:</strong> <?php echo e($order->order_date->format('d M Y, h:i A')); ?></p>
                    <p><strong>Status:</strong> <?php echo e($order->status); ?></p>

                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->product->name); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                                <td>$<?php echo e(number_format($item->quantity * $item->price, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td><strong>$<?php echo e(number_format($order->total_amount, 2)); ?></strong></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="printInvoiceBtn">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        document.getElementById('printInvoiceBtn').addEventListener('click', function () {
            var printContent = document.getElementById('invoiceContent').innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // reload to restore modal and layout
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/customer/order_details.blade.php ENDPATH**/ ?>