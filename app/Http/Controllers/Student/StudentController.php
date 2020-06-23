<?php

namespace App\Http\Controllers\Student;

use App\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Student\StudentComplementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        }

        if (!$students) {

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

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
                ], 400);

        }

        $userId = $user->store($request);

        if ($userId["error"] == true) {

            return response()->json([
                "error" => $userId["error"],
                "message" => $userId["message"]
            ], 400);

        }

        //generate student registration

        $fixedNumber = date("y");

        if ($request->half == 1) {

            $fixedNumber .= 10;

        }

        if ($request->half == 2) {

            $fixedNumber .= 20;

        }

        if ($request->modality == "integral") {

            $fixedNumber .= 14;

        }

        if ($request->modality == "subsequently") {

            $fixedNumber .= 15;

        }

        switch($request->course) {

            case "computing":
                $fixedNumber .= 44;
                break;
        
            case "health management":
                $fixedNumber .= 39;
                break;

            case "administration":
                $fixedNumber .= 01;
                break;

            case "clinical analysis":
                $fixedNumber .= 04;
                break;

            default:
                return response()->json([
                    "error" => true,
                    "message" => "Course not exist."

                ], 400);

        }

        $lastRegistration = DB::table("students")->select("student_registration")->orderByDesc("created_at")->first();

        $lastRegistration != null ? $registrationYear = Str::substr((string) $lastRegistration->student_registration, -12, 2) : $registrationYear = null; 

        if ($registrationYear == date("y")) {

            $registrationNumber = Str::substr((string) $lastRegistration->student_registration , 8, 4) + 1;

            $sequentialNumber = str_pad($registrationNumber, 4, 0, STR_PAD_LEFT);

        }

        if ($registrationYear != date("y") || !$registrationYear) {

            $sequentialNumber = str_pad(1, 4, 0, STR_PAD_LEFT);

        }

        $studentRegistration = $fixedNumber.$sequentialNumber;

        //end generate student registration

        Student::create([
            "student_registration" => $studentRegistration,
            "father_name" => $request->fatherName,
            "mather_name" => $request->matherName,
            "student_type" => $request->studentType,
            "actual_situation" => $request->actualSituation,
            "user_id" => $userId["userId"]
        ]);

        return response()->json([
            "error" => false,
            "message" => "Student is successfully created."
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

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        $userId = $user->update($request, $student->user_id);

        if ($userId["error"] == true) {

            return response()->json([
                "error" => true,
                "message" =>$userId["message"]
            ], 400);

        }

        $student->update([
            "student_registration" => $request->studentRegistration,
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
