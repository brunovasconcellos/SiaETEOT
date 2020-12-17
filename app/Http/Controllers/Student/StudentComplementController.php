<?php

namespace App\Http\Controllers\Student;

use App\Models\StudentComplement;
use App\Models\Student;
use App\Http\Requests\StudentComplementRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentComplementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function store(StudentComplementRequest $request, $id)
    {

        $studentComplements = StudentComplement::create([
            
            "student_registration" => $id,
            "ingress_type" => $request->ingressType,
            "ingress_form" => $request->ingressForm,
            "last_school" => $request->lastSchool,
            "vagacy_type" => $request->vagacyType,
            "ident_educacenso" => $request->identEducacenso,
            "year_last_grade" => $request->yearLastGrade,

        ]);

        return [
            "error" => false,
            "message" => "Student complement successfully created."
        ];

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
    public function update(StudentComplementRequest $request, $id)
    {

        $studentComplement = StudentComplement::findOrFail($id);

        $studentComplement->update([
            "ingress_type" => $request->ingressType,
            "ingress_form" => $request->ingressForm,
            "last_school" => $request->lastSchool,
            "vagacy_type" => $request->vagacyType,
            "ident_educacenso" => $request->identEducacenso,
            "year_last_grade" => $request->yearLastGrade,
        ]);

            return [
                "error" => false,
                "message" => "Student complement successfully updated."
            ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        StudentComplement::findOrFail($id)->delete();

        return [
            "error" => false,
            "message" => "Student complement successfully deleted."
        ];

    }
    
}
