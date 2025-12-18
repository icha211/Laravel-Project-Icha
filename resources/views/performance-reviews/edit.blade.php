<x-app-layout>
    <x-slot name="title">Edit Performance Review</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Performance Review</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('performance-reviews.update', $review) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="alert alert-info mb-4">
                            <strong>{{ $review->employee->user->name }}</strong> - {{ $review->review_period }}
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
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('communication', $review->communication) == $i ? 'selected' : '' }}>
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
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('teamwork', $review->teamwork) == $i ? 'selected' : '' }}>
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
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('productivity', $review->productivity) == $i ? 'selected' : '' }}>
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
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('reliability', $review->reliability) == $i ? 'selected' : '' }}>
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
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('leadership', $review->leadership) == $i ? 'selected' : '' }}>
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
                                      id="comments" name="comments" rows="4">{{ old('comments', $review->comments) }}</textarea>
                            @error('comments')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('performance-reviews.show', $review) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
