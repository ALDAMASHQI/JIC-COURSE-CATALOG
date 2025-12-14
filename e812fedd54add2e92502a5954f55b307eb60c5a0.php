


<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="position-relative text-white text-center d-flex align-items-center"
             style="background: linear-gradient(120deg, rgba(25,135,84,.85), rgba(13,110,253,.75)), url('<?php echo e(asset('images/hero-dashboard.jpg')); ?>') center/cover no-repeat; min-height: 42vh;">
        <div class="container position-relative py-5">
            <h1 class="display-6 fw-bold mb-2">مرحباً، <?php echo e($user->full_name); ?></h1>
            <p class="lead text-white-50 mb-0">نظرة عامة على صحتك وخططك الحالية — لنبدأ بقوة اليوم 💪</p>
            <div class="d-flex gap-2 justify-content-center mt-3">
                <a href="<?php echo e(route('user.profile')); ?>" class="btn btn-light btn-sm px-3">تحديث البيانات</a>
                <a href="<?php echo e(route('plans.workouts.index')); ?>" target="_blank" class="btn btn-outline-light btn-sm px-3">استعراض خطط التمارين</a>
                <a href="<?php echo e(route('plans.nutritions.index')); ?>" target="_blank" class="btn btn-outline-light btn-sm px-3">استعراض الخطط الغذائية</a>
            </div>
        </div>
    </section>

    <?php
        // Labels & helpers
        $difficultyLabels = ['easy'=>'سهل','medium'=>'متوسط','hard'=>'صعب'];
        $dietLabels = ['balanced'=>'متوازن','high-protein'=>'بروتين مرتفع','keto'=>'كيتو','kids'=>'أطفال'];
        $goalLabels = ['slimming'=>'تخسيس','bulking'=>'زيادة كتلة','healthy'=>'صحة عامة','kids'=>'أطفال'];

        $badgeForDiff = fn($d) => match($d){ 'easy'=>'bg-success','medium'=>'bg-warning text-dark','hard'=>'bg-danger', default=>'bg-secondary' };
        $badgeForDiet = fn($d) => match($d){ 'balanced'=>'bg-success','high-protein'=>'bg-primary','keto'=>'bg-warning text-dark','kids'=>'bg-info text-dark', default=>'bg-secondary' };

        $fmt = function($n, $dec=0, $suffix=''){ return is_null($n) ? '—' : rtrim(rtrim(number_format($n, $dec), '0'), '.') . ($suffix ? " $suffix" : ''); };

        $bmi = $user->bmi;
        $bmiLabel = '—';
        $bmiClass = 'bg-secondary';
        if(!is_null($bmi)){
            if($bmi < 18.5){ $bmiLabel='نحافة'; $bmiClass='bg-info text-dark'; }
            elseif($bmi < 25){ $bmiLabel='مثالي'; $bmiClass='bg-success'; }
            elseif($bmi < 30){ $bmiLabel='زيادة وزن'; $bmiClass='bg-warning text-dark'; }
            else { $bmiLabel='سمنة'; $bmiClass='bg-danger'; }
        }

        // Macros progress (safe)
        $activeCalories = $activeNutrition?->calories;
        $caloriesFromProtein = $activeNutrition && !is_null($activeNutrition->protein) ? ($activeNutrition->protein * 4) : null;
        $caloriesFromCarbs   = $activeNutrition && !is_null($activeNutrition->carbs)   ? ($activeNutrition->carbs   * 4) : null;
        $caloriesFromFats    = $activeNutrition && !is_null($activeNutrition->fats)    ? ($activeNutrition->fats    * 9) : null;

        $pct = function($cals, $total){
            if(is_null($cals) || is_null($total) || $total <= 0) return null;
            return round(($cals / $total) * 100);
        };

        $pPct = $pct($caloriesFromProtein, $activeCalories);
        $cPct = $pct($caloriesFromCarbs,   $activeCalories);
        $fPct = $pct($caloriesFromFats,    $activeCalories);
    ?>

    <section class="container py-5">

        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="h6 fw-bold mb-0">مؤشر الكتلة (BMI)</h3>
                            <span class="badge <?php echo e($bmiClass); ?>"><?php echo e($bmiLabel); ?></span>
                        </div>
                        <div class="display-6 fw-bold"><?php echo e($bmi ?? '—'); ?></div>
                        <p class="text-muted small mb-0">الطول: <?php echo e($fmt($user->height_cm,0,'سم')); ?> · الوزن: <?php echo e($fmt($user->weight_kg,2,'كجم')); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h6 fw-bold mb-2">الهدف الحالي</h3>
                        <div class="d-flex align-items-baseline gap-2">
                            <span class="badge bg-light text-dark"><?php echo e($goalLabels[$user->goal] ?? 'غير محدد'); ?></span>
                        </div>
                        <p class="text-muted small mb-0">يمكنك تغيير الهدف من <a href="<?php echo e(route('user.profile')); ?>">الملف الشخصي</a>.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h6 fw-bold mb-2">تمارين</h3>
                        <?php if($activeWorkout): ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">الخطة النشطة</span>
                                <span class="badge <?php echo e($badgeForDiff($activeWorkout->difficulty)); ?>">
                                    <?php echo e($difficultyLabels[$activeWorkout->difficulty] ?? 'غير محدد'); ?>

                                </span>
                            </div>
                            <div class="fw-semibold mt-1"><?php echo e(\Illuminate\Support\Str::limit($activeWorkout->title, 32)); ?></div>
                            <a href="<?php echo e(route('plans.workouts.show', $activeWorkout->id)); ?>" target="_blank" class="btn btn-outline-success btn-sm mt-3 w-100">فتح الخطة</a>
                        <?php else: ?>
                            <div class="text-muted small">لا توجد خطة نشطة</div>
                            <a href="<?php echo e(route('plans.workouts.index')); ?>" target="_blank" class="btn btn-success btn-sm mt-3 w-100">اختيار خطة</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h6 fw-bold mb-2">التغذية</h3>
                        <?php if($activeNutrition): ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">الخطة النشطة</span>
                                <span class="badge <?php echo e($badgeForDiet($activeNutrition->diet_type)); ?>">
                                    <?php echo e($dietLabels[$activeNutrition->diet_type] ?? 'غير محدد'); ?>

                                </span>
                            </div>
                            <div class="fw-semibold mt-1"><?php echo e(\Illuminate\Support\Str::limit($activeNutrition->name, 32)); ?></div>
                            <div class="small text-muted mt-1">السعرات: <?php echo e($fmt($activeNutrition->calories,0,'سعرة')); ?></div>
                            <a href="<?php echo e(route('plans.nutritions.show', $activeNutrition->id)); ?>" class="btn btn-outline-success btn-sm mt-3 w-100">فتح الخطة</a>
                        <?php else: ?>
                            <div class="text-muted small">لا توجد خطة نشطة</div>
                            <a href="<?php echo e(route('plans.nutritions.index')); ?>" target="_blank" class="btn btn-success btn-sm mt-3 w-100">اختيار خطة</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row g-4 mt-1">

            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="h6 fw-bold mb-0"><i class="fas fa-dumbbell ms-1 text-success"></i> خطة التمارين الحالية</h3>
                            <a href="<?php echo e(route('user.my.workout')); ?>" class="btn btn-sm btn-outline-secondary">إدارة الخطة</a>
                        </div>

                        <?php if($activeWorkout): ?>
                            <?php
                                $badgeClass = $badgeForDiff($activeWorkout->difficulty);
                                $duration = $activeWorkout->duration_minutes ? $activeWorkout->duration_minutes.' دقيقة' : 'غير محدد';
                                $sessions = [];
                                if (!empty($activeWorkout->sessions_json)) {
                                    $decoded = is_string($activeWorkout->sessions_json) ? json_decode($activeWorkout->sessions_json, true) : $activeWorkout->sessions_json;
                                    if (is_array($decoded)) $sessions = $decoded;
                                }
                            ?>

                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold"><?php echo e($activeWorkout->title); ?></div>
                                    <div class="small text-muted">
                                        المدة: <?php echo e($duration); ?> · بدأت: <?php echo e(optional($activeWorkout->pivot->start_date)->format('Y-m-d') ?? '—'); ?>

                                    </div>
                                </div>
                                <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($difficultyLabels[$activeWorkout->difficulty] ?? 'غير محدد'); ?></span>
                            </div>

                            <?php if(count($sessions)): ?>
                                <hr>
                                <h4 class="h6 fw-bold mb-2">محتوى الجلسات</h4>
                                <ul class="list-unstyled small text-secondary mb-0">
                                    <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="mb-2">
                                            <i class="<?php echo e($item['icon'] ?? 'fas fa-dumbbell'); ?> ms-1 text-success"></i>
                                            <?php echo e($item['text'] ?? ''); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted small mt-3 mb-0">لا توجد تفاصيل جلسات محفوظة لهذه الخطة.</p>
                            <?php endif; ?>

                            <div class="mt-auto pt-3">
                                <a href="<?php echo e(route('plans.workouts.show', $activeWorkout->id)); ?>" target="_blank" class="btn btn-outline-success w-100">فتح صفحة الخطة العامة</a>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <img src="<?php echo e(asset('images/empty-state.svg')); ?>" class="mb-3" style="max-width:160px" alt="">
                                <h4 class="h6 fw-bold mb-1">لا توجد خطة تمارين نشطة</h4>
                                <p class="text-muted small mb-3">اختر خطة مناسبة وابدأ اليوم.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="<?php echo e(route('plans.workouts.index')); ?>" target="_blank" class="btn btn-success">استعراض الخطط</a>
                                    <a href="<?php echo e(route('user.my.workout')); ?>" class="btn btn-outline-secondary">اختيار من قائمتي</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="h6 fw-bold mb-0"><i class="fas fa-utensils ms-1 text-success"></i> الخطة الغذائية الحالية</h3>
                            <a href="<?php echo e(route('user.my.nutrition')); ?>" class="btn btn-sm btn-outline-secondary">إدارة الخطة</a>
                        </div>

                        <?php if($activeNutrition): ?>
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold"><?php echo e($activeNutrition->name); ?></div>
                                    <div class="small text-muted">
                                        السعرات: <?php echo e($fmt($activeNutrition->calories,0,'سعرة')); ?> · بدأت: <?php echo e(optional($activeNutrition->pivot->start_date)->format('Y-m-d') ?? '—'); ?>

                                    </div>
                                </div>
                                <span class="badge <?php echo e($badgeForDiet($activeNutrition->diet_type)); ?>"><?php echo e($dietLabels[$activeNutrition->diet_type] ?? 'غير محدد'); ?></span>
                            </div>

                            <hr>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="small text-muted mb-1">توزيع الماكروز (حسب السعرات)</div>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($pPct ?? 0); ?>%" title="بروتين <?php echo e($pPct ?? 0); ?>%"></div>
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($cPct ?? 0); ?>%" title="كربوهيدرات <?php echo e($cPct ?? 0); ?>%"></div>
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($fPct ?? 0); ?>%" title="دهون <?php echo e($fPct ?? 0); ?>%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between small text-muted mt-1">
                                        <span>بروتين: <?php echo e($fmt($activeNutrition->protein,2,'جم')); ?></span>
                                        <span>كربوهيدرات: <?php echo e($fmt($activeNutrition->carbs,2,'جم')); ?></span>
                                        <span>دهون: <?php echo e($fmt($activeNutrition->fats,2,'جم')); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto pt-3">
                                <a href="<?php echo e(route('plans.nutritions.show', $activeNutrition->id)); ?>" class="btn btn-outline-success w-100">فتح صفحة الخطة العامة</a>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <img src="<?php echo e(asset('images/empty-state.svg')); ?>" class="mb-3" style="max-width:160px" alt="">
                                <h4 class="h6 fw-bold mb-1">لا توجد خطة غذائية نشطة</h4>
                                <p class="text-muted small mb-3">اختر خطة تناسب هدفك وسعراتك.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="<?php echo e(route('plans.nutritions.index')); ?>" target="_blank" class="btn btn-success">استعراض الخطط</a>
                                    <a href="<?php echo e(route('user.my.nutrition')); ?>" class="btn btn-outline-secondary">اختيار من قائمتي</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <h3 class="h6 fw-bold mb-3"><i class="fas fa-bolt ms-1 text-warning"></i> إجراءات سريعة</h3>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?php echo e(route('user.my.workout')); ?>" class="btn btn-outline-secondary">إدارة خطة التمارين</a>
                    <a href="<?php echo e(route('user.my.nutrition')); ?>" class="btn btn-outline-secondary">إدارة الخطة الغذائية</a>
                    <a href="<?php echo e(route('plans.workouts.index')); ?>" target="_blank" class="btn btn-outline-secondary">اختيار خطة تمارين</a>
                    <a href="<?php echo e(route('plans.nutritions.index')); ?>" target="_blank" class="btn btn-outline-secondary">اختيار خطة غذائية</a>
                    <a href="<?php echo e(route('user.profile')); ?>" class="btn btn-outline-secondary">تحديث البيانات الصحية</a>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\fit_now\resources\views/user/dashboard.blade.php ENDPATH**/ ?>