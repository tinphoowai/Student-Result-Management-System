<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'academic_year_id',
        'year_level',
        'semester',
        'specialization',
        'type'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function mark(){
        return $this->hasOne(Mark::class);
    }
}
