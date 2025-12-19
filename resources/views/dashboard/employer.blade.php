<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="header">
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
    </x-slot>

    <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total Employees</span>
                    <i class="fas fa-ellipsis-v stat-menu"></i>
                </div>
                <div class="stat-value">{{ $totalEmployees ?? 0 }}</div>
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
                    @php
                        $deptData = [
                            ['name' => 'Engineering', 'count' => 450, 'percent' => 36.1, 'color' => '#6366f1'],
                            ['name' => 'Marketing', 'count' => 300, 'percent' => 24.1, 'color' => '#22c55e'],
                            ['name' => 'Finance', 'count' => 200, 'percent' => 16.1, 'color' => '#ef4444'],
                            ['name' => 'HR', 'count' => 150, 'percent' => 12.1, 'color' => '#a855f7'],
                            ['name' => 'Operations', 'count' => 120, 'percent' => 9.6, 'color' => '#ec4899'],
                            ['name' => 'Others', 'count' => 25, 'percent' => 2.0, 'color' => '#06b6d4']
                        ];
                    @endphp
                    @foreach($deptData as $dept)
                        <div class="department-item">
                            <div class="dept-label">
                                <div class="dept-color" style="background: {{ $dept['color'] }}"></div>
                                {{ $dept['name'] }}
                            </div>
                            <div class="dept-bar" style="width: {{ $dept['percent'] * 8 }}px; background: {{ $dept['color'] }}">
                                {{ $dept['count'] }}
                            </div>
                            <div class="dept-value">({{ $dept['percent'] }}%)</div>
                        </div>
                    @endforeach
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
                    @for($i = 0; $i < 35; $i++)
                        @php
                            $classes = ['low', 'medium', 'high', ''];
                            $class = $classes[array_rand($classes)];
                        @endphp
                        <div class="heatmap-cell {{ $class }}"></div>
                    @endfor
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
</x-app-layout>
