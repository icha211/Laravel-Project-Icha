<x-app-layout>
    <x-slot name="title">Performance Review Details</x-slot>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $review->review_period }} Review</h5>
                    <span class="badge bg-{{ $review->status === 'submitted' ? 'success' : 'warning' }}">
                        {{ ucfirst($review->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Employee</small>
                            <h6>{{ $review->employee->user->name }}</h6>
                            <small class="text-muted">{{ $review->employee->position }}</small>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Reviewed By</small>
                            <h6>{{ $review->reviewer->name }}</h6>
                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>

                    <hr>

                    <!-- Overall Rating -->
                    <div class="text-center mb-4">
                        <small class="text-muted d-block mb-2">Overall Rating</small>
                        <div class="rating" style="font-size: 2rem; justify-content: center;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($review->rating))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <h3 class="my-2">{{ number_format($review->rating, 2) }}/5.00</h3>
                    </div>

                    <hr>

                    <!-- Criteria Ratings -->
                    <div class="mb-4">
                        <h6 class="mb-3">Performance Criteria</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Communication</strong>
                                        <span class="badge bg-info">{{ $review->communication }}/5</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ ($review->communication / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Teamwork</strong>
                                        <span class="badge bg-info">{{ $review->teamwork }}/5</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ ($review->teamwork / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Productivity</strong>
                                        <span class="badge bg-info">{{ $review->productivity }}/5</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ ($review->productivity / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Reliability</strong>
                                        <span class="badge bg-info">{{ $review->reliability }}/5</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ ($review->reliability / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Leadership</strong>
                                        <span class="badge bg-info">{{ $review->leadership }}/5</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ ($review->leadership / 5) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($review->comments)
                        <hr>
                        <div class="mb-4">
                            <h6>Comments</h6>
                            <p>{{ $review->comments }}</p>
                        </div>
                    @endif

                    @if(auth()->user()->id === $review->employee->employer_id)
                        <hr>
                        <div class="d-flex gap-2">
                            <a href="{{ route('performance-reviews.edit', $review) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Review
                            </a>
                            <form method="POST" action="{{ route('performance-reviews.destroy', $review) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete Review
                                </button>
                            </form>
                            <a href="{{ route('performance-reviews.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    @else
                        <a href="{{ route('employees.show', $review->employee) }}" class="btn btn-secondary">Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
