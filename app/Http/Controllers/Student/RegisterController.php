<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('pages.registration');
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'student_code' => 'required|string|unique:students,student_code',
            'name'        => 'required|string',
            'email'       => 'required|email|unique:students,email',
            'password'    => 'required|min:8',
            'nrc'         => 'nullable|string',
            'dob'         => 'nullable|date',
            'phone'       => 'required|string',
            'address'     => 'nullable|string',
            'specialization' => 'required|string',
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        Student::create($validateData);
        return redirect()->route('login')->with('success', 'Registered successfully.');
    }
}
