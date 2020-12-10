<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CourseDiscipline;
use App\Models\Course;use App\Discipline;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CourseDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation(Request $request) {

        return Validator::make($request->all(), [

            "courseId" => ["required", "integer"],
            "disciplineId" => ["required", "integer"]

        ]);

    }

    public function index()
    {
        
        $courseDisciplines = DB::table("course_disciplines")
        ->select(
            "course_disciplines.course_discipline_id", "course_disciplines.course_id", "course_disciplines.discipline_id", 'course_name',
            'course_workload', "disciplines.discipline_name", "disciplines.discipline_abbreviation"
            )
        ->join("courses", "course_disciplines.course_id", "=", "courses.course_id")
        ->join("disciplines", "course_disciplines.discipline_id", "=", "disciplines.discipline_id")
        ->where("course_disciplines.deleted_at", "=", null)
        ->paginate(5);

        return response()->json([
            "error" => false,
            "response" => $courseDisciplines
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

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()-json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
            
        }

        CourseDiscipline::create([
            "course_id" => $request->courseId,
            "discipline_id" => $request->disciplineId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Course discipline successfully created."
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

        CourseDiscipline::findOrFail($id);
        
        $courseDiscipline = DB::table("course_disciplines")
        ->select(
            "course_disciplines.course_discipline_id", "course_disciplines.course_id", "course_disciplines.discipline_id", 'course_name',
            'course_workload', "disciplines.discipline_name", "disciplines.discipline_abbreviation"
        )
        ->join("courses", "course_disciplines.course_id", "=", "courses.course_id")
        ->join("disciplines", "course_disciplines.discipline_id", "=", "disciplines.discipline_id")
        ->where("course_disciplines.course_discipline_id", "=", $id)
        ->get();

        return response()->json([
            "error" => false,
            "response" => $courseDiscipline
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

        $courseDiscipline = CourseDiscipline::findOrFail($id);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()-json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
            
        }

        $courseDiscipline->update([
            "course_id" => $request->courseId,
            "discipline_id" => $request->disciplineId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Course discipline successfully created."
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
        
        CourseDiscipline::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Curse discipline successfully deleted."

        ], 200);
        
    }
}
