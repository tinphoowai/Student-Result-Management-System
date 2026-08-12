<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'mark',
        'grade'
    ];

    public function registration(){
        return $this->belongsTo(Registration::class);
    }
    
}
