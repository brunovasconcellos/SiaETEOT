<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        if ($request->ajax()){
        $position = DB::table('positions')
        ->select('position_id as id', 'position_name', 'workload', 'type')
        ->where('deleted_at', null)
        ->get();

    }

        return view('position');

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PositionRequest $request)
    {
        $request->validated();

        Position::create([
            "position_name" => $request->positionName,
            "workload"      => $request->workload,
            "type"          => $request->type
        ]);

        return response()->json([
            "error"         => false,
            "message"       => "Position is successfully created"
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
        $position = Position::findOrFail($id);

        return response()->json([
            "error"         => false,
            "message"       => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PositionRequest $request, $id)
    {
        $position = Position::findOrFail($id);

        $position->update([
            "position_name" => $request->positionName,
            "workload"      => $request->workload,
            "type"          => $request->type
        ]);

        return response()->json([
            "error"         => false,
            "message"       => "Position successfully updated"
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
        $position = Position::findOrFail($id);

        $position->delete();

        return response()->json([
            "error"         => false,
            "message"       => "Position successfully deleted"
        ]);
    }
}
