<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OccupationEmployee;
use App\Http\Requests\OccupationEmployeeRequest;

class OccupationEmployeeController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($id, OccupationEmployeeRequest $request)
    {
        OccupationEmployee::create([
            "start_date"        => $request->startDate,
            "final_date"        => $request->finalDate,
            "employee_id"       => $id,
            "occupation_id"     => $request->occupationId
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "OccupationEmployee created",
        ]);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OccupationEmployeeRequest $request, $id)
    {
        $OccupationEmployee = OccupationEmployee::findOrFail($id);

        $OccupationEmployee->update([
            "start_date"        => new DateTime($request->startDate),
            "final_date"        => new DateTime($request->finalDate),
            "employee_id"       => $request->employeeId,
            "occupation_id"     => $request->occupationId

        ]);

        return response()->json([
            "error"             => false,
            "message"           => "OccupationEmployee updated."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $occupation = OccupationEmployee::findOrFail($id);

        $occupation->delete();

        return response()->json([
            "error"             => true,
            "message"           => "OccupationEmployee successfully deleted"
        ]);
    }
}
