<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    //
    public function marks()
    {
        $marks = Mark::all();
        $results = DB::table('students as s')
            ->join('registrations as r', 's.id', '=', 'r.student_id')
            ->join('subjects as sub','sub.id','=','r.subject_id')
            ->join('academic_years as ay','r.academic_year_id','=','ay.id')
            ->join('marks as m', 'r.id', '=', 'm.registration_id')
        
            ->select(
                's.student_code',
                's.name',
                'r.year_level',
                'sub.subject_code',
                'ay.name as academic_year',
                'sub.subject_name as sub_name',
                'r.semester',
                'r.subject_id',
                'm.mark',
                'm.grade'
            )
            ->get();
        return view(
            'admin.mark.marks',
            compact('marks', 'results')
        );
    }

    public function addMarks(Request $request)
    {
        $validatedData = $request->validate([

            'registration_id' => 'required|integer|exists:registrations,id|unique:marks,registration_id',
            'mark'            => 'required|integer|min:0|max:100',
            'grade'           => 'required|string',
        ]);

        Mark::create($validatedData);

        return back()->with('success', 'Successfully added a mark record.');
    }


    public function editMarks(Request $request, $id)
    {
        $validatedData = $request->validate([
            'registration_id' => [
                'required',
                'integer',
                // 1. Must exist in registrations table
                'exists:registrations,id',
                // 2. Must be unique in marks table, BUT ignore this current mark record ID
                Rule::unique('marks', 'registration_id')->ignore($id),
            ],
            'mark' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],
            'grade' => [
                'required',
                'string',
            ],
        ]);
        $markRecord = Mark::findOrFail($id);
        $markRecord->update($validatedData);

        return back()->with('success', 'Mark record updated successfully!');
    }
    public function deleteMarks(Request $request, $id){
        $mark = Mark::findOrFail($id);
        $mark->delete();
    }
}
