<x-app-layout>
    <x-slot name="title">Goals</x-slot>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>{{ $employee->user->name }}'s Goals</h3>
                <a href="{{ route('goals.create', $employee) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Goal
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($goals as $goal)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">{{ $goal->title }}</h6>
                        <span class="badge bg-{{ $goal->status === 'completed' ? 'success' : ($goal->status === 'delayed' ? 'danger' : ($goal->status === 'not_started' ? 'secondary' : 'info')) }}">
                            {{ ucfirst(str_replace('_', ' ', $goal->status)) }}
                        </span>
                    </div>
                    <div class="card-body">
                        @if($goal->description)
                            <p class="text-muted">{{ Str::limit($goal->description, 100) }}</p>
                        @endif
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">Progress</small>
                                <strong>{{ $goal->progress }}%</strong>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-{{ $goal->progress >= 75 ? 'success' : ($goal->progress >= 50 ? 'info' : ($goal->progress >= 25 ? 'warning' : 'danger')) }}" 
                                     style="width: {{ $goal->progress }}%"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Target Date</small>
                                <strong>{{ $goal->target_date->format('M d, Y') }}</strong>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted d-block">Priority</small>
                                <span class="badge bg-{{ $goal->priority === 'high' ? 'danger' : ($goal->priority === 'medium' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($goal->priority) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="{{ route('goals.show', ['employee' => $employee->id, 'goal' => $goal->id]) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('goals.edit', ['employee' => $employee->id, 'goal' => $goal->id]) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form method="POST" action="{{ route('goals.destroy', ['employee' => $employee->id, 'goal' => $goal->id]) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No goals set yet
                    <br>
                    <a href="{{ route('goals.create', $employee) }}" class="btn btn-sm btn-primary mt-2">Create First Goal</a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $goals->links() }}
    </div>
</x-app-layout>
