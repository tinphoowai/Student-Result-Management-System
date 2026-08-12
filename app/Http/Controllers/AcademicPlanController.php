<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicPlan;

class AcademicPlanController extends Controller
{
    //
    public function addAcademicPlan(Request $request)
    {
        $validateData = $request->validate([
            'year_level'=>'required|string',
            'semester'=>'required|string',
            'specialization'=>'required|string',
            'subject_id'=>'required|integer|unique:academic_plans,subject_id'
        ]);
        AcademicPlan::create($validateData);
        return back()->with('success','successfully assign a subject');
    }
}
