<?php

namespace App\Http\Controllers;

use App\StudentUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class StudentUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){

        return Validator::make($request->all(), [
            "suName" => ["required", "string", "max:255"],
            "suPhone" => ["required", "size:9"]
        ]);

    }
    
    public function index()
    {
        $studentUnit = DB::table('student_units')->select('su_id', 'su_name', 'su_phone')->where('deleted_at', null)->get();
    
        if(!Auth::user() || Auth::user()->level <= 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);

        }else if(!$studentUnit){
            return response()->json([
                "error" => false,
                "message" => "No Student Unit registred.",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $studentUnit
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

        StudentUnit::create([
            "su_name" => $request->suName,
            "su_phone" => $request->suPhone
        ]);

        return response()->json([
            "error" => false,
            "message" => "Student Unit is successfully created"
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
                "error"=> true,
                "message" => "Unauthorized"
            ], 401);
        }

        StudentUnit::findorFail($id);

        return response()->json([
            "error" => false,
            "response" => StudentUnit::where('su_id', $id)->select('su_name', 'su_phone')->get()
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
        $studentUnit = StudentUnit::findOrFail($id);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $studentUnit->update([
            "su_name" => $request->suName,
            "su_phone" => $request->suPhone
        ]);

        return response()->json([
            "error" => false,
            "message" => "Student Unit successfully updated."
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

        $studentUnit = StudentUnit::findOrFail($id);
        $studentUnit->delete();

        return response()->json([
            "error" => false,
            "message" => "Student Unit successfully deleted."
        ], 200);
    }
}
