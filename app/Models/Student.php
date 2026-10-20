<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'email',
        'course',
        'year_level',
        'grade',
        'status',
        'remarks',
    ];

    protected $casts = [
        'grade' => 'decimal:2',
    ];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getLetterGradeAttribute(): string
    {
        if ($this->grade === null) {
            return 'N/A';
        }
        return match (true) {
            $this->grade >= 97 => 'A+',
            $this->grade >= 93 => 'A',
            $this->grade >= 90 => 'A-',
            $this->grade >= 87 => 'B+',
            $this->grade >= 83 => 'B',
            $this->grade >= 80 => 'B-',
            $this->grade >= 77 => 'C+',
            $this->grade >= 73 => 'C',
            $this->grade >= 70 => 'C-',
            $this->grade >= 67 => 'D+',
            $this->grade >= 60 => 'D',
            default => 'F',
        };
    }

    public function getIsPassingAttribute(): bool
    {
        return $this->grade !== null && $this->grade >= 60;
    }

    public function getGradeBadgeAttribute(): string
    {
        if ($this->grade === null) {
            return 'bg-secondary';
        }
        if ($this->grade >= 90) {
            return 'bg-success';
        }
        if ($this->grade >= 75) {
            return 'bg-primary';
        }
        if ($this->grade >= 60) {
            return 'bg-warning text-dark';
        }
        return 'bg-danger';
    }

    public function scopePassing($query)
    {
        return $query->where('grade', '>=', 60);
    }

    public function scopeFailing($query)
    {
        return $query->where('grade', '<', 60)->whereNotNull('grade');
    }

    public function scopeOfCourse($query, string $course)
    {
        return $query->where('course', $course);
    }

    public function scopeOfYear($query, string $year)
    {
        return $query->where('year_level', $year);
    }
}
