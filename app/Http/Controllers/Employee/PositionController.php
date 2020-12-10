<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "positionName" => ["required", "string", "max:255"],
            "workload" => ["required", "size:4"],
            "type" => ["required", "string", "max:255"]
        ]);
    }

    public function index()
    {
        $position = DB::table('positions')
        ->select('position_id', 'position_name', 'workload', 'type')
        ->where('deleted_at', null)
        ->paginate(5);

        if(empty($position["data"] == false)){
            return response()->json([
                "error" => true,
                "message" => "No registered positions",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $position
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = $this->validator($request);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        Position::create([
            "position_name" => $request->positionName,
            "workload" => $request->workload,
            "type" => $request->type
        ]);

        return response()->json([
            "error" => false,
            "message" => "Position is successfully created"
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
        if(!Auth::user() || Auth::user()->level < 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);
        }

        Position::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => Position::where('position_id', $id)
            ->select('position_id', 'position_name', 'workload', 'type')->get()
        ], 200);
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
        $error = $this->validator($request);
        $position = Position::findOrFail($id);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $position->update([
            "position_name" => $request->positionName,
            "workload" => $request->workload,
            "type" => $request->type
        ]);

        return response()->json([
            "error" => false,
            "message" => "Position successfully updated"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user() || Auth::user()->level <= 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);
        }

        $position = Position::findOrFail($id);
        $position->delete();

        return response()->json([
            "error" => false,
            "message" => "Position successfully deleted"
        ], 200);
    }
}
