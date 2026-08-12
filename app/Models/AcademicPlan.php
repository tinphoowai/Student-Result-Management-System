<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_level',
        'semester',
        'specialization',
        'subject_id'

    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
