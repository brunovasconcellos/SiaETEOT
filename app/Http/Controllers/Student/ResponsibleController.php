<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Responsible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $responsible = DB::table('responsibles')->join("users", "responsibles.user_id", "=", "users.user_id")->get();

        if(!Auth::user() || Auth::user()->level <= 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);

        }else if(!$responsible){
            return response()->json([
                "error" => false,
                "message" => "No responsible registred.",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $responsible
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
            "user_id" => $userId["userId"]
        ]);

        return response()->json([
            "error" => false,
            "message" => "Student is successfully created"
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
        if(!Auth::user() || Auth::user()->level > 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);
        }
        
        return response()->json([
            "error" => false,
            "response" => Responsible::where('responsible_id', $id)->join("users", "responsibles.user_id", "=", "users.user_id")->get()
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

        $responsible = Responsible::findOrFail($id);

        $user = new UserController();

        $userId = $user->update($request, $responsible->user_id);

        if ($error->fails()) {
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }
        elseif ($userId["error"] == true) {
            return response()->json([
                "error" => true,
                "message" =>$userId["message"]
            ], 400);

        }

        $responsible->update([
            "user_id" => $request->userId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Responsible successfully updated."
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

        $user = new UserController();
        $responsible = Responsible::findorFail($id);
        $responsibleId = $responsible->user_id;

        $responsible->delete();
        $user->destroy($responsibleId);

        return response()->json([
            "error" => false,
            "message" => "Responsible successfully deleted."
        ], 200);
    }
}
