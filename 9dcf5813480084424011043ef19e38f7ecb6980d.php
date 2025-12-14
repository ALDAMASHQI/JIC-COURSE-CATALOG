<?php $__env->startSection('title', 'Manage Orders - Pharmahub'); ?>
<?php $__env->startSection('page-title', 'Order Management'); ?>

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

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-success"><i class="fa fa-shopping-cart"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-3"><?php echo e($orders->count()); ?></h5>
                        <small>Total Orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-warning"><i class="fas fa-clock"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-3"><?php echo e($orders->where('status', 'pending')->count()); ?></h5>
                        <small>Pending Orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-success"><i class="fas fa-truck"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-3"><?php echo e($orders->where('status', 'delivered')->count()); ?></h5>
                        <small>Delivered Orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="stat-icon icon-info"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <h5 class="mb-0 text-center mt-3">SAR <?php echo e(number_format($orders->sum('vendor_total'), 2)); ?></h5>
                        <small>Total Revenue</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Orders List</h5>
                <div class="d-flex gap-2">
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search orders...">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="ordersTable">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-status="<?php echo e($order->status); ?>">
                                <td>
                                    <strong>#<?php echo e($order->order_id); ?></strong>
                                </td>
                                <td>
                                    <div>
                                        <strong><?php echo e($order->customer->name); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo e($order->customer->email); ?></small>
                                    </div>
                                </td>
                                <td>
                                    <?php echo e($order->order_date->format('M d, Y')); ?><br>
                                    <small class="text-muted"><?php echo e($order->order_date->format('h:i A')); ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-primary"><?php echo e($order->vendor_items); ?> items</span>
                                </td>
                                <td>
                                    <strong class="text-success">SAR <?php echo e(number_format($order->vendor_total, 2)); ?></strong>
                                </td>
                                <td>
                                    <?php if($order->payment): ?>
                                        <span class="badge bg-<?php echo e($order->payment->payment_status == 'completed' ? 'success' : 'warning'); ?>">
                                        <?php echo e(ucfirst($order->payment->payment_method)); ?> - <?php echo e(ucfirst($order->payment->payment_status)); ?>

                                    </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No Payment</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="<?php echo e(route('vendor.orders.update-status', $order->order_id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <select name="status" class="form-select form-select-sm status-select"
                                                onchange="this.form.submit()"
                                                data-order-id="<?php echo e($order->order_id); ?>">
                                            <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="confirmed" <?php echo e($order->status == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                            <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                                            <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                                            <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-info invoice-btn"
                                                data-order-id="<?php echo e($order->order_id); ?>"
                                                title="Generate Invoice">
                                            Generate Invoice  <i class="fas fa-receipt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php if($orders->isEmpty()): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h5>No Orders Found</h5>
                        <p class="text-muted">You haven't received any orders yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details - #<span id="modalOrderId"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetailsContent">
                        <!-- Content will be loaded via AJAX -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary invoice-btn" id="modalInvoiceBtn">
                        <i class="fas fa-receipt me-2"></i>Generate Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invoice - #<span id="invoiceOrderId"></span></h5>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="printInvoice()">
                            <i class="fas fa-print me-1"></i>Print
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="invoiceContent" class="invoice-container">
                        <!-- Invoice content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const ordersTable = document.getElementById('ordersTable');

            if (statusFilter && searchInput) {
                statusFilter.addEventListener('change', filterOrders);
                searchInput.addEventListener('input', filterOrders);
            }

            function filterOrders() {
                const status = statusFilter.value.toLowerCase();
                const searchTerm = searchInput.value.toLowerCase();
                const rows = ordersTable.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status');
                    const rowText = row.textContent.toLowerCase();

                    const statusMatch = !status || rowStatus === status;
                    const searchMatch = !searchTerm || rowText.includes(searchTerm);

                    row.style.display = statusMatch && searchMatch ? '' : 'none';
                });
            }

            // View order details
            const viewButtons = document.querySelectorAll('.view-order');
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    loadOrderDetails(orderId);
                });
            });

            // Invoice buttons
            const invoiceButtons = document.querySelectorAll('.invoice-btn');
            invoiceButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    generateInvoice(orderId);
                });
            });

            // Modal invoice button
            document.getElementById('modalInvoiceBtn').addEventListener('click', function() {
                const orderId = document.getElementById('modalOrderId').textContent;
                generateInvoice(orderId);
                bootstrap.Modal.getInstance(document.getElementById('orderDetailsModal')).hide();
            });
        });

        function loadOrderDetails(orderId) {
            fetch(`/vendor/orders/${orderId}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalOrderId').textContent = orderId;
                    document.getElementById('modalInvoiceBtn').setAttribute('data-order-id', orderId);

                    const content = document.getElementById('orderDetailsContent');
                    content.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Customer Information</h6>
                            <p><strong>Name:</strong> ${data.order.customer.name}<br>
                            <strong>Email:</strong> ${data.order.customer.email}<br>
                            <strong>Phone:</strong> ${data.order.customer.phone || 'N/A'}<br>
                            <strong>Address:</strong> ${data.order.customer.address || 'N/A'}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Order Information</h6>
                            <p><strong>Order Date:</strong> ${new Date(data.order.order_date).toLocaleDateString()}<br>
                            <strong>Status:</strong> <span class="badge bg-${getStatusColor(data.order.status)}">${data.order.status}</span><br>
                            <strong>Payment:</strong> ${data.order.payment ? `${data.order.payment.payment_method} - ${data.order.payment.payment_status}` : 'N/A'}</p>
                        </div>
                    </div>

                    <h6 class="mt-4">Order Items</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.vendorItems.map(item => `
                                    <tr>
                                        <td>${item.product.name}</td>
                                        <td>SAR ${parseFloat(item.price).toFixed(2)}</td>
                                        <td>${item.quantity}</td>
                                        <td>SAR ${(item.quantity * item.price).toFixed(2)}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>SAR ${data.vendorTotal.toFixed(2)}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                `;

                    new bootstrap.Modal(document.getElementById('orderDetailsModal')).show();
                })
                .catch(error => {
                    console.error('Error loading order details:', error);
                    alert('Error loading order details. Please try again.');
                });
        }

        function generateInvoice(orderId) {
            fetch(`/vendor/orders/${orderId}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('invoiceOrderId').textContent = orderId;

                    const invoiceContent = document.getElementById('invoiceContent');
                    invoiceContent.innerHTML = `
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?php echo e(asset('logo.png')); ?>" alt="Pharmahub" class="invoice-logo">
                                <h4>Pharmahub Pharmacy</h4>
                                <p>Medical Supplies & Pharmaceuticals<br>
                                Email: info@pharmahub.com<br>
                                Phone: +966 123 456 789</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h3>INVOICE</h3>
                                <p><strong>Invoice #:</strong> ${orderId}<br>
                                <strong>Date:</strong> ${new Date().toLocaleDateString()}<br>
                                <strong>Status:</strong> <span class="badge bg-${getStatusColor(data.order.status)}">${data.order.status}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Bill To:</h5>
                            <p><strong>${data.order.customer.name}</strong><br>
                            ${data.order.customer.email}<br>
                            ${data.order.customer.phone || 'N/A'}<br>
                            ${data.order.customer.address || 'N/A'}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <h5>Pharmacy:</h5>
                            <p><strong>${data.vendorItems[0]?.product?.vendor?.pharmacy_name || 'Your Pharmacy'}</strong><br>
                            ${data.vendorItems[0]?.product?.vendor?.location || 'Location not specified'}</p>
                        </div>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.vendorItems.map(item => `
                                    <tr>
                                        <td>${item.product.name}</td>
                                        <td>${item.product.description || 'No description'}</td>
                                        <td>SAR ${parseFloat(item.price).toFixed(2)}</td>
                                        <td>${item.quantity}</td>
                                        <td>SAR ${(item.quantity * item.price).toFixed(2)}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>

                    <div class="invoice-totals">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Payment Method:</strong> ${data.order.payment ? data.order.payment.payment_method : 'N/A'}<br>
                                <strong>Payment Status:</strong> <span class="badge bg-${data.order.payment?.payment_status === 'completed' ? 'success' : 'warning'}">${data.order.payment?.payment_status || 'Pending'}</span></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h4>Total: SAR ${data.vendorTotal.toFixed(2)}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center text-muted">
                        <p>Thank you for your business!<br>
                        For questions about this invoice, please contact our support team.</p>
                    </div>
                `;

                    new bootstrap.Modal(document.getElementById('invoiceModal')).show();
                })
                .catch(error => {
                    console.error('Error generating invoice:', error);
                    alert('Error generating invoice. Please try again.');
                });
        }

        function getStatusColor(status) {
            const colors = {
                'pending': 'warning',
                'confirmed': 'info',
                'shipped': 'primary',
                'delivered': 'success',
                'cancelled': 'danger'
            };
            return colors[status] || 'secondary';
        }

        function printInvoice() {
            window.print();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pharmaHub\resources\views/vendor/orders/index.blade.php ENDPATH**/ ?>