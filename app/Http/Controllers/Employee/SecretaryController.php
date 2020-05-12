<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class SecretaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::all();

        if ($students) {

            return response()->toJson(["students" => $students], 200);

        }

        return  response()->toJson(["response" => "Requisition error"], 400);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $student = new Student();

        $student->father_name = $request->fatherName;
        $student->mather_name = $request->matherName;
        $student->student_type = $request->studentType;
        $student->actual_situation = $request->actualSituation;
        $student->num_residence_student = $request->numResidStudent;
        $student->complement_students = $request->complementStudent;
        $student->user_id = $request->userId;

        $student->save();


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
