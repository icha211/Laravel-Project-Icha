<x-app-layout>
    <x-slot name="title">Edit Goal</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Goal</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('goals.update', ['employee' => $employee->id, 'goal' => $goal->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Goal Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $goal->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $goal->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="target_date" class="form-label">Target Date *</label>
                                    <input type="date" class="form-control @error('target_date') is-invalid @enderror" 
                                           id="target_date" name="target_date" value="{{ old('target_date', $goal->target_date->format('Y-m-d')) }}" required>
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
                                        <option value="low" {{ old('priority', $goal->priority) === 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ old('priority', $goal->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ old('priority', $goal->priority) === 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="progress" class="form-label">Progress (%) *</label>
                                    <div class="input-group">
                                        <input type="number" min="0" max="100" class="form-control @error('progress') is-invalid @enderror" 
                                               id="progress" name="progress" value="{{ old('progress', $goal->progress) }}" required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('progress')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="not_started" {{ old('status', $goal->status) === 'not_started' ? 'selected' : '' }}>Not Started</option>
                                        <option value="in_progress" {{ old('status', $goal->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status', $goal->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="delayed" {{ old('status', $goal->status) === 'delayed' ? 'selected' : '' }}>Delayed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('goals.show', ['employee' => $employee->id, 'goal' => $goal->id]) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
