<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Matriculated;
use App\Student;
use App\SchoolClass;
use App\Discipline;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MatriculatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function validation(Request $request) {

        return Validator::make($request->all(), [

            "matriculationDate" => ["required", "date"],
            "schoolYear" => ["required", "string"],
            "situation"  => ["required", "string"],
            "callNumber" => ["required", "numeric", "integer"],
            "studentRegistration" => ["required", "numeric", "integer"],
            "schoolClassId" => ["required", "numeric", "integer"],
            "disciplineId" => ["required", "numeric", "integer"]

        ]);

     }

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
        ->paginate(5);

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
    public function store(Request $request)
    {
        
        Student::findOrFail($request->studentRegistration);

        SchoolClass::findOrFail($request->schoolClassId);

        Discipline::findOrFail($request->disciplineId);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        Matriculated::create([
        
            "matriculation_date" => $request->matriculationDate,
            "school_year" => $request->schoolYear,
            "situation" => $request->situation,
            "call_number" => $request->callNumber,
            "student_registration" => $request->studentRegistration,
            "school_class_id" => $request->schoolClassId,
            "discipline_id" => $request->disciplineId

        ]);

        return response()->json([
            "error" => false,
            "message" => "Matriculated successfully created."
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
        
        Matriculated::findOrFail($id);

        $matriculated = DB::table("matriculateds")
        ->select(
            "matriculateds.matriculated_id", "matriculateds.matriculation_date", "matriculateds.school_year as matriculated_school_year", "matriculateds.call_number",
            "matriculateds.situation", "students.student_registration", "users.name", "users.last_name",
            "school_classes.school_class_name", "school_classes.school_class_type", "school_classes.school_year as school_class_school_year", "disciplines.discipline_name"
        )
        ->join("students", "matriculateds.student_registration", "=", "students.student_registration")
        ->join("school_classes", "matriculateds.school_class_id", "=", "school_classes.school_class_id")
        ->join("disciplines", "matriculateds.discipline_id", "=", "disciplines.discipline_id")
        ->join("users", "students.user_id", "=", "users.user_id")
        ->where("matriculateds.matriculated_id", "=", $id)
        ->where("matriculateds.deleted_at", "=", null)
        ->get();

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
    public function update(Request $request, $id)
    {
        $matriculated = Matriculated::findOrFail($id);

        Student::findOrFail($request->studentRegistration);

        SchoolClass::findOrFail($request->schoolClassId);

        Discipline::findOrFail($request->disciplineId);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        $matriculated->update([
        
        "matriculation_date" => $request->matriculationDate,
        "school_year" => $request->schoolYear,
        "situation" => $request->situation,
        "call_number" => $request->callNumber,
        "student_registration" => $request->studentRegistration,
        "school_class_id" => $request->schoolClassId,
        "discipline_id" => $request->disciplineId

        ]);

        return response()->json([
            "error" => false,
            "message" => "Matriculated successfully updated.",
            $matriculated->school_year
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
