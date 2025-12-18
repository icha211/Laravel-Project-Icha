<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // List goals for an employee
    public function index($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->authorize($employee);

        $goals = $employee->goals()->paginate(10);

        return view('goals.index', compact('employee', 'goals'));
    }

    // Create goal form
    public function create($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->authorize($employee);

        return view('goals.create', compact('employee'));
    }

    // Store goal
    public function store(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $this->authorize($employee);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'target_date' => 'required|date|after:today',
            'priority' => 'required|in:low,medium,high',
        ]);

        $goal = Goal::create([
            'employee_id' => $employee->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'target_date' => $validated['target_date'],
            'priority' => $validated['priority'],
            'status' => 'in_progress',
            'progress' => 0,
        ]);

        return redirect()->route('goals.show', ['employee' => $employee->id, 'goal' => $goal])
            ->with('success', 'Goal created successfully!');
    }

    // Show goal detail
    public function show($employeeId, $goalId)
    {
        $employee = Employee::findOrFail($employeeId);
        $goal = Goal::findOrFail($goalId);

        if ($goal->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorize($employee);

        return view('goals.show', compact('employee', 'goal'));
    }

    // Edit goal form
    public function edit($employeeId, $goalId)
    {
        $employee = Employee::findOrFail($employeeId);
        $goal = Goal::findOrFail($goalId);

        if ($goal->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorize($employee);

        return view('goals.edit', compact('employee', 'goal'));
    }

    // Update goal
    public function update(Request $request, $employeeId, $goalId)
    {
        $employee = Employee::findOrFail($employeeId);
        $goal = Goal::findOrFail($goalId);

        if ($goal->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorize($employee);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'target_date' => 'required|date',
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|in:not_started,in_progress,completed,delayed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $goal->update($validated);

        return redirect()->route('goals.show', ['employee' => $employee->id, 'goal' => $goal])
            ->with('success', 'Goal updated successfully!');
    }

    // Delete goal
    public function destroy($employeeId, $goalId)
    {
        $employee = Employee::findOrFail($employeeId);
        $goal = Goal::findOrFail($goalId);

        if ($goal->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorize($employee);

        $goal->delete();

        return redirect()->route('goals.index', $employee)
            ->with('success', 'Goal deleted successfully!');
    }

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
}
