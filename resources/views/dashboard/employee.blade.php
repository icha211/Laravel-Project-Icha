<x-app-layout>
    <x-slot name="title">Dashboard - Employee</x-slot>

    @if($employee)
        <div class="row">
            <!-- Employee Info Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #1e40af); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5>{{ $employee->user->name }}</h5>
                        <p class="text-muted mb-3">{{ $employee->position }}</p>
                        <div class="mb-3">
                            <small class="d-block text-muted">Department</small>
                            <strong>{{ $employee->department }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="d-block text-muted">Employee ID</small>
                            <strong>{{ $employee->employee_id }}</strong>
                        </div>
                        <hr>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-primary w-100">Edit Profile</a>
                    </div>
                </div>
            </div>

            <!-- Performance Stats -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value">{{ number_format($employee->average_rating, 2) }}</div>
                            <div class="stat-label">Overall Rating</div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-star" style="color: #fbbf24;"></i>
                                {{ $employee->total_reviews }} performance reviews
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value">{{ $goals->count() }}</div>
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
                            <div class="stat-value">{{ $trainings->count() }}</div>
                            <div class="stat-label">Training Programs</div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-graduation-cap"></i>
                                Skill development
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-value">{{ $performanceReviews->count() }}</div>
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
        @if($performanceReviews->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Performance Analysis</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Average performance across all 5 key criteria based on {{ $allReviews->count() }} total reviews</p>
                            <div class="row">
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #10b981; margin-bottom: 0.5rem;">
                                        {{ number_format($performanceAverages->avg_communication ?? 0, 1) }}/5
                                    </div>
                                    <p class="mb-2"><strong>Communication</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: {{ (($performanceAverages->avg_communication ?? 0) / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #3b82f6; margin-bottom: 0.5rem;">
                                        {{ number_format($performanceAverages->avg_teamwork ?? 0, 1) }}/5
                                    </div>
                                    <p class="mb-2"><strong>Teamwork</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-info" style="width: {{ (($performanceAverages->avg_teamwork ?? 0) / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #f59e0b; margin-bottom: 0.5rem;">
                                        {{ number_format($performanceAverages->avg_productivity ?? 0, 1) }}/5
                                    </div>
                                    <p class="mb-2"><strong>Productivity</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: {{ (($performanceAverages->avg_productivity ?? 0) / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #ef4444; margin-bottom: 0.5rem;">
                                        {{ number_format($performanceAverages->avg_reliability ?? 0, 1) }}/5
                                    </div>
                                    <p class="mb-2"><strong>Reliability</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-danger" style="width: {{ (($performanceAverages->avg_reliability ?? 0) / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 mb-4 text-center">
                                    <div style="font-size: 2.5rem; font-weight: bold; color: #8b5cf6; margin-bottom: 0.5rem;">
                                        {{ number_format($performanceAverages->avg_leadership ?? 0, 1) }}/5
                                    </div>
                                    <p class="mb-2"><strong>Leadership</strong></p>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-purple" style="width: {{ (($performanceAverages->avg_leadership ?? 0) / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-4">
            <!-- Recent Reviews -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Performance Reviews</h5>
                        @if($performanceReviews->count() > 0)
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-outline-primary">View All</a>
                        @endif
                    </div>
                    <div class="card-body">
                        @forelse($performanceReviews as $review)
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $review->review_period }}</h6>
                                        <small class="text-muted d-block">By: {{ $review->reviewer->name }}</small>
                                    </div>
                                    <div class="rating text-end">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <br><small>{{ number_format($review->rating, 1) }}/5</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No reviews yet</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Goals Progress -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Goals Progress</h5>
                        <a href="{{ route('goals.create', $employee) }}" class="btn btn-sm btn-primary">Add Goal</a>
                    </div>
                    <div class="card-body">
                        @forelse($goals as $goal)
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-1">{{ $goal->title }}</h6>
                                    <span class="badge bg-{{ $goal->status === 'completed' ? 'success' : ($goal->status === 'delayed' ? 'danger' : 'info') }}">
                                        {{ ucfirst(str_replace('_', ' ', $goal->status)) }}
                                    </span>
                                </div>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar" style="width: {{ $goal->progress }}%"></div>
                                </div>
                                <small class="text-muted">{{ $goal->progress }}% Progress</small>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No goals set yet</p>
                        @endforelse
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
                        <a href="{{ route('training.create', $employee) }}" class="btn btn-sm btn-primary">Add Training</a>
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
                                @forelse($trainings as $training)
                                    <tr>
                                        <td><strong>{{ $training->title }}</strong></td>
                                        <td>{{ $training->start_date->format('M d, Y') }}</td>
                                        <td>{{ $training->end_date ? $training->end_date->format('M d, Y') : 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $training->status === 'completed' ? 'success' : ($training->status === 'in_progress' ? 'info' : 'secondary') }}">
                                                {{ ucfirst(str_replace('_', ' ', $training->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('training.edit', ['employee' => $employee->id, 'training' => $training->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">No training programs yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Your employee profile is not yet set up. Please contact your employer.
        </div>
    @endif
</x-app-layout>
