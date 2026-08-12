<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Authenticable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'student_code',
        'name',
        'email',
        'password',
        'nrc',
        'dob',
        'phone',
        'address',
        'specialization'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password'=>'hashed',
    ];

    public function registrations(){
        return $this->hasMany(Registration::class);
    }
}
