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
    public function store(StudentComplementRequest $request)
    {

        $studentComplements = StudentComplement::create([
            "student_registration" => $request->student_registration,
            "ingress_type" => $request->ingress_type,
            "ingress_form" => $request->ingress_form,
            "last_school" => $request->last_school,
            "vagacy_type" => $request->vagacy_type,
            "ident_educacenso" => $request->ident_educacenso,
            "year_last_grade" => $request->year_last_grade,
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
            "ingress_type" => $request->ingress_type,
            "ingress_form" => $request->ingress_form,
            "last_school" => $request->last_school,
            "vagacy_type" => $request->vagacy_type,
            "ident_educacenso" => $request->ident_educacenso,
            "year_last_grade" => $request->year_last_grade,
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
