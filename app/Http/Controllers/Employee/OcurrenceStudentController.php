<?php

namespace App\Http\Controllers\Employee;

use App\Http\Requests\OcurrenceStudentRequest;
use App\Http\Controllers\Controller;
use App\Models\OcurrenceStudent;
use Illuminate\Http\Request;

class OcurrenceStudentController extends Controller
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
    public function store(OcurrenceStudentRequest $request)
    {
        OcurrenceStudent::create([
            "providence" => $request->providence,
            "report" => $request->report,
            "details" => $request->details,
            "type" => $request->type,
            "fact_date" => $request->factDate,
            "fact" => $request->fact,
            "ocurrence_id" => $request->ocurrenceId,
            "employee_id" => $request->employeeId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Ocurrence successfully created."
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
