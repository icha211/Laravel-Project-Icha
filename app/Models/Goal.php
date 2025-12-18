<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'title',
        'description',
        'target_date',
        'progress',
        'status',
        'priority',
    ];

    protected $casts = [
        'target_date' => 'date',
        'progress' => 'integer',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
