<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\AbleRequest;
use App\Models\Able;

class AbleController extends Controller
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
    public function store(AbleRequest $request)
    {
        Able::create([
            "school_year"       => $request->schoolYear,
            "employee_id"       => $request->employeeId,
            "discipline_id"     => $request->disciplineId
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "Able successfully created"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
    public function update(AbleRequest $request, $id)
    {
        $able = Able::findOrFail($id);

        $able->update([
            "school_year"       => $request->schoolYear,
            "employee_id"       => $request->employeeId,
            "discipline_id"     => $request->disciplineId
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "Able successfully updated"
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
        $able = Able::findOrFail($id);

        $able->delete();

        return response()->json([
            "error"             => false,
            "message"           => "Able successfully deleted"
        ]);
    }
}
