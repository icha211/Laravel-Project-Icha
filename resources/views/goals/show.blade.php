<x-app-layout>
    <x-slot name="title">Goal Details</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $goal->title }}</h5>
                    <span class="badge bg-{{ $goal->status === 'completed' ? 'success' : ($goal->status === 'delayed' ? 'danger' : 'info') }}">
                        {{ ucfirst(str_replace('_', ' ', $goal->status)) }}
                    </span>
                </div>
                <div class="card-body">
                    @if($goal->description)
                        <div class="mb-4">
                            <h6>Description</h6>
                            <p>{{ $goal->description }}</p>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Target Date</small>
                            <h6>{{ $goal->target_date->format('M d, Y') }}</h6>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Priority</small>
                            <span class="badge bg-{{ $goal->priority === 'high' ? 'danger' : ($goal->priority === 'medium' ? 'warning' : 'secondary') }} p-2">
                                {{ ucfirst($goal->priority) }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6>Progress</h6>
                        <div class="progress mb-2" style="height: 20px;">
                            <div class="progress-bar bg-{{ $goal->progress >= 75 ? 'success' : ($goal->progress >= 50 ? 'info' : 'warning') }}" 
                                 style="width: {{ $goal->progress }}%">
                                <span class="text-white" style="display: flex; align-items: center; justify-content: center; height: 100%; font-weight: bold;">
                                    {{ $goal->progress }}%
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('goals.edit', ['employee' => $employee->id, 'goal' => $goal->id]) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Goal
                        </a>
                        <form method="POST" action="{{ route('goals.destroy', ['employee' => $employee->id, 'goal' => $goal->id]) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete Goal
                            </button>
                        </form>
                        <a href="{{ route('goals.index', $employee) }}" class="btn btn-secondary">Back to Goals</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
