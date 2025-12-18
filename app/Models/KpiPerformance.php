<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiPerformance extends Model
{
    protected $table = 'kpi_performance';

    protected $fillable = [
        'employee_id',
        'date',
        'kpi_score',
        'metric',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'kpi_score' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
