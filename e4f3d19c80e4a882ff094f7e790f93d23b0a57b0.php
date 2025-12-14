

<?php $__env->startSection('title', 'لوحة تحكم الأدمن'); ?>

<?php $__env->startPush('css'); ?>
    <style>
        :root {
            --primary-color: #045b75;
            --secondary-color: #f1f5f9;
            --card-bg: #ffffff;
            --text-muted: #045b75;
        }

        body {
            background-color: var(--secondary-color);
        }

        .dashboard-header {
            background-color: var(--primary-color);
            background-image: linear-gradient(135deg, #4b5871 0%, #3a475a 100%);
        }

        .dashboard-card {
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .kpi-icon {
            font-size: 1.5rem;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="container py-4">
        <div class="row g-3 g-md-4">
            <div class="col-6 col-md-3">
                <div class="card dashboard-card h-100">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="kpi-icon bg-primary me-3"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="text-muted small">إجمالي المستخدمين</div>
                            <div class="h4 fw-bold mb-0"><?php echo e(number_format($usersTotal)); ?></div>
                            <div class="small text-success mt-1">
                                <i class="fas fa-user-check"></i> نشط: <?php echo e(number_format($usersActive)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-6 col-md-3">
                <div class="card dashboard-card h-100">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="kpi-icon bg-info me-3"><i class="fas fa-user-shield"></i></div>
                        <div>
                            <div class="text-muted small">المشرفون</div>
                            <div class="h4 fw-bold mb-0"><?php echo e(number_format($adminsCount)); ?></div>
                            <div class="small text-muted mt-1">عدد المشرفين الحالي</div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-6 col-md-3">
                <div class="card dashboard-card h-100">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="kpi-icon bg-warning me-3"><i class="fas fa-dumbbell"></i></div>
                        <div>
                            <div class="text-muted small">خطط التمارين</div>
                            <div class="h4 fw-bold mb-0"><?php echo e(number_format($workoutPlansCnt)); ?></div>
                            <div class="small text-warning mt-1">
                                <i class="fas fa-running"></i> نشطة: <?php echo e(number_format($workoutOngoing)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-6 col-md-3">
                <div class="card dashboard-card h-100">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="kpi-icon bg-success me-3"><i class="fas fa-utensils"></i></div>
                        <div>
                            <div class="text-muted small">الخطط الغذائية</div>
                            <div class="h4 fw-bold mb-0"><?php echo e(number_format($nutritionPlansCnt)); ?></div>
                            <div class="small text-success mt-1">
                                <i class="fas fa-apple-alt"></i> نشطة: <?php echo e(number_format($nutritionOngoing)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row g-3 g-md-4 mt-1">
            <div class="col-lg-8">
                <div class="card dashboard-card h-100">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h6 fw-bold mb-0">تسجيلات المستخدمين (آخر 14 يوم)</h3>
                        </div>
                        <div id="chart-signups" style="height: 320px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card dashboard-card h-100">
                    <div class="card-body p-3 p-md-4">
                        <h3 class="h6 fw-bold mb-3">توزيع الأهداف</h3>
                        <div id="chart-goals" style="height: 320px;"></div>
                    </div>
                </div>
            </div>
        </div>


    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const signupsLabels = <?php echo json_encode($signupsLabels, 15, 512) ?>;
        const signupsSeries = <?php echo json_encode($signupsSeries, 15, 512) ?>;
        const goalLabels = <?php echo json_encode($goalLabels, 15, 512) ?>;
        const goalSeries = <?php echo json_encode($goalSeries, 15, 512) ?>;
        const genderLabels = <?php echo json_encode($genderLabels, 15, 512) ?>;
        const genderSeries = <?php echo json_encode($genderSeries, 15, 512) ?>;
        const topWorkoutLabels = <?php echo json_encode($topWorkoutLabels, 15, 512) ?>;
        const topWorkoutSeries = <?php echo json_encode($topWorkoutSeries, 15, 512) ?>;
        const topNutritionLabels = <?php echo json_encode($topNutritionLabels, 15, 512) ?>;
        const topNutritionSeries = <?php echo json_encode($topNutritionSeries, 15, 512) ?>;

        // Define a custom color palette
        const customPalette = [
            '#045b75', '#1781a0', '#a0b2c3', '#c2d4dc', '#e4e6f0',
            '#4b5871', '#3a475a', '#045b75'
        ];

        // Signups (Area)
        new ApexCharts(document.querySelector("#chart-signups"), {
            chart: {
                type: 'area',
                height: 320,
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#045b75'],
            series: [{
                name: 'تسجيلات',
                data: signupsSeries
            }],
            xaxis: {
                categories: signupsLabels,
                labels: {
                    rotate: 0,
                    style: {
                        fontFamily: 'Almarai, sans-serif'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: v => Math.round(v),
                    style: {
                        fontFamily: 'Almarai, sans-serif'
                    }
                }
            },
            fill: {
                opacity: 0.2
            },
            grid: {
                strokeDashArray: 4
            },
            tooltip: {
                x: {
                    format: 'yyyy-MM-dd'
                }
            }
        }).render();

        // Goals (Donut)
        new ApexCharts(document.querySelector("#chart-goals"), {
            chart: {
                type: 'donut',
                height: 320
            },
            series: goalSeries.length ? goalSeries : [1],
            labels: goalLabels.length ? goalLabels : ['لا بيانات'],
            colors: customPalette,
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                dropShadow: {
                    enabled: false
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 280
                    }
                }
            }]
        }).render();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ubs\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>