<?php

namespace App\Http\Controllers\Course;

use App\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validator(Request $request){

        return Validator::make($request->all(), [

            'courseName' => ['required', 'string', 'max:255'],
            'courseWorkload' => ['required', 'string', 'size:4']

            ]);

    }

    public function index(Request $request)
    {
        $course = DB::table('courses')
        ->select('course_id as id', 'course_name', 'course_workload')
        ->where('deleted_at', null)
        ->get();

        if ($request->ajax()) // This is what i am needing.
        {
          return DataTables()->of($course)->make(true);
        }
        
        return view("lte");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = $this->validator($request);


        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

    }

    Course::create([

        "course_name" => $request->courseName,
        "course_workload" => $request->courseWorkload

    ]);

    return response()->json([
        "error" => false,
        "message" => "Course Created"
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
        Course::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => Course::where('course_id', $id)->select('course_id as id','course_name', 'course_workload')->get()
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

        $course = Course::findOrFail($id);

        $error = $this->validator($request);

        if ($error->fails()) {

            return response()->json([

                "error" => true,
                "message" => $error->errors()->all()

            ], 400);

        }

        $course->update([
            "course_name" => $request->courseName,
            "course_workload" => $request->courseWorkload
        ]);


        return response()->json([
            "error" => false,
            "message" => "Course successfully updated."
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
        $course = Course::findOrFail($id)->delete();

            return response()->json([
                "error" => false,
                "message" => "Course successfully deleted."
            ],200);

    }

}