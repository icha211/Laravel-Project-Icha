<x-app-layout>
    <x-slot name="title">Training Programs</x-slot>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>{{ $employee->user->name }}'s Training Programs</h3>
                <a href="{{ route('training.create', $employee) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Training
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($trainings as $training)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">{{ $training->title }}</h6>
                        <span class="badge bg-{{ $training->status === 'completed' ? 'success' : ($training->status === 'in_progress' ? 'info' : 'secondary') }}">
                            {{ ucfirst(str_replace('_', ' ', $training->status)) }}
                        </span>
                    </div>
                    <div class="card-body">
                        @if($training->description)
                            <p class="text-muted">{{ Str::limit($training->description, 100) }}</p>
                        @endif
                        
                        <div class="mb-3">
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $training->start_date->format('M d, Y') }}
                                @if($training->end_date)
                                    - {{ $training->end_date->format('M d, Y') }}
                                @endif
                            </small>
                        </div>

                        @if($training->certificate)
                            <div class="alert alert-success py-2 px-3">
                                <i class="fas fa-certificate"></i> {{ $training->certificate }}
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light">
                        <a href="{{ route('training.show', ['employee' => $employee->id, 'training' => $training->id]) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('training.edit', ['employee' => $employee->id, 'training' => $training->id]) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form method="POST" action="{{ route('training.destroy', ['employee' => $employee->id, 'training' => $training->id]) }}" style="display:inline;">
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
                    <i class="fas fa-info-circle"></i> No training programs yet
                    <br>
                    <a href="{{ route('training.create', $employee) }}" class="btn btn-sm btn-primary mt-2">Create First Training</a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $trainings->links() }}
    </div>
</x-app-layout>
