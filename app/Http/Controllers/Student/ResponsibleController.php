<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Responsible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "userId" => ["required", "numeric"]
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

        $user = new UserController();

        $userId = $user->store($request);

        if($error->fails()){
            return response()->json([
            "error" => true,
            "message" => $error->errors()->all()
            ], 400);

        }
        else if($userId["error"]){
            return response()->json([
            "error" => $userId["error"],
            "message" => $userId["message"]
        ], 400);
        }
        elseif ($userId["error"] && $error->fails()) {

            return response()->json([
                "error" => true,
                "message" => [$userId["message"], $error->errors()->message()]
            ], 400);

        }

        Responsible::create([
            "user_id" => $userId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Responsável foi criado com sucesso"
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
