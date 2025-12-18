<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'department',
        'position',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function employees()
    {
        return $this->hasMany(Employee::class, 'employer_id');
    }

    public function performanceReviews()
    {
        return $this->hasMany(PerformanceReview::class, 'reviewer_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    // Check if user is employer
    public function isEmployer()
    {
        return $this->role === 'employer';
    }

    // Check if user is employee
    public function isEmployee()
    {
        return $this->role === 'employee';
    }
}
