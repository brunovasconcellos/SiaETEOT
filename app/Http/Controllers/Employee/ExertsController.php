<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee;
use App\Models\Exerts;
use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation(Request $request){
        
        return Validator::make($request->all(), [
            "registration" => ["required", "string", "max:255"], //sera gerado internamente assim como a matricula do aluno
            "positionId" => ["required", "numeric"]
        ]);

    }

    public function index()
    {
        $exerts = DB::table('exerts')->join("positions", "exerts.position_id", "=", "positions.position_id")
        ->join("employees", "exerts.employee_id", "=", "employees.employee_id")
        ->where('exerts.deleted_at', null)
        ->select('exerts.exerts_id', 'exerts.registration', 'exerts.employee_id', 'exerts.position_id', 'positions.position_name', 'positions.workload', 'positions.type', 'employees.sector_id')
        ->paginate(5);

        return response()->json([
            "error" => false,
            "response" => $exerts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $employeeId)
    {
        Employee::findOrFail($employeeId);

        Exerts::create([
            "registration" => $request->registration,
            "employee_id" => $employeeId,
            "position_id" => $request->positionId
        ]);

        return response()->json([
            "error" =>false,
            "message" => "Exerts successfuly created"
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

        Exerts::findOrFail($id);

        $exert = Exerts::where('exerts_id', $id)
        ->join("positions", "exerts.position_id", "=", "positions.position_id")
        ->join("employees", "exerts.employee_id", "=", "employees.employee_id")
        ->select('exerts.exerts_id', 'exerts.registration', 'exerts.employee_id', 'exerts.position_id', 'positions.position_name', 'positions.workload', 'positions.type', 'employees.sector_id')
        ->get();

        return response()->json([
            "error" => false,
            "response" => $exert
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
        Employee::findOrFail($request->employeeId);
        Position::findOrFail($request->positionId);
        $exerts = Exerts::findOrFail($id);

        $exerts->update([
            "employee_id" => $request->employeeId,
            "position_id" => $request->positionId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Exerts successfully update"
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

        $exerts = Exerts::findOrFail($id);
        $exerts->delete();

        return response()->json([
            "error" => false,
            "message" => "Exerts successfully deleted"
        ]);
    }
}
