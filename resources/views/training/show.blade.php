<x-app-layout>
    <x-slot name="title">Training Details</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $training->title }}</h5>
                    <span class="badge bg-{{ $training->status === 'completed' ? 'success' : ($training->status === 'in_progress' ? 'info' : 'secondary') }}">
                        {{ ucfirst(str_replace('_', ' ', $training->status)) }}
                    </span>
                </div>
                <div class="card-body">
                    @if($training->description)
                        <div class="mb-4">
                            <h6>Description</h6>
                            <p>{{ $training->description }}</p>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Start Date</small>
                            <h6>{{ $training->start_date->format('M d, Y') }}</h6>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">End Date</small>
                            <h6>{{ $training->end_date ? $training->end_date->format('M d, Y') : 'Not set' }}</h6>
                        </div>
                    </div>

                    @if($training->certificate)
                        <hr>
                        <div class="mb-4">
                            <h6>Certificate</h6>
                            <div class="alert alert-success">
                                <i class="fas fa-certificate"></i> {{ $training->certificate }}
                            </div>
                        </div>
                    @endif

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('training.edit', ['employee' => $employee->id, 'training' => $training->id]) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Training
                        </a>
                        <form method="POST" action="{{ route('training.destroy', ['employee' => $employee->id, 'training' => $training->id]) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete Training
                            </button>
                        </form>
                        <a href="{{ route('training.index', $employee) }}" class="btn btn-secondary">Back to Training</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
