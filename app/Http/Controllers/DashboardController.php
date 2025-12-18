<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isEmployer()) {
            return $this->employerDashboard($user);
        } else {
            return $this->employeeDashboard($user);
        }
    }

    private function employerDashboard($user)
    {
        $totalEmployees = Employee::where('employer_id', $user->id)->count();
        $employees = Employee::where('employer_id', $user->id)
            ->orderBy('average_rating', 'desc')
            ->take(5)
            ->with('user', 'performanceReviews')
            ->get();

        $topPerformers = Employee::where('employer_id', $user->id)
            ->orderBy('average_rating', 'desc')
            ->take(3)
            ->get();

        $recentReviews = PerformanceReview::whereHas('employee', function ($query) use ($user) {
            $query->where('employer_id', $user->id);
        })->with(['employee', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $departmentStats = Employee::where('employer_id', $user->id)
            ->selectRaw('department, COUNT(*) as count, AVG(average_rating) as avg_rating')
            ->groupBy('department')
            ->get();

        // Get all employees with their performance details
        $allEmployees = Employee::where('employer_id', $user->id)
            ->with(['user', 'performanceReviews'])
            ->orderBy('average_rating', 'desc')
            ->get();

        return view('dashboard.employer', compact('totalEmployees', 'employees', 'topPerformers', 'recentReviews', 'departmentStats', 'allEmployees'));
    }

    private function employeeDashboard($user)
    {
        $employee = $user->employee;

        if (!$employee) {
            return view('dashboard.employee', ['employee' => null]);
        }

        $performanceReviews = $employee->performanceReviews()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->with('reviewer')
            ->get();

        $goals = $employee->goals()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $trainings = $employee->training()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $goalsProgress = $employee->goals()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Calculate average performance across all criteria
        $performanceAverages = PerformanceReview::where('employee_id', $employee->id)
            ->selectRaw('AVG(communication) as avg_communication, AVG(teamwork) as avg_teamwork, AVG(productivity) as avg_productivity, AVG(reliability) as avg_reliability, AVG(leadership) as avg_leadership')
            ->first();

        // Get all performance reviews for history
        $allReviews = $employee->performanceReviews()
            ->orderBy('created_at', 'desc')
            ->with('reviewer')
            ->get();

        return view('dashboard.employee', compact('employee', 'performanceReviews', 'goals', 'trainings', 'goalsProgress', 'performanceAverages', 'allReviews'));
    }
}
