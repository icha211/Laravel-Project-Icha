<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employer_id',
        'employee_id',
        'department',
        'position',
        'hire_date',
        'salary',
        'performance_rating',
        'total_reviews',
        'average_rating',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'salary' => 'decimal:2',
        'performance_rating' => 'decimal:2',
        'average_rating' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function performanceReviews()
    {
        return $this->hasMany(PerformanceReview::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function kpiPerformance()
    {
        return $this->hasMany(KpiPerformance::class);
    }

    // Calculate average rating from reviews
    public function updateAverageRating()
    {
        $reviews = $this->performanceReviews;
        
        if ($reviews->count() > 0) {
            $average = $reviews->avg('rating');
            $this->update([
                'average_rating' => $average,
                'total_reviews' => $reviews->count(),
                'performance_rating' => $average,
            ]);
        }
    }
}
