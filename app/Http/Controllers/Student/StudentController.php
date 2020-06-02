<?php

namespace App\Http\Controllers\Student;

use App\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validator (Request $request) {

        return  Validator::make($request->all(), [

            "fatherName" => ["required", "string", "max:255"],
            "matherName" => ["required", "string", "max:255"],
            "studentType" => ["required", "string", "max:255"],
            "actualSituation" => ["required", "string", "max:255"],

        ]);

    }

    public function index()
    {
        
        $students = DB::table('students')->join("users", "students.user_id", "=", "users.user_id")->get();

        if (!Auth::user() || Auth::user()->level <= 7) {

            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);

        }elseif (!$students) {

            return response()->json([
                "error" => false,
                "message" => "No students registred.",
                "response" => null
            ]);

        }

        return response()->json([
            "error" => false,
            "response" => $students
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

        $error = $this->validator($request);

        $user = new UserController();

        $userId = $user->store($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
                ], 400);

        }elseif ($userId["error"] == true) {

            return response()->json([
                "error" => $userId["error"],
                "message" => $userId["message"]

            ], 400);

        }

        Student::create([

            "father_name" => $request->fatherName,
            "mather_name" => $request->matherName,
            "student_type" => $request->studentType,
            "actual_situation" => $request->actualSituation,
            "user_id" => $userId["userId"]
        ]);

        return response()->json([
            "error" => false,
            "message" => "Student is successfully created"
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
    public function update(Request $request, $id)
    {
        
        $error = $this->validator($request);

        $student = Student::findOrFail($id);

        $user = new UserController();

        $userId = $user->update($request, $student->user_id);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }elseif ($userId["error"] == true) {

            return response()->json([
                "error" => true,
                "message" =>$userId["message"]
            ], 400);

        }

        $student->update([
            "father_name" => $request->fatherName,
            "mather_name" => $request->matherName,
            "student_type" => $request->studentType,
            "actual_situation" => $request->actualSituation,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Student successfully updated."
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
        
        if (!Auth::user() || Auth::user()->level <= 7) {

            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);

        }

        $student = Student::findOrFail($id);

        $studentId = $student->user_id;

        $student->delete();

        $user = new UserController();

        $user->destroy($studentId);
        
        return response()->json([
            "error" => false,
            "message" => "Student successfully deleted."
        ], 200);

    }
}
