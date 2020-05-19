<?php

namespace App\Http\Controllers\Employee;

use App\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "sectorId" => ["required", "numeric", "lte:8", "gt:0"]
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

        $userId = $user->store($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }elseif ($userId["error"] == true) {

            return response()->json([
                "error" => $userId["error"],
                "message" => $userId["message"]
            ]);

        }elseif ($userId["error"] == true && $error->fails()) {

            return response()->json([
                "error" => true,
                "message" => [$userId["message"], $error->errors()->message()]
            ]);

        }

        Employee::create([

            "user_id" => $userId,
            "sector_id" => $request->sectorId

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
