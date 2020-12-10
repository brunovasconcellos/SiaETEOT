<?php

namespace App\Http\Controllers\Course;

use App\SchoolClass;
use App\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function validator(Request $request) {

        return Validator::make($request->all(), [

            "schoolClassName" => ["required", "max:255"],
            "schoolClassType" => ["required", "max:255"],
            "schoolYear" => ["required", "size:4"],
            "situation" => ["required", "max:255"],
            "shift" => ["required", "size:4"],
            "startDate" => ["required", "date"],
            "endDate" => ["required", "date"],
            "modality" => ["required", "max:255"],
            "course" => ["required", "max:255"]

        ]);

     }

    public function index(Request $request)
    {
        
        $schoolClasses = DB::table("school_classes")
        ->select(
            "school_classes.school_class_id as id", "school_classes.school_class_name", "school_classes.school_class_type", "school_classes.school_year",
            "school_classes.situation", "school_classes.shift", "courses.course_name"
            )
        ->join("courses", "school_classes.course_id", "=", "courses.course_id")
        ->where("school_classes.deleted_at", "=", null)
        ->get();


        if ($request->ajax())
        {

          return DataTables()->of($schoolClasses)->make(true);

        }
        

        return view("schoolclass");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function select2Data()
     {
        
        $schoolClasses = DB::table("school_classes")
        ->select("school_classes.school_class_id as id", "school_classes.school_class_name as name")
        ->get();

        $schoolClassesFormated = [];

        foreach ($schoolClasses as $schoolClass) {

            $schoolClasses = ["id" => $schoolClasses->id, "name" => $schoolClass->name];

            return response()->json($schoolClasses);

        }

     }

    public function store(Request $request)
    {

        Course::findOrFail($request->course);
        
        $error = $this->validator($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        SchoolClass::create([
            "school_class_name" => $request->schoolClassName,
            "school_class_type" => $request->schoolClassType,
            "school_year" => $request->schoolYear,
            "situation" => $request->situation,
            "shift" => $request->shift,
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "modality" => $request->modality,
            "course_id" => $request->course,
        ]);

        return response()->json([
            "error" => false,
            "message" => "School class successfully created."
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
        
        SchoolClass::findOrFail($id);

        $schoolClass = DB::table("school_classes")
        ->select(
            "school_classes.school_class_id", "school_classes.school_class_name", "school_classes.school_class_type", "school_classes.school_year",
            "school_classes.situation", "school_classes.shift", "school_classes.start_date", "school_classes.end_date",
            "school_classes.modality", "courses.course_name", "courses.course_workload"
            )
        ->join("courses", "school_classes.course_id", "=", "courses.course_id")
        ->where("school_classes.school_class_id", "=", $id)
        ->where("school_classes.deleted_at", "=", null)
        ->get();

        return response()->json([
            "error" => false,
            "response" => $schoolClass
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

        $schoolClass = SchoolClass::findOrFail($id);

        Course::findOrFail($request->course);

        $error = $this->validator($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        $schoolClass->update([
            "school_class_name" => $request->schoolClassName,
            "school_class_type" => $request->schoolClassType,
            "school_year" => $request->schoolYear,
            "situation" => $request->situation,
            "shift" => $request->shift,
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "modality" => $request->modality,
            "course_id" => $request->course
        ]);

        return response()->json([
            "error" => false,
            "message" => "School class successfully updated."
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
        $schoolClass = SchoolClass::findOrFail($id)->delete();
        
        return response()->json([
            "error" => false,
            "School Class successfully deleted."
        ]);

    }
}
