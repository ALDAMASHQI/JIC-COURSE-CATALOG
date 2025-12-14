<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row g-4">
            <!-- Left Section - Order Summary -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-receipt me-2"></i>
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $cart->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img style="height: 60px;width: 60px" src="<?php echo e($item->product->image_url); ?>"/>
                                    <strong><?php echo e($item->product->name); ?></strong>
                                    <small class="text-muted"> (x<?php echo e($item->quantity); ?>)</small>
                                </div>
                                <span class="fw-bold">SAR <?php echo e(number_format($item->quantity * $item->price, 2)); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <strong>Total</strong>
                            <strong class="text-success fs-5">SAR <?php echo e(number_format($cart->total_amount, 2)); ?></strong>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Section - Payment -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-credit-card me-2"></i>
                        <h5 class="mb-0">Payment Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('cart.processCheckout')); ?>" method="POST" class="needs-validation" novalidate>
                            <?php echo csrf_field(); ?>

                            <!-- Payment Method -->
                            <div class="mb-3">
                                <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="Card">💳 Credit/Debit Card</option>
                                    <option value="Cash">💵 Cash on Delivery</option>
                                </select>
                            </div>

                            <!-- Card Fields -->
                            <div id="cardFields">
                                <div class="mb-3">
                                    <label for="card_number" class="form-label fw-semibold">Card Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                        <input type="text" class="form-control" name="card_number" maxlength="16" placeholder="1234 5678 9012 3456">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expiry_date" class="form-label fw-semibold">Expiry Date</label>
                                        <input type="month" class="form-control" name="expiry_date">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvc" class="form-label fw-semibold">CVC</label>
                                        <input type="text" class="form-control" name="cvc" maxlength="4" placeholder="123">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary w-100 mt-3 py-2 fw-bold">
                                <i class="fas fa-check-circle me-2"></i> Complete Checkout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Security Info -->
                <div class="alert alert-light border mt-3 d-flex align-items-center">
                    <i class="fas fa-lock text-success me-2"></i>
                    <small class="text-muted">Your payment is secured with SSL encryption.</small>
                </div>
            </div>
        </div>
    </div>

    
    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const paymentMethod = document.getElementById('payment_method');
                const cardFields = document.getElementById('cardFields');

                function toggleCardFields() {
                    cardFields.style.display = (paymentMethod.value === 'Card') ? 'block' : 'none';
                }

                paymentMethod.addEventListener('change', toggleCardFields);
                toggleCardFields();
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/cart/checkout.blade.php ENDPATH**/ ?>