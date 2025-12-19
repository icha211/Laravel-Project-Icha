<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Employer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f6fa;
            color: #2c3e50;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e1e8ed;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid #e1e8ed;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .sidebar-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        .sidebar-version {
            font-size: 11px;
            color: #95a5a6;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-label {
            padding: 0 20px;
            font-size: 11px;
            font-weight: 600;
            color: #95a5a6;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #5a6c7d;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .menu-item:hover {
            background: #f8f9fa;
            color: #667eea;
        }

        .menu-item.active {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, transparent 100%);
            color: #667eea;
            border-left: 3px solid #667eea;
        }

        .menu-item i {
            width: 20px;
            font-size: 16px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            border-top: 1px solid #e1e8ed;
            background: white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .user-info p {
            margin: 0;
            font-size: 12px;
            color: #95a5a6;
        }

        .main-content {
            margin-left: 240px;
            padding: 24px;
            min-height: 100vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .dashboard-title h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .dashboard-subtitle {
            font-size: 14px;
            color: #95a5a6;
            margin-top: 4px;
        }

        .export-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%);
            border-radius: 0 12px 0 100%;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-label {
            font-size: 14px;
            color: #95a5a6;
            font-weight: 500;
        }

        .stat-menu {
            color: #bdc3c7;
            cursor: pointer;
            font-size: 16px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .stat-subtitle {
            font-size: 13px;
            color: #95a5a6;
        }

        .stat-badge {
            display: inline-block;
            padding: 4px 8px;
            background: #e8f5e9;
            color: #2ecc71;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Ensure charts have a stable, fixed height so cards don't stretch */
        .chart-container {
            position: relative;
            width: 100%;
            height: 300px; /* adjust as needed to fit your layout */
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        .chart-menu {
            color: #bdc3c7;
            cursor: pointer;
        }

        .department-bars {
            margin-top: 20px;
        }

        .department-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .dept-bar {
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .dept-label {
            min-width: 100px;
            font-size: 13px;
            color: #5a6c7d;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dept-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        .dept-value {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
        }

        .announcements-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .announcement-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .announcement-item:last-child {
            border-bottom: none;
        }

        .announcement-number {
            width: 24px;
            height: 24px;
            background: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #95a5a6;
            flex-shrink: 0;
        }

        .announcement-content h6 {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 4px 0;
        }

        .announcement-content p {
            font-size: 12px;
            color: #95a5a6;
            margin: 0;
        }

        .heatmap-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            margin-top: 20px;
        }

        .heatmap-cell {
            aspect-ratio: 1;
            border-radius: 4px;
            background: #e8e8e8;
        }

        .heatmap-cell.low {
            background: #d4d9ff;
        }

        .heatmap-cell.medium {
            background: #a8b3ff;
        }

        .heatmap-cell.high {
            background: #667eea;
        }

        .heatmap-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
            font-size: 11px;
            color: #95a5a6;
        }

        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
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
            <a href="<?php echo e(route('dashboard')); ?>" class="menu-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo e(route('employees.index')); ?>" class="menu-item">
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
            <a href="<?php echo e(route('performance-reviews.index')); ?>" class="menu-item">
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

            <div class="menu-label" style="margin-top: 24px;">Settings</div>
            <a href="#" class="menu-item">
                <i class="fas fa-user-cog"></i>
                <span>User Management</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>System Settings</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Notification & Alerts</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-puzzle-piece"></i>
                <span>Integrations</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-shield-alt"></i>
                <span>Security & Privacy</span>
            </a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="menu-item" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></div>
                <div class="user-info">
                    <h6><?php echo e(Auth::user()->name); ?></h6>
                    <p><?php echo e(ucfirst(Auth::user()->role)); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1>Dashboard</h1>
                <p class="dashboard-subtitle">Your workforce insights, simplified.</p>
            </div>
            <button class="export-btn">
                <i class="fas fa-download"></i>
                Export
            </button>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total Employees</span>
                    <i class="fas fa-ellipsis-v stat-menu"></i>
                </div>
                <div class="stat-value"><?php echo e($totalEmployees ?? 0); ?></div>
                <div class="stat-subtitle">Employees</div>
                <div class="stat-subtitle" style="margin-top: 4px;">Across 6 departments</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Attendance Today</span>
                    <i class="fas fa-ellipsis-v stat-menu"></i>
                </div>
                <div class="stat-value">92%</div>
                <div class="stat-subtitle">Present</div>
                <div class="stat-subtitle" style="margin-top: 4px;">+0.9% from today</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Pending Leave Requests</span>
                    <i class="fas fa-ellipsis-v stat-menu"></i>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-subtitle">Requests Pending</div>
                <div class="stat-subtitle" style="margin-top: 4px;">3 urgent requests</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">New Hires This Month</span>
                    <i class="fas fa-ellipsis-v stat-menu"></i>
                </div>
                <div class="stat-value">+12</div>
                <div class="stat-subtitle">Employees</div>
                <div class="stat-subtitle" style="margin-top: 4px;">3 onboarding this week</div>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Attendance Overview</h3>
                    <i class="fas fa-ellipsis-v chart-menu"></i>
                </div>
                <div class="chart-container">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Workforce by Department</h3>
                    <i class="fas fa-ellipsis-v chart-menu"></i>
                </div>
                <div class="department-bars">
                    <?php
                        $deptData = [
                            ['name' => 'Engineering', 'count' => 450, 'percent' => 36.1, 'color' => '#6366f1'],
                            ['name' => 'Marketing', 'count' => 300, 'percent' => 24.1, 'color' => '#22c55e'],
                            ['name' => 'Finance', 'count' => 200, 'percent' => 16.1, 'color' => '#ef4444'],
                            ['name' => 'HR', 'count' => 150, 'percent' => 12.1, 'color' => '#a855f7'],
                            ['name' => 'Operations', 'count' => 120, 'percent' => 9.6, 'color' => '#ec4899'],
                            ['name' => 'Others', 'count' => 25, 'percent' => 2.0, 'color' => '#06b6d4']
                        ];
                    ?>
                    <?php $__currentLoopData = $deptData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="department-item">
                            <div class="dept-label">
                                <div class="dept-color" style="background: <?php echo e($dept['color']); ?>"></div>
                                <?php echo e($dept['name']); ?>

                            </div>
                            <div class="dept-bar" style="width: <?php echo e($dept['percent'] * 8); ?>px; background: <?php echo e($dept['color']); ?>">
                                <?php echo e($dept['count']); ?>

                            </div>
                            <div class="dept-value">(<?php echo e($dept['percent']); ?>%)</div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Payroll Overview</h3>
                    <i class="fas fa-ellipsis-v chart-menu"></i>
                </div>
                <div class="chart-container">
                    <canvas id="payrollChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Attendance Heatmap</h3>
                    <i class="fas fa-ellipsis-v chart-menu"></i>
                </div>
                <div class="heatmap-labels">
                    <span>Mon</span>
                    <span>Feb</span>
                    <span>Mar</span>
                    <span>Apr</span>
                    <span>May</span>
                </div>
                <div class="heatmap-grid">
                    <?php for($i = 0; $i < 35; $i++): ?>
                        <?php
                            $classes = ['low', 'medium', 'high', ''];
                            $class = $classes[array_rand($classes)];
                        ?>
                        <div class="heatmap-cell <?php echo e($class); ?>"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="announcements-card">
                <div class="chart-header">
                    <h3 class="chart-title">Company Announcements</h3>
                    <i class="fas fa-ellipsis-v chart-menu"></i>
                </div>
                <div>
                    <div class="announcement-item">
                        <div class="announcement-number">1</div>
                        <div class="announcement-content">
                            <h6>Company Townhall</h6>
                            <p>Dec 5, 2025 - 3 PM</p>
                        </div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-number">2</div>
                        <div class="announcement-content">
                            <h6>Performance Review Deadline</h6>
                            <p>Dec 15, 2025</p>
                        </div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-number">3</div>
                        <div class="announcement-content">
                            <h6>New Office Health Policy</h6>
                            <p>Effective Jan 1, 2025</p>
                        </div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-number">4</div>
                        <div class="announcement-content">
                            <h6>New HR System Training</h6>
                            <p>Dec 22, 2025 - 10 AM</p>
                        </div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-number">5</div>
                        <div class="announcement-content">
                            <h6>Diversity & Inclusion Workshop</h6>
                            <p>Dec 28, 2026 - 1 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Attendance Overview Chart
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Attendance %',
                    data: [70, 82, 78, 85, 80, 83, 88, 86, 92, 89, 95, 92],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Payroll Overview Chart
        const payrollCtx = document.getElementById('payrollChart').getContext('2d');
        new Chart(payrollCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Cost',
                    data: [300, 250, 350, 280, 320, 290, 310, 380, 400, 370, 350, 390],
                    backgroundColor: '#667eea',
                    borderRadius: 6
                }, {
                    label: 'Expense',
                    data: [200, 180, 220, 190, 210, 200, 190, 250, 240, 230, 220, 260],
                    backgroundColor: '#c7d2fe',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\User\Laravel-Project-Icha\resources\views/dashboard/employer.blade.php ENDPATH**/ ?>