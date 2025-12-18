<x-app-layout>
    <x-slot name="title">Create Goal</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-target"></i> Create Goal
                        <br>
                        <small class="text-muted">{{ $employee->user->name }} - {{ $employee->position }}</small>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('goals.store', $employee) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Goal Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" placeholder="e.g., Complete project XYZ" 
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4"
                                      placeholder="Provide details about the goal...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="target_date" class="form-label">Target Date *</label>
                                    <input type="date" class="form-control @error('target_date') is-invalid @enderror" 
                                           id="target_date" name="target_date" value="{{ old('target_date') }}" required>
                                    @error('target_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priority *</label>
                                    <select class="form-select @error('priority') is-invalid @enderror" 
                                            id="priority" name="priority" required>
                                        <option value="">Select priority...</option>
                                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }} selected>Medium</option>
                                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Goal
                            </button>
                            <a href="{{ route('goals.index', $employee) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
