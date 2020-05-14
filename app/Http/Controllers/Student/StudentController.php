<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        //
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

        Student::create([

            "father_name" => $request->fatherName,
            "mather_name" => $request->matherName,
            "student_type" => $request->studentType,
            "actual_situation" => $request->actualSituation,
            "user_id" => $userId
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
