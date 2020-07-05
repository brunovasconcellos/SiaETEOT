<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DisciplineSchoolClass;
use App\Discipline;
use App\SchoolClass;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DisciplineSchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation (Request $request) {

        return Validator::make($request->all(), [

            "disciplineId" => ["required", "integer"],
            "schoolClassId" => ["required", "integer"]

        ]);

     }

    public function index()
    {
        
        $disciplineSchoolClasses = DB::table("discipline_school_classes")
        ->select(
            "discipline_school_classes.discipline_schoolClass_id", "school_classes.school_class_name", "school_classes.school_class_type", "disciplines.discipline_name",
            "courses.course_name", 
        )
        ->join("disciplines", "discipline_school_classes.discipline_id", "=", "disciplines.discipline_id")
        ->join("school_classes", "discipline_school_classes.school_class_id", "=", "school_classes.school_class_id")
        ->join("courses", "school_classes.course_id", "=", "courses.course_id")
        ->where("discipline_school_classes.deleted_at", "=", null)
        ->paginate(5);

        return response()->json([
            "error" => false,
            "message" => $disciplineSchoolClasses
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Discipline::findOrFail($request->disciplineId);
        
        SchoolClass::findOrFail($request->schoolClassId);
        
        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        DisciplineSchoolClass::create([
            "discipline_id" => $request->disciplineId,
            "school_class_id" => $request->schoolClassId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline School Class successfully."
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $disciplineSchoolClasses = DB::table("discipline_school_classes")
        ->select(
            "discipline_school_classes.discipline_schoolClass_id", "school_classes.school_class_name", "school_classes.school_class_type", "school_classes.school_year",
            "school_classes.situation", "school_classes.shift", "school_classes.start_date", "school_classes.end_date",
            "school_classes.modality", "courses.course_name", "courses.course_workload", "disciplines.discipline_id",
            "disciplines.discipline_name", "disciplines.discipline_abbreviation"
        )
        ->join("disciplines", "discipline_school_classes.discipline_id", "=", "disciplines.discipline_id")
        ->join("school_classes", "discipline_school_classes.school_class_id", "=", "school_classes.school_class_id")
        ->join("courses", "school_classes.course_id", "=", "courses.course_id")
        ->where("discipline_school_classes.deleted_at", "=", null)
        ->paginate(5);

        return response()->json([
            "error" => false,
            "message" => $disciplineSchoolClasses
        ]);

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

        $disciplineSchoolClass = DisciplineSchoolClass::findOrFail($id);

        Discipline::findOrFail($request->disciplineId);
        
        SchoolClass::findOrFail($request->schoolClassId);
        
        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        $disciplineSchoolClass->update([
            "discipline_id" => $request->disciplineId,
            "school_class_id" => $request->schoolClassId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline School Class successfully."
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

        DisciplineSchoolClass::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Discipline school class delete."
        ]);

    }
}
