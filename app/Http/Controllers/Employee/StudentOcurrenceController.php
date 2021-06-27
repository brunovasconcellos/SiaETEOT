<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentOcurrenceRequest;
use App\Models\StudentOcurrence;
use Yajra\Datatables\Datatables;

class StudentOcurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ocurrences = StudentOcurrence::all();
        return Datatables()->of($ocurrences)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentOcurrenceRequest $request)
    {
        StudentOcurrence::create([
            "employee_id" => $request->employee_id,
            "student_registration" => $request->student_registration,
            "annotation" => $request->annotation
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "StudentOcurrence created",
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
    public function update(StudentOcurrenceRequest $request, $id)
    {
        $StudentOcurrence = StudentOcurrence::findOrFail($id);

        $StudentOcurrence->update([
            "employee_id" => $request->employee_id,
            "student_registration" => $request->student_registration,
            "annotation" => $request->annotation
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "StudentOcurrence updated."
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
        $StudentOcurrence = StudentOcurrence::findOrFail($id);

        $StudentOcurrence->delete();

        return response()->json([
            "error"             => true,
            "message"           => "StudentOcurrence successfully deleted"
        ]);
    }
}
