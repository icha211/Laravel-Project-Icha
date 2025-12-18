<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all employees (employer only)
    public function index()
    {
        if (Auth::user() === null || !Auth::user()->isEmployer()) {
            abort(403, 'Unauthorized');
        }

        $employees = Employee::where('employer_id', Auth::id())
            ->with(['user', 'performanceReviews', 'goals'])
            ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    // Show create employee form
    public function create()
    {
        if (Auth::user() === null || !Auth::user()->isEmployer()) {
            abort(403, 'Unauthorized');
        }

        return view('employees.create');
    }

    // Store employee
    public function store(Request $request)
    {
        if (Auth::user() === null || !Auth::user()->isEmployer()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
        ]);

        // Create user first
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt('password123'), // Default password
            'role' => 'employee',
            'phone' => $validated['phone'],
            'position' => $validated['position'],
            'department' => $validated['department'],
        ]);

        // Create employee record
        $employee = Employee::create([
            'user_id' => $user->id,
            'employer_id' => Auth::id(),
            'employee_id' => 'EMP-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
            'department' => $validated['department'],
            'position' => $validated['position'],
            'hire_date' => $validated['hire_date'],
            'salary' => $validated['salary'],
        ]);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Employee created successfully! Default password sent to email.');
    }

    // Show employee detail
    public function show(Employee $employee)
    {
        $this->authorizeEmployee($employee);


        $employee->load([
            'user',
            'performanceReviews',
            'goals',
            'training',
            'projects' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'timeLogs' => function ($query) {
                $query->where('date', '>=', now()->subDays(30))
                    ->orderBy('date', 'desc');
            },
            'attendance' => function ($query) {
                $query->where('date', '>=', now()->subMonths(6))
                    ->orderBy('date', 'desc');
            },
            'kpiPerformance' => function ($query) {
                $query->where('date', '>=', now()->subMonths(6))
                    ->orderBy('date', 'desc');
            }
        ]);
        return view('employees.show', compact('employee'));
    }

    // Show edit form
    public function edit(Employee $employee)
    {
        $this->authorizeEmployee($employee);

        return view('employees.edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $this->authorizeEmployee($employee);

        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee->update($validated);
        $employee->user()->update([
            'phone' => $validated['phone'],
            'position' => $validated['position'],
            'department' => $validated['department'],
        ]);

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Employee updated successfully!');
    }

    // Delete employee
    public function destroy(Employee $employee)
    {
        $this->authorizeEmployee($employee);

        $user = $employee->user;
        $employee->delete();
        $user->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }

    // Private helper method
    private function authorizeEmployee(Employee $employee)
    {
        $user = Auth::user();

        if ($user->isEmployer() && $employee->employer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if ($user->isEmployee() && $employee->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }

    public function someMethod()
    {
        $user = Auth::user();
        // ...existing code...
    }
}
