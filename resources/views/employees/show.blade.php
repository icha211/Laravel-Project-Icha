<x-app-layout>
    <x-slot name="title">Employee Details</x-slot>

    <div class="row">
        <!-- Employee Info -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #1e40af); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4>{{ $employee->user->name }}</h4>
                    <p class="text-muted">{{ $employee->position }}</p>
                    <hr>
                    <div class="text-start">
                        <div class="mb-2">
                            <small class="text-muted d-block">Employee ID</small>
                            <code>{{ $employee->employee_id }}</code>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block">Email</small>
                            <a href="mailto:{{ $employee->user->email }}">{{ $employee->user->email }}</a>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block">Phone</small>
                            {{ $employee->user->phone }}
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block">Department</small>
                            {{ $employee->department }}
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block">Hire Date</small>
                            {{ $employee->hire_date->format('M d, Y') }}
                        </div>
                        <div class="mb-2">
                            <small class="text-muted d-block">Salary</small>
                            ${{ number_format($employee->salary, 2) }}
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm w-100 mb-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Performance Stats -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Performance</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="rating" style="font-size: 1.5rem;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($employee->average_rating))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <h3 class="my-2">{{ number_format($employee->average_rating, 2) }}/5.00</h3>
                        <small class="text-muted">{{ $employee->total_reviews }} reviews</small>
                    </div>
                </div>
            </div>

            <!-- KPI Performance Card -->
            @php
                $latestKpi = $employee->kpiPerformance->first();
                $avgKpi = $employee->kpiPerformance->avg('kpi_score') ?? 0;
            @endphp
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> KPI Performance</h5>
                </div>
                <div class="card-body text-center">
                    <div style="font-size: 2.5rem; font-weight: bold; color: #2563eb; margin: 1rem 0;">
                        {{ number_format($avgKpi, 2) }}%
                    </div>
                    <small class="text-muted d-block">Average KPI Score</small>
                    <div class="progress mt-3" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ $avgKpi }}%"></div>
                    </div>
                    @if($latestKpi)
                        <p class="text-muted small mt-2">Latest: {{ $latestKpi->metric }} ({{ $latestKpi->date->format('M d') }})</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabs Content -->
        <div class="col-md-8">
            <ul class="nav nav-tabs mb-3" role="tablist" style="overflow-x: auto; flex-wrap: nowrap;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="kpi-tab" data-bs-toggle="tab" data-bs-target="#kpi" type="button" role="tab">
                        <i class="fas fa-chart-line"></i> KPI Metrics
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab">
                        <i class="fas fa-tasks"></i> Projects
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="time-tab" data-bs-toggle="tab" data-bs-target="#time" type="button" role="tab">
                        <i class="fas fa-clock"></i> Time Tracking
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab">
                        <i class="fas fa-calendar-check"></i> Attendance
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                        <i class="fas fa-star"></i> Reviews
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="goals-tab" data-bs-toggle="tab" data-bs-target="#goals" type="button" role="tab">
                        <i class="fas fa-target"></i> Goals
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="training-tab" data-bs-toggle="tab" data-bs-target="#training" type="button" role="tab">
                        <i class="fas fa-graduation-cap"></i> Training
                    </button>
                </li>
            </ul>

            <!-- Tab Content Container -->
            <div class="tab-content">
                <!-- KPI Metrics Tab -->
                <div class="tab-pane fade show active" id="kpi" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">KPI Performance Metrics</h5>
                        </div>
                        <div class="card-body">
                            @if($employee->kpiPerformance->isNotEmpty())
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="alert alert-info mb-0">
                                            <small class="text-muted">Average Score</small>
                                            <h4 class="mb-0">{{ number_format($avgKpi, 2) }}%</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-warning mb-0">
                                            <small class="text-muted">Total Records</small>
                                            <h4 class="mb-0">{{ $employee->kpiPerformance->count() }}</h4>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mb-3">Recent KPI Records</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Metric</th>
                                                <th>Score</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($employee->kpiPerformance->take(10) as $kpi)
                                                <tr>
                                                    <td><small>{{ $kpi->date->format('M d, Y') }}</small></td>
                                                    <td><strong>{{ $kpi->metric }}</strong></td>
                                                    <td>
                                                        <span class="badge bg-{{ $kpi->kpi_score >= 75 ? 'success' : ($kpi->kpi_score >= 50 ? 'warning' : 'danger') }}">
                                                            {{ number_format($kpi->kpi_score, 2) }}%
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar bg-{{ $kpi->kpi_score >= 75 ? 'success' : ($kpi->kpi_score >= 50 ? 'warning' : 'danger') }}" 
                                                                style="width: {{ $kpi->kpi_score }}%;">
                                                                <small>{{ number_format($kpi->kpi_score, 0) }}%</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="text-center text-muted">No KPI records</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-4">No KPI performance data available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Projects Tab -->
                <div class="tab-pane fade" id="projects" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Projects</h5>
                        </div>
                        <div class="card-body">
                            @if($employee->projects->isNotEmpty())
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="alert alert-primary mb-0">
                                            <small class="text-muted">Total</small>
                                            <h4 class="mb-0">{{ $employee->projects->count() }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="alert alert-success mb-0">
                                            <small class="text-muted">Completed</small>
                                            <h4 class="mb-0">{{ $employee->projects->where('status', 'completed')->count() }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="alert alert-info mb-0">
                                            <small class="text-muted">In Progress</small>
                                            <h4 class="mb-0">{{ $employee->projects->where('status', 'in_progress')->count() }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="alert alert-warning mb-0">
                                            <small class="text-muted">Not Started</small>
                                            <h4 class="mb-0">{{ $employee->projects->where('status', 'not_started')->count() }}</h4>
                                        </div>
                                    </div>
                                </div>

                                @foreach($employee->projects as $project)
                                    <div class="card mb-3" style="border-left: 4px solid #2563eb;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="mb-0">{{ $project->name }}</h6>
                                                <span class="badge bg-{{ $project->status === 'completed' ? 'success' : ($project->status === 'in_progress' ? 'info' : 'secondary') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                                </span>
                                            </div>
                                            @if($project->description)
                                                <p class="text-muted small mb-2">{{ $project->description }}</p>
                                            @endif
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Completion: {{ $project->completion_percentage }}%</small>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-success" style="width: {{ $project->completion_percentage }}%"></div>
                                                </div>
                                            </div>
                                            <div class="row text-center" style="font-size: 0.85rem;">
                                                @if($project->start_date)
                                                    <div class="col-6">
                                                        <small class="text-muted">Start: {{ $project->start_date->format('M d') }}</small>
                                                    </div>
                                                @endif
                                                @if($project->end_date)
                                                    <div class="col-6">
                                                        <small class="text-muted">End: {{ $project->end_date->format('M d') }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center py-4">No projects assigned</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Time Tracking Tab -->
                <div class="tab-pane fade" id="time" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Time Tracking (Last 30 Days)</h5>
                        </div>
                        <div class="card-body">
                            @if($employee->timeLogs->isNotEmpty())
                                @php
                                    $totalActive = $employee->timeLogs->sum('active_time');
                                    $totalPause = $employee->timeLogs->sum('pause_time');
                                    $totalExtra = $employee->timeLogs->sum('extra_time');
                                    $totalTime = $totalActive + $totalPause + $totalExtra;
                                    
                                    $hoursActive = intdiv($totalActive, 60);
                                    $minutesActive = $totalActive % 60;
                                    $hoursPause = intdiv($totalPause, 60);
                                    $minutesPause = $totalPause % 60;
                                    $hoursExtra = intdiv($totalExtra, 60);
                                    $minutesExtra = $totalExtra % 60;
                                @endphp
                                
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="alert alert-success mb-0">
                                            <small class="text-muted">Active Time</small>
                                            <h4 class="mb-0">{{ $hoursActive }}h {{ $minutesActive }}m</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="alert alert-warning mb-0">
                                            <small class="text-muted">Pause Time</small>
                                            <h4 class="mb-0">{{ $hoursPause }}h {{ $minutesPause }}m</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="alert alert-info mb-0">
                                            <small class="text-muted">Extra Time</small>
                                            <h4 class="mb-0">{{ $hoursExtra }}h {{ $minutesExtra }}m</h4>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mb-3">Time Distribution</h6>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="d-flex" style="height: 60px; border-radius: 8px; overflow: hidden;">
                                            @if($totalTime > 0)
                                                <div style="background-color: #10b981; width: {{ ($totalActive / $totalTime) * 100 }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                    @if(($totalActive / $totalTime) * 100 > 10)
                                                        {{ number_format(($totalActive / $totalTime) * 100, 0) }}%
                                                    @endif
                                                </div>
                                                <div style="background-color: #f59e0b; width: {{ ($totalPause / $totalTime) * 100 }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                    @if(($totalPause / $totalTime) * 100 > 10)
                                                        {{ number_format(($totalPause / $totalTime) * 100, 0) }}%
                                                    @endif
                                                </div>
                                                <div style="background-color: #3b82f6; width: {{ ($totalExtra / $totalTime) * 100 }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                    @if(($totalExtra / $totalTime) * 100 > 10)
                                                        {{ number_format(($totalExtra / $totalTime) * 100, 0) }}%
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <small><span style="background-color: #10b981; padding: 2px 8px; border-radius: 4px; color: white;">Active</span></small>
                                            </div>
                                            <div class="col-md-4">
                                                <small><span style="background-color: #f59e0b; padding: 2px 8px; border-radius: 4px; color: white;">Pause</span></small>
                                            </div>
                                            <div class="col-md-4">
                                                <small><span style="background-color: #3b82f6; padding: 2px 8px; border-radius: 4px; color: white;">Extra</span></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mb-3">Recent Time Logs</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Active</th>
                                                <th>Pause</th>
                                                <th>Extra</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($employee->timeLogs->take(10) as $log)
                                                <tr>
                                                    <td><small>{{ $log->date->format('M d, Y') }}</small></td>
                                                    <td><small class="text-success">{{ intdiv($log->active_time, 60) }}h {{ $log->active_time % 60 }}m</small></td>
                                                    <td><small class="text-warning">{{ intdiv($log->pause_time, 60) }}h {{ $log->pause_time % 60 }}m</small></td>
                                                    <td><small class="text-info">{{ intdiv($log->extra_time, 60) }}h {{ $log->extra_time % 60 }}m</small></td>
                                                    @php $totalMinutes = $log->total_time; @endphp
                                                    <td><small class="fw-bold">{{ intdiv($totalMinutes, 60) }}h {{ $totalMinutes % 60 }}m</small></td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5" class="text-center text-muted">No time logs available</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-4">No time tracking data available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Attendance Tab -->
                <div class="tab-pane fade" id="attendance" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Attendance (Last 6 Months)</h5>
                        </div>
                        <div class="card-body">
                            @if($employee->attendance->isNotEmpty())
                                @php
                                    $presentCount = $employee->attendance->where('status', 'present')->count();
                                    $lateCount = $employee->attendance->where('status', 'late')->count();
                                    $absentCount = $employee->attendance->where('status', 'absent')->count();
                                    $leaveCount = $employee->attendance->where('status', 'on_leave')->count();
                                    $totalDays = $employee->attendance->count();
                                    $presentPercentage = $totalDays > 0 ? ($presentCount / $totalDays) * 100 : 0;
                                @endphp
                                
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="alert alert-success mb-0">
                                            <small class="text-muted">Present</small>
                                            <h4 class="mb-0">{{ $presentCount }}</h4>
                                            <small>{{ number_format($presentPercentage, 1) }}%</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="alert alert-warning mb-0">
                                            <small class="text-muted">Late</small>
                                            <h4 class="mb-0">{{ $lateCount }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="alert alert-danger mb-0">
                                            <small class="text-muted">Absent</small>
                                            <h4 class="mb-0">{{ $absentCount }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="alert alert-info mb-0">
                                            <small class="text-muted">On Leave</small>
                                            <h4 class="mb-0">{{ $leaveCount }}</h4>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mb-3">Attendance Distribution</h6>
                                <div class="progress mb-4" style="height: 40px;">
                                    <div class="progress-bar bg-success" style="width: {{ ($presentCount / $totalDays) * 100 }}%;" title="Present">
                                        @if(($presentCount / $totalDays) * 100 > 10)
                                            <small>{{ $presentCount }}</small>
                                        @endif
                                    </div>
                                    <div class="progress-bar bg-warning" style="width: {{ ($lateCount / $totalDays) * 100 }}%;" title="Late">
                                        @if(($lateCount / $totalDays) * 100 > 10)
                                            <small>{{ $lateCount }}</small>
                                        @endif
                                    </div>
                                    <div class="progress-bar bg-danger" style="width: {{ ($absentCount / $totalDays) * 100 }}%;" title="Absent">
                                        @if(($absentCount / $totalDays) * 100 > 10)
                                            <small>{{ $absentCount }}</small>
                                        @endif
                                    </div>
                                    <div class="progress-bar bg-info" style="width: {{ ($leaveCount / $totalDays) * 100 }}%;" title="On Leave">
                                        @if(($leaveCount / $totalDays) * 100 > 10)
                                            <small>{{ $leaveCount }}</small>
                                        @endif
                                    </div>
                                </div>

                                <h6 class="mb-3">Recent Attendance Records</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($employee->attendance->take(15) as $att)
                                                <tr>
                                                    <td><small>{{ $att->date->format('M d, Y') }}</small></td>
                                                    <td>
                                                        <span class="badge bg-{{ $att->status === 'present' ? 'success' : ($att->status === 'late' ? 'warning' : ($att->status === 'absent' ? 'danger' : 'info')) }}">
                                                            {{ ucfirst($att->status) }}
                                                        </span>
                                                    </td>
                                                    <td><small>{{ $att->check_in?->format('H:i') ?? '-' }}</small></td>
                                                    <td><small>{{ $att->check_out?->format('H:i') ?? '-' }}</small></td>
                                                    <td><small class="text-muted">{{ $att->notes ?? '-' }}</small></td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5" class="text-center text-muted">No attendance records</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-4">No attendance data available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Performance Reviews</h5>
                            @if(auth()->user()->isEmployer())
                                <a href="{{ route('performance-reviews.create', $employee->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> New Review
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @forelse($employee->performanceReviews as $review)
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-1">{{ $review->review_period }}</h6>
                                            <small class="text-muted">By: {{ $review->reviewer->name }}</small>
                                        </div>
                                        <span class="badge bg-{{ $review->status === 'submitted' ? 'success' : ($review->status === 'draft' ? 'warning' : 'info') }}">
                                            {{ ucfirst($review->status) }}
                                        </span>
                                    </div>
                                    <div class="row text-center my-3">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Communication</small>
                                            <strong>{{ $review->communication }}/5</strong>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Teamwork</small>
                                            <strong>{{ $review->teamwork }}/5</strong>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Productivity</small>
                                            <strong>{{ $review->productivity }}/5</strong>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Reliability</small>
                                            <strong>{{ $review->reliability }}/5</strong>
                                        </div>
                                    </div>
                                    @if($review->comments)
                                        <div class="alert alert-light">
                                            <strong>Comments:</strong>
                                            <p class="mb-0">{{ $review->comments }}</p>
                                        </div>
                                    @endif
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('performance-reviews.show', $review) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        @if(auth()->user()->isEmployer())
                                            <a href="{{ route('performance-reviews.edit', $review) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form method="POST" action="{{ route('performance-reviews.destroy', $review) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sure?')">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No performance reviews yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Goals Tab -->
                <div class="tab-pane fade" id="goals" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Goals</h5>
                            <a href="{{ route('goals.create', $employee) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add Goal
                            </a>
                        </div>
                        <div class="card-body">
                            @forelse($employee->goals as $goal)
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6>{{ $goal->title }}</h6>
                                        <span class="badge bg-{{ $goal->status === 'completed' ? 'success' : ($goal->status === 'delayed' ? 'danger' : 'info') }}">
                                            {{ ucfirst(str_replace('_', ' ', $goal->status)) }}
                                        </span>
                                    </div>
                                    @if($goal->description)
                                        <p class="text-muted mb-2">{{ $goal->description }}</p>
                                    @endif
                                    <div class="mb-2">
                                        <small class="text-muted">Progress: {{ $goal->progress }}%</small>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar" style="width: {{ $goal->progress }}%"></div>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mb-2">Target: {{ $goal->target_date->format('M d, Y') }}</small>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('goals.edit', ['employee' => $employee->id, 'goal' => $goal->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('goals.destroy', ['employee' => $employee->id, 'goal' => $goal->id]) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No goals set</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Training Tab -->
                <div class="tab-pane fade" id="training" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Training Programs</h5>
                            <a href="{{ route('training.create', $employee) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add Training
                            </a>
                        </div>
                        <div class="card-body">
                            @forelse($employee->training as $training)
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6>{{ $training->title }}</h6>
                                        <span class="badge bg-{{ $training->status === 'completed' ? 'success' : ($training->status === 'in_progress' ? 'info' : 'secondary') }}">
                                            {{ ucfirst(str_replace('_', ' ', $training->status)) }}
                                        </span>
                                    </div>
                                    @if($training->description)
                                        <p class="text-muted mb-2">{{ $training->description }}</p>
                                    @endif
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar"></i> {{ $training->start_date->format('M d, Y') }} 
                                        @if($training->end_date) - {{ $training->end_date->format('M d, Y') }} @endif
                                    </small>
                                    @if($training->certificate)
                                        <small class="text-success d-block"><i class="fas fa-certificate"></i> {{ $training->certificate }}</small>
                                    @endif
                                    <div class="d-flex gap-2 mt-2">
                                        <a href="{{ route('training.edit', ['employee' => $employee->id, 'training' => $training->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form method="POST" action="{{ route('training.destroy', ['employee' => $employee->id, 'training' => $training->id]) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No training programs</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
