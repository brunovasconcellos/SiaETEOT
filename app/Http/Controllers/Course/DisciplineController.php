<?php

namespace App\Http\Controllers\Course;

use App\Discipline;
use App\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function validation(Request $request) {

        return Validator::make($request->all(), [
            
            "disciplineName" => ["required", "string", "max:255"],
            "disciplineAbbreviation" => ["required", "string", "max:255"],
            "courseId" => ["required", "max:255"]

        ]);

     }

    public function index()
    {
        
        $disciplines = DB::table("disciplines")
        ->select("disciplines.discipline_id", "disciplines.discipline_name", "disciplines.discipline_abbreviation", "courses.course_name")
        ->join("courses", "disciplines.course_id", "=", "courses.course_id")
        ->where("disciplines.deleted_at", "=", null)
        ->paginate(5);


        if (empty($disciplines["data"] == false)) {

            return response()->json([
                "error" => false,
                "message" => "no registered discipline.",
                "response" => null
            ]);

        }

        return response()->json([
            "error" => false,
            "response" => $disciplines
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

        Course::findOrFail($request->courseId);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        Discipline::create([
            "discipline_name" => $request->disciplineName,
            "discipline_abbreviation" => $request->disciplineAbbreviation,
            "course_id" => $request->courseId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline successfully created."
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

        Discipline::findOrFail($id);

        $discipline = DB::table("disciplines")
        ->select(
            "disciplines.discipline_id", "disciplines.discipline_name", "disciplines.discipline_abbreviation", "courses.course_name",
            "courses.course_workload"
            )
        ->join("courses", "disciplines.course_id", "=", "courses.course_id")
        ->where("disciplines.discipline_id", "=", $id)
        ->where("disciplines.deleted_at", "=", null)
        ->get();

        return response()->json([
            "error" => false,
            "response" => $discipline
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
        
        Course::findOrFail($request->courseId);

        $discipline = Discipline::findOrFail($id);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        $discipline->update([
            "discipline_name" => $request->disciplineName,
            "discipline_abbreviation" => $request->disciplineAbbreviation,
            "course_id" => $request->courseId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline successfully updated."
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
        
        Discipline::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "Discipline successfully deleted."
        ]);
        
    }
}
