<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

// Login page as landing page
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Old welcome page (for reference)
Route::get('/welcome', function () {
    return view('welcome');
});

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Employee Management
Route::middleware('auth')->group(function () {
    Route::resource('employees', EmployeeController::class);
});

// Performance Reviews
Route::middleware('auth')->group(function () {
    Route::resource('performance-reviews', PerformanceReviewController::class);
    Route::get('performance-reviews/create/{employeeId}', [PerformanceReviewController::class, 'create'])->name('performance-reviews.create');
});

// Goals
Route::middleware('auth')->group(function () {
    Route::get('employees/{employee}/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('employees/{employee}/goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('employees/{employee}/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::get('employees/{employee}/goals/{goal}', [GoalController::class, 'show'])->name('goals.show');
    Route::get('employees/{employee}/goals/{goal}/edit', [GoalController::class, 'edit'])->name('goals.edit');
    Route::put('employees/{employee}/goals/{goal}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('employees/{employee}/goals/{goal}', [GoalController::class, 'destroy'])->name('goals.destroy');
});

// Training
Route::middleware('auth')->group(function () {
    Route::get('employees/{employee}/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('employees/{employee}/training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('employees/{employee}/training', [TrainingController::class, 'store'])->name('training.store');
    Route::get('employees/{employee}/training/{training}', [TrainingController::class, 'show'])->name('training.show');
    Route::get('employees/{employee}/training/{training}/edit', [TrainingController::class, 'edit'])->name('training.edit');
    Route::put('employees/{employee}/training/{training}', [TrainingController::class, 'update'])->name('training.update');
    Route::delete('employees/{employee}/training/{training}', [TrainingController::class, 'destroy'])->name('training.destroy');
});

require __DIR__.'/auth.php';