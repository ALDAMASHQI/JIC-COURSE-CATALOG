<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <h2>Your Cart</h2>

        <?php if(!$cart || $cart->orderItems->isEmpty()): ?>
            <div class="alert alert-info">Your cart is empty.</div>
        <?php else: ?>
            <table class="table table-bordered align-middle">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th width="120">Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $cart->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>  <img style="height: 60px;width: 60px" src="<?php echo e($item->product->image_url); ?>"/></td>
                        <td><?php echo e($item->product->name); ?></td>
                        <td>SAR <?php echo e(number_format($item->price, 2)); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.update')); ?>" method="POST" class="d-flex">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="item_id" value="<?php echo e($item->order_item_id); ?>">
                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1"
                                       class="form-control form-control-sm me-2" style="width:80px;">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>SAR <?php echo e(number_format($item->quantity * $item->price, 2)); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.delete')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="item_id" value="<?php echo e($item->order_item_id); ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center">
                <h4>Total: SAR <?php echo e(number_format($cart->total_amount, 2)); ?></h4>

                <div>
                    <form action="<?php echo e(route('cart.empty')); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline-danger">Empty Cart</button>
                    </form>
                    <a href="<?php echo e(route('cart.checkout')); ?>" class="btn btn-success">Proceed to Checkout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/cart/index.blade.php ENDPATH**/ ?>