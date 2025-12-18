<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceReviewController extends Controller
{
    // List all reviews for employees under employer
    public function index()
    {
        if (!Auth::user()->isEmployer()) {
            abort(403, 'Unauthorized');
        }

        $reviews = PerformanceReview::whereHas('employee', function ($query) {
            $query->where('employer_id', Auth::id());
        })->with(['employee', 'reviewer'])->paginate(10);

        return view('performance-reviews.index', compact('reviews'));
    }

    // Show create review form
    public function create($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        if ($employee->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('performance-reviews.create', compact('employee'));
    }

    // Store performance review
    public function store(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);

        if ($employee->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'communication' => 'required|integer|min:1|max:5',
            'teamwork' => 'required|integer|min:1|max:5',
            'productivity' => 'required|integer|min:1|max:5',
            'reliability' => 'required|integer|min:1|max:5',
            'leadership' => 'required|integer|min:1|max:5',
            'review_period' => 'required|string',
            'comments' => 'nullable|string|max:1000',
        ]);

        $review = PerformanceReview::create([
            'employee_id' => $validated['employee_id'],
            'reviewer_id' => Auth::id(),
            'communication' => $validated['communication'],
            'teamwork' => $validated['teamwork'],
            'productivity' => $validated['productivity'],
            'reliability' => $validated['reliability'],
            'leadership' => $validated['leadership'],
            'review_period' => $validated['review_period'],
            'comments' => $validated['comments'],
            'status' => 'submitted',
        ]);

        return redirect()->route('performance-reviews.show', $review)
            ->with('success', 'Performance review created successfully!');
    }

    // Show performance review detail
    public function show(PerformanceReview $review)
    {
        if ($review->employee->employer_id !== Auth::id() && $review->employee->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $review->load(['employee', 'reviewer']);

        return view('performance-reviews.show', compact('review'));
    }

    // Show edit form
    public function edit(PerformanceReview $review)
    {
        if ($review->employee->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('performance-reviews.edit', compact('review'));
    }

    // Update performance review
    public function update(Request $request, PerformanceReview $review)
    {
        if ($review->employee->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'communication' => 'required|integer|min:1|max:5',
            'teamwork' => 'required|integer|min:1|max:5',
            'productivity' => 'required|integer|min:1|max:5',
            'reliability' => 'required|integer|min:1|max:5',
            'leadership' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('performance-reviews.show', $review)
            ->with('success', 'Performance review updated successfully!');
    }

    // Delete performance review
    public function destroy(PerformanceReview $review)
    {
        if ($review->employee->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $review->delete();

        return redirect()->route('performance-reviews.index')
            ->with('success', 'Performance review deleted successfully!');
    }
}
