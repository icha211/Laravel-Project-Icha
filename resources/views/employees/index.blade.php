<x-app-layout>
    <x-slot name="title">Employees Management</x-slot>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee List</h5>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Employee
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Performance Rating</th>
                        <th>Reviews</th>
                        <th>Hire Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>
                                <code>{{ $employee->employee_id }}</code>
                            </td>
                            <td>
                                <strong>{{ $employee->user->name }}</strong><br>
                                <small class="text-muted">{{ $employee->user->email }}</small>
                            </td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($employee->average_rating))
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <br><small>{{ number_format($employee->average_rating, 2) }}/5</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $employee->total_reviews }}</span>
                            </td>
                            <td>{{ $employee->hire_date->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('employees.destroy', $employee) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <p>No employees yet</p>
                                <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">Create First Employee</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $employees->links() }}
    </div>
</x-app-layout>
