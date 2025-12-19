<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Employee Management System'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        /* Global */
        body { background: #f5f6fa; color: #2c3e50; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; }

        /* Sidebar (unified with dashboard) */
        .sidebar { position: fixed; top: 0; left: 0; width: 240px; height: 100vh; background: #ffffff; border-right: 1px solid #e1e8ed; overflow-y: auto; z-index: 1000; }
        .sidebar-header { padding: 24px 20px; border-bottom: 1px solid #e1e8ed; }
        .sidebar-brand { display: flex; align-items: center; gap: 12px; }
        .sidebar-logo { width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; font-weight: 600; }
        .sidebar-title { font-size: 16px; font-weight: 600; color: #2c3e50; }
        .sidebar-version { font-size: 11px; color: #95a5a6; }
        .sidebar-menu { padding: 20px 0; }
        .menu-label { padding: 0 20px; font-size: 11px; font-weight: 600; color: #95a5a6; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 8px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #5a6c7d; text-decoration: none; transition: all .3s ease; font-size: 14px; }
        .menu-item i { width: 20px; font-size: 16px; }
        .menu-item:hover { background: #f8f9fa; color: #667eea; }
        .menu-item.active { background: linear-gradient(90deg, rgba(102,126,234,.1) 0%, transparent 100%); color: #667eea; border-left: 3px solid #667eea; }
        .sidebar-footer { position: sticky; bottom: 0; padding: 20px; border-top: 1px solid #e1e8ed; background: #fff; }
        .user-profile { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 14px; }
        .user-info h6 { margin: 0; font-size: 14px; font-weight: 600; color: #2c3e50; }
        .user-info p { margin: 0; font-size: 12px; color: #95a5a6; }

        /* Main area */
        .main-content { margin-left: 240px; padding: 24px; min-height: 100vh; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }

        /* Cards */
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .card-header { background: #f1f5f9; border-bottom: 1px solid #e2e8f0; }

        /* Dashboard specific helpers shared across pages */
        .dashboard-header { display:flex; justify-content: space-between; align-items:center; margin-bottom: 24px; }
        .dashboard-title h1 { font-size: 28px; font-weight: 700; margin:0; color:#2c3e50; }
        .dashboard-subtitle { font-size: 14px; color:#95a5a6; margin-top:4px; }
        .export-btn { padding:10px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border:none; border-radius:8px; color:#fff; font-weight:600; font-size:14px; cursor:pointer; display:flex; align-items:center; gap:8px; transition:.3s; }
        .export-btn:hover { transform: translateY(-2px); box-shadow:0 5px 15px rgba(102,126,234,.3); }

        .stats-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:20px; margin-bottom:24px; }
        .stat-card { background:#fff; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,.05); position:relative; overflow:hidden; transition:.3s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow:0 4px 12px rgba(0,0,0,.1); }
        .stat-card::before { content:''; position:absolute; top:0; right:0; width:100px; height:100px; background: linear-gradient(135deg, rgba(102,126,234,.05) 0%, transparent 100%); border-radius:0 12px 0 100%; }
        .stat-header { display:flex; justify-content: space-between; align-items:flex-start; margin-bottom:16px; }
        .stat-label { font-size:14px; color:#95a5a6; font-weight:500; }
        .stat-menu { color:#bdc3c7; cursor:pointer; font-size:16px; }
        .stat-value { font-size:32px; font-weight:700; color:#2c3e50; margin-bottom:8px; }
        .stat-subtitle { font-size:13px; color:#95a5a6; }

        .charts-grid { display:grid; grid-template-columns: repeat(2, 1fr); gap:20px; margin-bottom:24px; }

        /* Charts */
        .chart-card { background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; }
        .chart-container { position: relative; width: 100%; height: 300px; }

        /* Department bars */
        .department-bars { margin-top:20px; }
        .department-item { display:flex; align-items:center; gap:16px; margin-bottom:16px; }
        .dept-label { min-width:100px; font-size:13px; color:#5a6c7d; display:flex; align-items:center; gap:8px; }
        .dept-color { width:12px; height:12px; border-radius:3px; }
        .dept-bar { height:24px; border-radius:6px; display:flex; align-items:center; padding:0 12px; color:#fff; font-size:12px; font-weight:600; }
        .dept-value { font-size:13px; font-weight:600; color:#2c3e50; }

        /* Heatmap & announcements */
        .announcements-card { background:#fff; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,.05); }
        .announcement-item { display:flex; align-items:flex-start; gap:16px; padding:16px 0; border-bottom:1px solid #ecf0f1; }
        .announcement-item:last-child { border-bottom: none; }
        .announcement-number { width:24px; height:24px; background:#f8f9fa; border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#95a5a6; flex-shrink:0; }
        .announcement-content h6 { font-size:14px; font-weight:600; color:#2c3e50; margin:0 0 4px 0; }
        .announcement-content p { font-size:12px; color:#95a5a6; margin:0; }
        .heatmap-grid { display:grid; grid-template-columns: repeat(7, 1fr); gap:4px; margin-top:20px; }
        .heatmap-cell { aspect-ratio:1; border-radius:4px; background:#e8e8e8; }
        .heatmap-cell.low { background:#d4d9ff; }
        .heatmap-cell.medium { background:#a8b3ff; }
        .heatmap-cell.high { background:#667eea; }
        .heatmap-labels { display:flex; justify-content:space-between; margin-top:12px; font-size:11px; color:#95a5a6; }

        @media (max-width: 1200px) { .charts-grid { grid-template-columns: 1fr; } }
        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } .stats-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <!-- Sidebar Navigation (unified) -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <div class="sidebar-logo">W</div>
                <div>
                    <div class="sidebar-title">Workforce</div>
                    <div class="sidebar-version">Version 2.4</div>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-label">Main Menu</div>
            <a href="<?php echo e(route('dashboard')); ?>" class="menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isEmployer()): ?>
                    <a href="<?php echo e(route('employees.index')); ?>" class="menu-item <?php echo e(request()->routeIs('employees.*') ? 'active' : ''); ?>">
                        <i class="fas fa-users"></i>
                        <span>Employees</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Attendance</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Payroll</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-user-plus"></i>
                        <span>Recruitment</span>
                    </a>
                    <a href="<?php echo e(route('performance-reviews.index')); ?>" class="menu-item <?php echo e(request()->routeIs('performance-reviews.*') ? 'active' : ''); ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>Performance</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Training</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(auth()->user()->employee ? route('employees.show', auth()->user()->employee) : '#'); ?>" class="menu-item <?php echo e(request()->routeIs('employees.show') ? 'active' : ''); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                    <a href="<?php echo e(auth()->user()->employee ? route('goals.index', auth()->user()->employee) : '#'); ?>" class="menu-item <?php echo e(request()->routeIs('goals.*') ? 'active' : ''); ?>">
                        <i class="fas fa-bullseye"></i>
                        <span>My Goals</span>
                    </a>
                    <a href="<?php echo e(auth()->user()->employee ? route('training.index', auth()->user()->employee) : '#'); ?>" class="menu-item <?php echo e(request()->routeIs('training.*') ? 'active' : ''); ?>">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Training</span>
                    </a>
                <?php endif; ?>

                <div class="menu-label" style="margin-top: 24px;">Settings</div>
                <a href="#" class="menu-item"><i class="fas fa-user-cog"></i><span>User Management</span></a>
                <a href="#" class="menu-item"><i class="fas fa-cog"></i><span>System Settings</span></a>
                <a href="#" class="menu-item"><i class="fas fa-bell"></i><span>Notification & Alerts</span></a>
                <a href="#" class="menu-item"><i class="fas fa-puzzle-piece"></i><span>Integrations</span></a>
                <a href="#" class="menu-item"><i class="fas fa-shield-alt"></i><span>Security & Privacy</span></a>

                <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin-top: 8px;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="menu-item" style="width:100%; border:none; background:none; text-align:left; cursor:pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></div>
                    <div class="user-info">
                        <h6><?php echo e(Auth::user()->name); ?></h6>
                        <p><?php echo e(ucfirst(Auth::user()->role)); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="page-header">
            <h1 class="h3 mb-0"><?php echo e($title ?? 'Dashboard'); ?></h1>
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
</body>
</html>
<?php /**PATH C:\Users\User\Laravel-Project-Icha\resources\views/components/app-layout.blade.php ENDPATH**/ ?>