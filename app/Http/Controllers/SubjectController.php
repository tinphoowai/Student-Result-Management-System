<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\AcademicPlan;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    //

    public function subjects()
    {
        $subjects = Subject::all();
        $academic_plans = AcademicPlan::with('subject')
            ->get()
            ->groupBy(['year_level', 'specialization', 'semester']);


        return view(
            'admin.subject.subjects',
            compact('subjects', 'academic_plans')
        );
    }

    public function academicPlan(Request $request)
    {
        $academic_plans = AcademicPlan::with('subject')

            ->when($request->year_level, function ($query, $year) {

                $query->where('year_level', $year);
            })

            ->when($request->specialization, function ($query, $specialization) {

                $query->where('specialization', $specialization);
            })

            ->when($request->semester, function ($query, $semester) {

                $query->where('semester', $semester);
            })

            ->get()

            ->groupBy([
                'year_level',
                'specialization',
                'semester'
            ]);
        return view('admin.subject.academic-plan', compact('academic_plans'));
    }

    public function addSubjects(Request $request)
    {
        $validateData = $request->validate([
            'subject_code' => 'required|string|unique:subjects,subject_code',
            'subject_name' => 'required|string',
            'credit' => 'required|integer',
        ]);

        Subject::create($validateData);
        return redirect()->back()->with('success', 'successfully added a subject');
    }
    public function editSubjects(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $validateData = $request->validate([
            'subject_code' => [
                'required',
                'string',
                Rule::unique('subjects', 'subject_code')->ignore($subject->id)
            ],
            'subject_name' => [
                'required',
                'string'
            ],
            'credit' => [
                'required',
                'integer'
            ],
        ]);
        $subject->update([
            'subject_code' => $validateData['subject_code'],
            'subject_name' => $validateData['subject_name'],
            'credit' => $validateData['credit'],
        ]);
        return back()->with('success', 'successfully edited.');
    }

    public function deleteSubjects(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return back()->with('success', 'successfully deleted a subject');
    }
}
