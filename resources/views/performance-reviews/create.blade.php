<x-app-layout>
    <x-slot name="title">Create Performance Review</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-star"></i> Create Performance Review
                        <br>
                        <small class="text-muted">{{ $employee->user->name }} - {{ $employee->position }}</small>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('performance-reviews.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="review_period" class="form-label">Review Period *</label>
                                    <input type="text" class="form-control @error('review_period') is-invalid @enderror" 
                                           id="review_period" name="review_period" placeholder="e.g., Q1 2024" 
                                           value="{{ old('review_period') }}" required>
                                    @error('review_period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Rate each criterion on a scale of 1-5</strong>
                            <br>
                            <small>1 = Needs Improvement, 5 = Excellent</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="communication" class="form-label">Communication *</label>
                                    <select class="form-select @error('communication') is-invalid @enderror" 
                                            id="communication" name="communication" required>
                                        <option value="">Select rating...</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('communication') == $i ? 'selected' : '' }}>
                                                {{ $i }} - {{ ['Needs Improvement', 'Below Average', 'Average', 'Good', 'Excellent'][$i-1] }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('communication')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teamwork" class="form-label">Teamwork *</label>
                                    <select class="form-select @error('teamwork') is-invalid @enderror" 
                                            id="teamwork" name="teamwork" required>
                                        <option value="">Select rating...</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('teamwork') == $i ? 'selected' : '' }}>
                                                {{ $i }} - {{ ['Needs Improvement', 'Below Average', 'Average', 'Good', 'Excellent'][$i-1] }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('teamwork')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="productivity" class="form-label">Productivity *</label>
                                    <select class="form-select @error('productivity') is-invalid @enderror" 
                                            id="productivity" name="productivity" required>
                                        <option value="">Select rating...</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('productivity') == $i ? 'selected' : '' }}>
                                                {{ $i }} - {{ ['Needs Improvement', 'Below Average', 'Average', 'Good', 'Excellent'][$i-1] }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('productivity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reliability" class="form-label">Reliability *</label>
                                    <select class="form-select @error('reliability') is-invalid @enderror" 
                                            id="reliability" name="reliability" required>
                                        <option value="">Select rating...</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('reliability') == $i ? 'selected' : '' }}>
                                                {{ $i }} - {{ ['Needs Improvement', 'Below Average', 'Average', 'Good', 'Excellent'][$i-1] }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('reliability')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="leadership" class="form-label">Leadership *</label>
                            <select class="form-select @error('leadership') is-invalid @enderror" 
                                    id="leadership" name="leadership" required>
                                <option value="">Select rating...</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('leadership') == $i ? 'selected' : '' }}>
                                        {{ $i }} - {{ ['Needs Improvement', 'Below Average', 'Average', 'Good', 'Excellent'][$i-1] }}
                                    </option>
                                @endfor
                            </select>
                            @error('leadership')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comments" class="form-label">Additional Comments</label>
                            <textarea class="form-control @error('comments') is-invalid @enderror" 
                                      id="comments" name="comments" rows="4" 
                                      placeholder="Provide detailed feedback and suggestions for improvement...">{{ old('comments') }}</textarea>
                            @error('comments')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Review
                            </button>
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
