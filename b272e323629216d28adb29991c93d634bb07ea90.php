<?php $__env->startSection('title', 'Customer Reviews - Pharmahub'); ?>
<?php $__env->startSection('page-title', 'Customer Reviews'); ?>

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

        <!-- Reviews List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-star me-2"></i>Customer Reviews</h5>
            </div>
            <div class="card-body">
                <?php if($reviews->isEmpty()): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h5>No Reviews Yet</h5>
                        <p class="text-muted">Your products haven't received any reviews yet.</p>
                    </div>
                <?php else: ?>
                    <div class="reviews-list">
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="review-item card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Review Header -->
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="user-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                    <?php echo e(substr($review->user->name, 0, 1)); ?>

                                                </div>
                                                <div>
                                                    <h6 class="mb-1"><?php echo e($review->user->name); ?></h6>
                                                    <small class="text-muted"><?php echo e($review->created_at->format('M d, Y • h:i A')); ?></small>
                                                </div>
                                            </div>

                                            <!-- Rating -->
                                            <div class="rating-stars mb-2">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?php echo e($i <= $review->rating ? ' text-warning' : ' text-muted'); ?>"></i>
                                                <?php endfor; ?>
                                                <span class="ms-2 badge bg-<?php echo e($review->rating >= 4 ? 'success' : ($review->rating >= 3 ? 'warning' : 'danger')); ?>">
                                            <?php echo e($review->rating); ?>/5
                                        </span>
                                            </div>

                                            <!-- Review Comment -->
                                            <p class="review-comment mb-3"><?php echo e($review->comment); ?></p>

                                            <!-- Product Info -->
                                            <div class="product-info">
                                                <small class="text-muted">Review for:</small>
                                                <div class="d-flex align-items-center mt-1">
                                                    <?php if($review->product->image_url): ?>
                                                        <img src="<?php echo e($review->product->image_url); ?>"
                                                             alt="<?php echo e($review->product->name); ?>"
                                                             class="product-thumb me-2"
                                                             style="width: 30px; height: 30px; object-fit: cover; border-radius: 4px;">
                                                    <?php endif; ?>
                                                    <strong><?php echo e($review->product->name); ?></strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <!-- Review Actions -->

                                            <div class="review-meta">
                                                <div class="text-end">
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-cube me-1"></i>
                                                        <?php echo e($review->product->category->name); ?>

                                                    </small>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-tag me-1"></i>
                                                        <?php echo e($review->product->dosage_form); ?>

                                                    </small>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-store me-1"></i>
                                                        SAR <?php echo e(number_format($review->product->price, 2)); ?>

                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>

        function timeSince(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            let interval = seconds / 31536000;

            if (interval > 1) {
                return Math.floor(interval) + " years ago";
            }
            interval = seconds / 2592000;
            if (interval > 1) {
                return Math.floor(interval) + " months ago";
            }
            interval = seconds / 86400;
            if (interval > 1) {
                return Math.floor(interval) + " days ago";
            }
            interval = seconds / 3600;
            if (interval > 1) {
                return Math.floor(interval) + " hours ago";
            }
            interval = seconds / 60;
            if (interval > 1) {
                return Math.floor(interval) + " minutes ago";
            }
            return Math.floor(seconds) + " seconds ago";
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmahub\resources\views/vendor/reviews.blade.php ENDPATH**/ ?>