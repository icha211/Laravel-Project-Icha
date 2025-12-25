<x-app-layout>
    <x-slot name="title">Performance Reviews</x-slot>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1>Performance Reviews</h1>
                <p class="dashboard-subtitle">Track and manage employee performance ratings.</p>
            </div>
        </div>
    </x-slot>

    <div class="chart-card">
        <div class="chart-header d-flex justify-content-between align-items-center">
            <h3 class="chart-title mb-0">Performance Reviews</h3>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Review Period</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Reviewed By</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>
                                <strong>{{ $review->employee->user->name }}</strong><br>
                                <small class="text-muted">{{ $review->employee->position }}</small>
                            </td>
                            <td>{{ $review->review_period }}</td>
                            <td>
                                <div class="rating text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-muted">{{ number_format($review->rating, 1) }}/5</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $review->status === 'submitted' ? 'success' : ($review->status === 'draft' ? 'warning' : 'info') }}">
                                    {{ ucfirst($review->status) }}
                                </span>
                            </td>
                            <td>{{ $review->reviewer->name }}</td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('performance-reviews.show', $review) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('performance-reviews.edit', $review) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form method="POST" action="{{ route('performance-reviews.destroy', $review) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <p class="mb-0">No reviews yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->links() }}
    </div>
</x-app-layout>
