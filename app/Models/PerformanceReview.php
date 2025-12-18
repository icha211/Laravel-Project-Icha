<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'reviewer_id',
        'rating',
        'communication',
        'teamwork',
        'productivity',
        'reliability',
        'leadership',
        'review_period',
        'comments',
        'status',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'communication' => 'integer',
        'teamwork' => 'integer',
        'productivity' => 'integer',
        'reliability' => 'integer',
        'leadership' => 'integer',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    // Calculate overall rating from criteria
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($review) {
            $criteria = [
                $review->communication ?? 0,
                $review->teamwork ?? 0,
                $review->productivity ?? 0,
                $review->reliability ?? 0,
                $review->leadership ?? 0,
            ];

            $average = array_sum($criteria) / count($criteria);
            $review->rating = round($average, 2);
        });

        static::saved(function ($review) {
            $review->employee->updateAverageRating();
        });

        static::deleted(function ($review) {
            $review->employee->updateAverageRating();
        });
    }
}
