<?php

namespace App\Http\Controllers\Employee;

use App\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            
        ]);
    }

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
    public function store(Request $request)
    {
        $error = $this->validator($request);

        $user = new UserController;

        if ($error->fails){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }
        
        $userId = $user->store($request);

        if($userId["error"]){
            return response()->json([
                "error" => $userId["error"],
                "message" => $userId["message"]
            ], 400);
        }

        Employee::create([
            "user_id" => $userId,
            "sector_id" =>  //Fazer o setor 
        ]);

        return response()->json([
            "error" => false,
            "message" => "Employee is successfuly created"
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