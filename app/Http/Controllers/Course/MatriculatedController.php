<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matriculated;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Discipline;
use App\Models\DisciplineSchoolClass;
use App\Http\Requests\StandardDisciplineRequest;
use App\Http\Requests\MatriculatedRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MatriculatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatriculatedRequest $request)
    {

        Matriculated::create([

            "matriculation_date" => $request->matriculation_date,
            "matriculation_type" => $request->matriculation_type,
            "school_year" => $request->school_year,
            "situation" => $request->situation,
            "call_number" => $request->call_number,
            "student_registration" => $request->student_registration,
            "school_class_id" => $request->school_class_id,
            "discipline_id" => $request->discipline_id

        ]);

        return response()->json([
            "error" => false,
            "message" => "Matriculated successfully created."
        ], 201);

    }

    public function matriculateInStandardDiscipline(StandardDisciplineRequest $request)  
    {

        $disciplineSchoolClasses = DisciplineSchoolClass::where("school_class_id", $request->school_class_id)
        ->get();

        foreach ($disciplineSchoolClasses as $data) {

            Matriculated::create([

                "matriculation_date" => $request->matriculation_date,
                "matriculation_type" => "Standard",
                "school_year" => $request->school_year,
                "situation" => $request->situation,
                "call_number" => $request->call_number,
                "student_registration" => $request->student_registration,
                "school_class_id" => $request->school_class_id,
                "discipline_id" => $data->discipline_id,
    
            ]);

        }

        return response()->json([
            "error" => false,
            "response" => "Student Successfully Matriculated."
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatriculatedRequest $request, $id)
    {
        $matriculated = Matriculated::findOrFail($id);

        $matriculated->update([
        
            "matriculation_date" => $request->matriculation_date,
            "school_year" => $request->school_year,
            "situation" => $request->situation,
            "call_number" => $request->call_number,
            "student_registration" => $request->student_registration,
            "school_class_id" => $request->school_class_id,
            "discipline_id" => $request->discipline_id

        ]);

        return response()->json([
            "error" => false,
            "message" => "Matriculated successfully updated.",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Matriculated::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Matriculated successfully deleted."
        ]);

    }
}