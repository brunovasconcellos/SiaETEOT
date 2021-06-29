<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExertRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Exert;

class ExertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $exert = DB::table("exerts")
                ->select(
                    "exerts.exerts_id as id",
                    "exerts.registration",
                    "users.user_name",
                    "positions.position_name"
                )
                ->join("employees", "exerts.employee_id", "=", "employees.employee_id")
                ->join("positions", "exerts.position_id", "=", "positions.positions_id")
                ->join("users", "employees.user_id", "=", "users.user_id")
                ->where("exerts.deleted_at", "=", null)
                ->get();

            return DataTables()->of($exert)->make(true);
        }

        return view("exert");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ExertRequest $request)
    {
        Exert::create([
            "registration"      => $request->registration,
            "employee_id"       => $request->employee_id,
            "position_id"       => $request->positionId
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "Exert successfuly created"
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ExertRequest $request, $id)
    {
        $exerts = Exert::findOrFail($id);

        $exerts->update([
            "employee_id"       => $request->employeeId,
            "position_id"       => $request->positionId
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "Exert successfully updated"
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
        $exerts = Exert::findOrFail($id);

        $exerts->delete();

        return response()->json([
            "error"             => false,
            "message"           => "Exert successfully deleted"
        ]);
    }
}
