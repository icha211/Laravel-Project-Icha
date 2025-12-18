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
     <?php $__env->slot('title', null, []); ?> Performance Reviews <?php $__env->endSlot(); ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Performance Reviews</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Review Period</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Reviewed By</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($review->employee->user->name); ?></strong><br>
                                <small class="text-muted"><?php echo e($review->employee->position); ?></small>
                            </td>
                            <td><?php echo e($review->review_period); ?></td>
                            <td>
                                <div class="rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $review->rating): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <br><small><?php echo e(number_format($review->rating, 1)); ?>/5</small>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($review->status === 'submitted' ? 'success' : ($review->status === 'draft' ? 'warning' : 'info')); ?>">
                                    <?php echo e(ucfirst($review->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($review->reviewer->name); ?></td>
                            <td><?php echo e($review->created_at->format('M d, Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('performance-reviews.show', $review)); ?>" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="<?php echo e(route('performance-reviews.edit', $review)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form method="POST" action="<?php echo e(route('performance-reviews.destroy', $review)); ?>" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No reviews yet</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?php echo e($reviews->links()); ?>

    </div>
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
<?php /**PATH C:\Users\User\Laravel-Project-Icha\resources\views/performance-reviews/index.blade.php ENDPATH**/ ?>