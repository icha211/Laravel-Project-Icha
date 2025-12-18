<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Dashboard - Employee <?php $__env->endSlot(); ?>

    <?php if($employee): ?>
        <div class="row">
            <!-- Employee Info Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #1e40af); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5><?php echo e($employee->user->name); ?></h5>
                        <p class="text-muted mb-3"><?php echo e($employee->position); ?></p>
                        <div class="mb-3">
                            <small class="d-block text-muted">Department</small>
                            <strong><?php echo e($employee->department); ?></strong>
                        </div>
                        <div class="mb-3">
                            <small class="d-block text-muted">Employee ID</small>
                            <strong><?php echo e($employee->employee_id); ?></strong>
                        </div>
                        <hr>
                        <a href="<?php echo e(route('employees.edit', $employee)); ?>" class="btn btn-sm btn-primary w-100">Edit Profile</a>
                    </div>
                </div>
            </div>

            <!-- Performance Stats -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value"><?php echo e(number_format($employee->average_rating, 2)); ?></div>
                            <div class="stat-label">Overall Rating</div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-star" style="color: #fbbf24;"></i>
                                <?php echo e($employee->total_reviews); ?> performance reviews
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value"><?php echo e($goals->count()); ?></div>
                            <div class="stat-label">Active Goals</div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-target"></i>
                                Working towards objectives
                            </small>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value"><?php echo e($trainings->count()); ?></div>
                            <div class="stat-label">Training Programs</div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-graduation-cap"></i>
                                Skill development
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value"><?php echo e($performanceReviews->count()); ?></div>
                            <div class="stat-label">Completed Reviews</div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-check-circle"></i>
                                Feedback received
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Criteria Analysis -->
        <?php if($performanceReviews->count() > 0): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Performance Analysis</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Average performance across all 5 key criteria based on <?php echo e($allReviews->count()); ?> total reviews</p>
                            <div class="row">
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #10b981; margin-bottom: 0.5rem;">
                                        <?php echo e(number_format($performanceAverages->avg_communication ?? 0, 1)); ?>/5
                                    </div>
                                    <p class="mb-2"><strong>Communication</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: <?php echo e((($performanceAverages->avg_communication ?? 0) / 5) * 100); ?>%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #3b82f6; margin-bottom: 0.5rem;">
                                        <?php echo e(number_format($performanceAverages->avg_teamwork ?? 0, 1)); ?>/5
                                    </div>
                                    <p class="mb-2"><strong>Teamwork</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-info" style="width: <?php echo e((($performanceAverages->avg_teamwork ?? 0) / 5) * 100); ?>%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #f59e0b; margin-bottom: 0.5rem;">
                                        <?php echo e(number_format($performanceAverages->avg_productivity ?? 0, 1)); ?>/5
                                    </div>
                                    <p class="mb-2"><strong>Productivity</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: <?php echo e((($performanceAverages->avg_productivity ?? 0) / 5) * 100); ?>%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #ef4444; margin-bottom: 0.5rem;">
                                        <?php echo e(number_format($performanceAverages->avg_reliability ?? 0, 1)); ?>/5
                                    </div>
                                    <p class="mb-2"><strong>Reliability</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-danger" style="width: <?php echo e((($performanceAverages->avg_reliability ?? 0) / 5) * 100); ?>%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #8b5cf6; margin-bottom: 0.5rem;">
                                        <?php echo e(number_format($performanceAverages->avg_leadership ?? 0, 1)); ?>/5
                                    </div>
                                    <p class="mb-2"><strong>Leadership</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-purple" style="width: <?php echo e((($performanceAverages->avg_leadership ?? 0) / 5) * 100); ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mt-4">
            <!-- Recent Reviews -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Performance Reviews</h5>
                        <?php if($performanceReviews->count() > 0): ?>
                            <a href="<?php echo e(route('employees.show', $employee)); ?>" class="btn btn-sm btn-outline-primary">View All</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <?php $__empty_1 = true; $__currentLoopData = $performanceReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><?php echo e($review->review_period); ?></h6>
                                        <small class="text-muted d-block">By: <?php echo e($review->reviewer->name); ?></small>
                                    </div>
                                    <div class="rating text-end">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $review->rating): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <br><small><?php echo e(number_format($review->rating, 1)); ?>/5</small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted mb-0">No reviews yet</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Goals Progress -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Goals Progress</h5>
                        <a href="<?php echo e(route('goals.create', $employee)); ?>" class="btn btn-sm btn-primary">Add Goal</a>
                    </div>
                    <div class="card-body">
                        <?php $__empty_1 = true; $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-1"><?php echo e($goal->title); ?></h6>
                                    <span class="badge bg-<?php echo e($goal->status === 'completed' ? 'success' : ($goal->status === 'delayed' ? 'danger' : 'info')); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $goal->status))); ?>

                                    </span>
                                </div>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar" style="width: <?php echo e($goal->progress); ?>%"></div>
                                </div>
                                <small class="text-muted"><?php echo e($goal->progress); ?>% Progress</small>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted mb-0">No goals set yet</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Programs -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Training Programs</h5>
                        <a href="<?php echo e(route('training.create', $employee)); ?>" class="btn btn-sm btn-primary">Add Training</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><strong><?php echo e($training->title); ?></strong></td>
                                        <td><?php echo e($training->start_date->format('M d, Y')); ?></td>
                                        <td><?php echo e($training->end_date ? $training->end_date->format('M d, Y') : 'N/A'); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($training->status === 'completed' ? 'success' : ($training->status === 'in_progress' ? 'info' : 'secondary')); ?>">
                                                <?php echo e(ucfirst(str_replace('_', ' ', $training->status))); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('training.edit', ['employee' => $employee->id, 'training' => $training->id])); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">No training programs yet</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Your employee profile is not yet set up. Please contact your employer.
        </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH C:\Users\User\Laravel-Project-Icha\resources\views/dashboard/employee.blade.php ENDPATH**/ ?>