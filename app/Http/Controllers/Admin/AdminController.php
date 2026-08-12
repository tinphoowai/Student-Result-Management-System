<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();
        $total_student = count($students);
        $subjects = Subject::all();
        $total_subject = count($subjects);
        return view(
            'admin.dashboard',
            compact(
                'total_student',
                'total_subject'
            )
        );
    }


    public function students(Request $request)
    {
        // Grab the search term from the form input
        $search = $request->input('search');
        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where('student_code', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('admin.students', ['students' => $students]);
    }
    public function addStudent(Request $request)
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

        return redirect('admin/students')->with('success', 'Successfully added a student');
    }
    public function editStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validateData = $request->validate([
            'student_code' => [
                'required',
                'string',
                Rule::unique('students', 'student_code')->ignore($student->id)
            ],
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->ignore($student->id)
            ],
            'password' => [
                'nullable',
                'min:8'
            ],
            'nrc' => [
                'nullable',
                Rule::unique('students', 'nrc')->ignore($student->id)
            ],
            'dob' => [
                'required',
                'date'
            ],
            'phone' => [
                'required',
                'string'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'specialization' => [
                'required',
                'string'
            ]

        ]);

        $student->update([
            'student_code' => $validateData['student_code'],
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'nrc' => $validateData['nrc'],
            'phone' => $validateData['phone'],
            'address' => $validateData['address'],
            'specialization' => $validateData['specialization'],
            'dob' => $validateData['dob'],

        ]);
        if (!empty($validateData['password'])) {
            $validateData['password'] = Hash::make($validateData['password']);
            $student->update([
                'password' => $validateData['password']
            ]);
        }
        return redirect()->back()->with('success', 'Student updated successfully');
    }
    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back()->with('success', 'successfully deleted a student');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success','Successfully logout');


    }
}
