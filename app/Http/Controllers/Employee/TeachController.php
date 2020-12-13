<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TeachRequest;
use App\Models\Teach;
use Illuminate\Support\Facades\DB;

class TeachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TeachRequest $request)
    {
        Teach::create([
            "start_date"    => $request->startDate,
            "end_date"      => $request->endDate,
            "discipline_id" => $request->disciplineId,
            "employee_id"   => $request->employeeId,
        ]);

        return response()->json([
            "error"         => false,
            "message"       => "Teach successfully created."
        ], 201);

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
    public function update(TeachRequest $request, $id)
    {
        $teach = Teach::findOrFail($id);

        $teach->update([
            "start_date"    => $request->startDate,
            "end_date"      => $request->endDate,
            "discipline_id" => $request->disciplineId,
            "employee_id"   => $request->employeeId,
        ]);

        return response()->json([
            "error"         => false,
            "message"       => "Teach successfully created."
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
        $teach = Teach::findOrFail($id);

        $teach->delete();

        return response()->json([
            "error"         => false,
            "message"       => "Teach successfully deleted."
        ]);
    }
}
