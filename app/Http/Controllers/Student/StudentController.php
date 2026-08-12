<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\AcademicPlan;
use App\Models\Student;
use App\Models\Registration;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //
    public function index()
    {
        return view('students.dashboard');
    }
    public function showCertificateForm(Request $request)
    {
        $academic_years = AcademicYear::all();
        $academicYear   = $request->query('academic_year');
        $yearName       = $request->query('year_name');
        $semester       = $request->query('semester');
        $specialization = $request->query('specialization');

        // Query AcademicPlan based on student's dropdown choices
        $plans = AcademicPlan::where('year_level', $yearName) // or 'year_name' depending on your column
            ->where('semester', $semester)
            ->where('specialization', $specialization)
            ->has('subject')
            ->with('subject')
            ->get();

        // Map to simple JSON format
        $subjects = $plans->map(function ($plan) {
            return [
                'id'           => $plan->subject?->id,
                'subject_code' => $plan->subject?->subject_code ?? '',
                'subject_name' => $plan->subject?->subject_name ?? '',
            ];
        });
        return view(
            'students.mark-certificate-page',
            compact(
                'academic_years',
                'subjects'
            )
        );
    }
    public function generateCertificate(Request $request)
    {
        $validateData = $request->validate([
            'student_code' => 'required|string|exists:students,student_code',
            'student_name' => 'required|string',
            'academic_year' => 'required',
            'year_level' => 'required',
            'semester' => 'required',
            'specialization' => 'required',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'integer|exists:subjects,id'
        ]);
        $student_code = $validateData['student_code'];
        $student_name = $validateData['student_name'];
        $academic_year = $validateData['academic_year'];
        $year_level = $validateData['year_level'];
        $semester = $validateData['semester'];
        $specialization = $validateData['specialization'];
        $subjects = $validateData['subjects'];

        $student = Student::where('student_code', $student_code)->first();
        $academic = AcademicYear::findOrFail($academic_year);
        if (!$student) {
            return back()->withErrors(['student_code' => 'Student code not found in system records']);
        }
        $results = Registration::where('student_id', $student->id)
            ->where('academic_year_id', $academic_year)
            ->where('year_level', $year_level)
            ->where('semester', $semester)
            ->where('specialization', $specialization)
            ->whereIn('subject_id', $subjects)
            ->with('subject', 'mark')
            ->get();
        $totalMarks = $results->sum(function ($registration) {
            return $registration->mark->mark ?? 0;
        });
        return view(
            'students.mark-certificate',
            compact(
                'student',
                'results',
                'academic',
                'year_level',
                'semester',
                'totalMarks'

            )
        );
    }
    public function viewResult()
    {
        $academic_years = AcademicYear::all();
        return view('students.result-form', ['academic_years' => $academic_years]);
    }

    public function getResult(Request $request)
    {
        $validateData = $request->validate([
            'student_code' => 'required|string|exists:students,student_code',
            'academic_year' => 'required',
            'year_level' => 'required',
            'semester' => 'required'
        ]);
        $student_code = $validateData['student_code'];
        $academic_year_id = $validateData['academic_year'];
        $year_level = $validateData['year_level'];
        $semester = $validateData['semester'];

        $student = Student::where('student_code', $student_code)->first();
        $academic_year = AcademicYear::where('id', $academic_year_id)->first();

        $results = Registration::where('student_id', $student->id)
            ->where('academic_year_id', $academic_year_id)
            ->where('year_level', $year_level)
            ->where('semester', $semester)
            ->with('subject', 'mark')
            ->get();
     
        return view(
            'students.view-result',
            compact(
                'academic_year',
                'results',
                'student',
                'year_level',
                'semester',
                
            )
        );
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success','Logout successfully');

    }
}
