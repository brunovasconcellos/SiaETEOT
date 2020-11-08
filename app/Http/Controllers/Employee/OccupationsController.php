<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OccupationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "occupationName" => ["required", "string", "max:255"]
        ]);
    }

    public function index()
    {
        $occupation = DB::table('occupations')
        ->select('occupation_id', 'occupation_name')
        ->where('deleted_at', null)
        ->paginate(5);

        if(empty($occupation["data"] == false)){
            return response()->json([
                "error" => true,
                "message" => "no registered occupations",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $occupation
        ], 200);
    }

    public function select2Data () 
    {

        $occupations = DB::table('occupations')
        ->select('occupation_id', 'occupation_name')
        ->where('deleted_at', null)
        ->get();

        $occupationsFormated = [];

        foreach ($occupations as $occupation) {

            $occupationsFormated[] = ["id" => $occupation->occupation_id, "text" => $occupation->occupation_name];

        }

        return response()->json($occupationsFormated);

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

        Occupation::create([
            "occupation_name" => $request->occupationName
        ]);

        return response()->json([
            "error" => false,
            "message" => "Occupation Unit is successfully created"
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

        Occupation::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => Occupation::where('occupation_id', $id)
            ->select('occupation_id', 'occupation_name')
            ->get()
        ]);
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
        $occupation = Occupation::findOrFail($id);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $occupation->update([
            "occupation_name" => $request->occupationName
        ]);

        return response()->json([
            "error" => false,
            "message" => "Occupation successfully updated"
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
        if(!Auth::user() || Auth::user()->level <= 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);
        }

        $occupation = Occupation::findOrFail($id);
        $occupation->delete();

        return response()->json([
            "error" => false,
            "message" => "Occupation successfully deleted"
        ], 200);
    }
}
