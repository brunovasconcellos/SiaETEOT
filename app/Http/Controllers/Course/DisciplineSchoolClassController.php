<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DisciplineSchoolClass;
use App\Models\Discipline;
use App\Models\SchoolClass;
use App\Http\Requests\DisciplineSchoolClassRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DisciplineSchoolClassController extends Controller
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
    public function store(DisciplineSchoolClassRequest $request)
    {

        DisciplineSchoolClass::create([
            "discipline_id" => $request->discipline_id,
            "school_class_id" => $request->school_class_id
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline School Class successfully."
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
    public function update(DisciplineSchoolClassRequest $request, $id)
    {

        $disciplineSchoolClass = DisciplineSchoolClass::findOrFail($id);

        $disciplineSchoolClass->update([
            "discipline_id" => $request->discipline_id,
            "school_class_id" => $request->school_class_id
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline School Class successfully."
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

        DisciplineSchoolClass::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Discipline school class delete."
        ]);

    }
}
