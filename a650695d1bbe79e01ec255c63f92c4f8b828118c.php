<script src="<?php echo e(asset('admin/libs/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/sidebarmenu.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/app.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/libs/simplebar/dist/simplebar.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/dashboard.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            "language": {
                "url": "<?php echo e(asset('ar.json')); ?>"
            },
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": false,
        });
    });
    function confirmDelete(formId) {
        if (confirm("هل أنت متأكد أنك تريد الحذف  ؟")) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?php /**PATH C:\laragon\www\fit_now\resources\views/user/layouts/foot.blade.php ENDPATH**/ ?>