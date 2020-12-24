<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matriculated;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Discipline;
use App\Models\DisciplineSchoolClass;
use App\Http\Requests\StandartDisciplineRequest;
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
        
        $matriculateds = DB::table("matriculateds")
        ->select(
            "matriculateds.matriculated_id", "matriculateds.matriculation_date", "matriculateds.school_year as matriculated_school_year", "matriculateds.call_number",
            "students.student_registration","users.name", "users.last_name", "school_classes.school_class_name",
            "school_classes.school_class_type", "school_classes.school_year as school_class_school_year", "disciplines.discipline_name"
        )
        ->join("students", "matriculateds.student_registration", "=", "students.student_registration")
        ->join("users", "students.user_id", "=", "users.user_id")
        ->join("school_classes", "matriculateds.school_class_id", "=", "school_classes.school_class_id")
        ->join("disciplines", "matriculateds.discipline_id", "=", "disciplines.discipline_id")
        ->where("matriculateds.deleted_at", "=", null)
        ->get();

        return response()->json([
            "error" => false,
            "response" => $matriculateds
        ], 200);

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

    public function matriculateInStandardDiscipline(StandartDisciplineRequest $request)  
    {

        $disciplineSchoolClasses = DisciplineSchoolClass::where("school_class_id", $request->school_class_id)
        ->get();

        foreach ($disciplineSchoolClasses as $data) {

            Matriculated::create([

                "matriculation_date" => $request->matriculation_date,
                "school_year" => $request->school_year,
                "situation" => $request->situation,
                "call_number" => $request->call_number,
                "student_registration" => $request->student_registration,
                "school_class_id" => $request->school_class_id,
                "discipline_id" => $data->discipline_id,
    
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $matriculated = Matriculated::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => $matriculated
        ], 200);

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
        ], 200);

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
        ], 200);

    }
}