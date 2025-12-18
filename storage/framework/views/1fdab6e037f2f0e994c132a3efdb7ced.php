<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Employee Management System'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --light: #f8fafc;
        }
        
        body {
            background: var(--light);
            color: #1e293b;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: linear-gradient(135deg, var(--primary) 0%, #1e40af 100%);
            min-height: 100vh;
            padding: 2rem 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar .brand {
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }

        .sidebar .brand h3 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            display: block;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left-color: #fbbf24;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            color: var(--secondary);
            font-size: 0.875rem;
        }

        .badge-success { background: var(--success); }
        .badge-danger { background: var(--danger); }
        .badge-warning { background: var(--warning); }

        .rating {
            display: inline-block;
            color: #fbbf24;
            font-size: 0.875rem;
        }

        .bg-purple {
            background-color: #8b5cf6 !important;
        }

        .table-hover tbody tr:hover {
            background: #f1f5f9;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
                padding: 1rem 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="brand">
            <h3><i class="fas fa-chart-line"></i> PMS</h3>
            <small>Performance Management</small>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <div style="padding: 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <small style="display: block; opacity: 0.7;">Welcome</small>
                <strong style="font-size: 0.9rem;"><?php echo e(auth()->user()->name); ?></strong>
                <div style="font-size: 0.75rem; opacity: 0.7; margin-top: 0.25rem;">
                    <?php echo e(ucfirst(auth()->user()->role)); ?>

                </div>
            </div>

            <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>

            <?php if(auth()->user()->isEmployer()): ?>
                <a href="<?php echo e(route('employees.index')); ?>" class="nav-link <?php echo e(request()->routeIs('employees.*') ? 'active' : ''); ?>">
                    <i class="fas fa-users"></i> Employees
                </a>
                <a href="<?php echo e(route('performance-reviews.index')); ?>" class="nav-link <?php echo e(request()->routeIs('performance-reviews.*') ? 'active' : ''); ?>">
                    <i class="fas fa-star"></i> Performance
                </a>
            <?php else: ?>
                <a href="<?php echo e(auth()->user()->employee ? route('employees.show', auth()->user()->employee) : '#'); ?>" class="nav-link">
                    <i class="fas fa-user"></i> My Profile
                </a>
                <a href="<?php echo e(auth()->user()->employee ? route('goals.index', auth()->user()->employee) : '#'); ?>" class="nav-link">
                    <i class="fas fa-target"></i> My Goals
                </a>
                <a href="<?php echo e(auth()->user()->employee ? route('training.index', auth()->user()->employee) : '#'); ?>" class="nav-link">
                    <i class="fas fa-graduation-cap"></i> Training
                </a>
            <?php endif; ?>

            <hr style="background: rgba(255,255,255,0.1); margin: 1rem 0;">

            <form method="POST" action="<?php echo e(route('logout')); ?>" style="padding: 0 1rem;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0"><?php echo e($title ?? 'Dashboard'); ?></h1>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong>
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Page Content -->
        <?php echo e($slot); ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\User\Laravel-Project-Icha\resources\views/components/app-layout.blade.php ENDPATH**/ ?>