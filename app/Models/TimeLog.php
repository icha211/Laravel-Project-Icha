<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'active_time',
        'pause_time',
        'extra_time',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getTotalTimeAttribute()
    {
        return $this->active_time + $this->pause_time + $this->extra_time;
    }

    public function getFormattedActiveTimeAttribute()
    {
        $hours = intdiv($this->active_time, 60);
        $minutes = $this->active_time % 60;
        return "{$hours}h {$minutes}m";
    }
}
