<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // List training for an employee
    public function index($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->authorizeEmployee($employee);

        $trainings = $employee->training()->paginate(10);

        return view('training.index', compact('employee', 'trainings'));
    }

    // Create training form
    public function create($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->authorizeEmployee($employee);

        return view('training.create', compact('employee'));
    }

    // Store training
    public function store(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $this->authorizeEmployee($employee);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $training = Training::create([
            'employee_id' => $employee->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'scheduled',
        ]);

        return redirect()->route('training.show', ['employee' => $employee->id, 'training' => $training])
            ->with('success', 'Training created successfully!');
    }

    // Show training detail
    public function show($employeeId, $trainingId)
    {
        $employee = Employee::findOrFail($employeeId);
        $training = Training::findOrFail($trainingId);

        if ($training->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorizeEmployee($employee);

        return view('training.show', compact('employee', 'training'));
    }

    // Edit training form
    public function edit($employeeId, $trainingId)
    {
        $employee = Employee::findOrFail($employeeId);
        $training = Training::findOrFail($trainingId);

        if ($training->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorizeEmployee($employee);

        return view('training.edit', compact('employee', 'training'));
    }

    // Update training
    public function update(Request $request, $employeeId, $trainingId)
    {
        $employee = Employee::findOrFail($employeeId);
        $training = Training::findOrFail($trainingId);

        if ($training->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorize($employee);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:scheduled,in_progress,completed',
            'certificate' => 'nullable|string|max:255',
        ]);

        $training->update($validated);

        return redirect()->route('training.show', ['employee' => $employee->id, 'training' => $training])
            ->with('success', 'Training updated successfully!');
    }

    // Delete training
    public function destroy($employeeId, $trainingId)
    {
        $employee = Employee::findOrFail($employeeId);
        $training = Training::findOrFail($trainingId);

        if ($training->employee_id !== $employee->id) {
            abort(404);
        }

        $this->authorizeEmployee($employee);

        $training->delete();

        return redirect()->route('training.index', $employee)
            ->with('success', 'Training deleted successfully!');
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
