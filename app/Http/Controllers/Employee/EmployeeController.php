<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\User;
use App\Locality;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){

        return Validator::make($request->all(), [
            "sectorId" => ["required", "numeric"]
        ]);

    }

    public function index()
    {
        
        $employees = DB::table('employees')->join("users", "employees.user_id", "=", "users.user_id")->get();

        if (!Auth::user() || Auth::user()->level <= 7) {

            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);

        }elseif (!$employees) {

            return response()->json([
                "error" => false,
                "message" => "No students registred.",
                "response" => null
            ]);

        }

        return response()->json([
            "error" => false,
            "response" => $employees
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

        $user = new UserController;

        $userId = $user->store($request);

        if ($error->fails() && $userId["error"] == false) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }elseif ($userId["error"] == true && count($error->errors()) == 0) {

            return response()->json([
                "error" => $userId["error"],
                "message" => $userId["message"]
            ], 400);

        }elseif ($userId["error"] == true && $error->fails()) {

            return response()->json([
                "error" => true,
                "message" => [$userId["message"], $error->errors()->all()]
            ], 400);

        }

        Employee::create([

            "user_id" => $userId["userId"],
            "sector_id" => $request->sectorId

        ]);

        return response()->json([

            "error" => false,
            "message" => ["Employee Created"]

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
        
        $employee = Employee::findOrFail($id);

        $error = $this->validator($request);

        $user = new UserController();

        $userId = $user->update($request, $employee->user_id);

        
        if ($error->fails()) {

            return response()->json([

                "error" => true,
                "message" => $error->errors()->all()

            ], 400);

        }elseif (!$employee) {

            return response()->json([
                
                "error" => true,
                "message" => ["Employe not exist"]

            ], 400);

        }elseif ($userId["error"] == true) {

            return response()->json([
                
                "error" => true,
                "message" => $userId["message"]
    
            ], 400);
    
        }elseif ($error->fails() && $userId["error"]) {
    
            return response()->json([
                
                "error" => true,
                "message" => [$error->errors()->all(), $userId["message"]]
    
            ], 400);
    
        }

        $employee->user_id = $userId["userId"];
        $employee->sector_id = $request->sectorId;

        return response()->json([

            "error" => false,
            "message" => ["Employee updated"]

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
        
        $employee = Employee::findOrFail($id);

        $user = new UserController;

        $userId = $employee->user_id;

        if (isset($employee)) {

            $employee->delete();

            $user->destroy($userId);

            return response()->json([
                "error" => false,
                "message" => ["Employee deleted"]
            ],200);

        }

        return response()->json([
            "error" => true,
            "message" => ["Error when deleting employee"]
        ], 400);


    }
}
