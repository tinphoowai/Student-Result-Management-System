<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\AcademicYear;
use App\Models\AcademicPlan;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class RegistrationController extends Controller
{
    //
    public function registrations()
    {
        $registrations = Registration::all();
        $academic_years = AcademicYear::all();
        return view(
            'admin.registrations',
            compact('academic_years', 'registrations')
        );
    }

    public function getSubjectsByPlan(Request $request)
    {
        $year_level = $request->query('year_level');
        $semester   = $request->query('semester');

        // Safe query loading only valid relationships
        $plans = AcademicPlan::where('year_level', $year_level)
            ->where('semester', $semester)
            ->has('subject') // Ensures subject relationship actually exists
            ->with('subject')
            ->get();

        $subjects = $plans->map(function ($plan) {
            return [
                // Safe null checks
                'subject_id'   => $plan->subject?->id,
                'subject_code' => $plan->subject?->subject_code ?? $plan->subject?->code,
                'subject_name' => $plan->subject?->subject_name ?? $plan->subject?->name,
                'credit'       => $plan->subject?->credit ?? 0,
            ];
        })->filter(fn($subject) => !is_null($subject['subject_id']))->values(); // Remove null entries

        return response()->json($subjects);
    }
    public function addRegistration(Request $request)
    {
        $validatedData = $request->validate([
            'student_code'   => 'required|string',
            'academic_year'  => 'required',
            'specialization' => 'required|string',
            'year_level'     => 'required',
            'semester'       => 'required',
            'subject_ids'    => 'required|array|min:1',
            'reg_types'      => 'nullable|array',
        ]);

        // 1. Look up student by student_code / code
        $student = Student::where('student_code', $request->student_code)
            ->first();

        if (!$student) {
            return redirect()->back()->withErrors(['student_code' => 'Student ID / Code not found in records.']);
        }

        // 2. Insert records using $student->id
        DB::transaction(function () use ($request, $validatedData, $student) {
            foreach ($request->subject_ids as $subjectId) {
                $type = $request->reg_types[$subjectId] ?? 'Regular';

                Registration::create([
                    'student_id'     => $student->id,
                    'student_code'   => $validatedData['student_code'],
                    'academic_year_id'  => $validatedData['academic_year'],
                    'specialization' => $validatedData['specialization'],
                    'year_level'     => $validatedData['year_level'],
                    'semester'       => $validatedData['semester'],
                    'subject_id'     => $subjectId,
                    'type'       => $type,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Course registration saved successfully!');
    }
    public function deleteRegistration (Request $request, $id){
        $registration = Registration::findOrFail($id);
        $registration->delete();
    }
}
