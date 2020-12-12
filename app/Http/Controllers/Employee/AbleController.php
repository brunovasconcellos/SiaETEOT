<?php

namespace App\Http\Controllers\Employee;

use App\Http\Requests\AbleUpdateRequest;
use App\Models\Able;
use App\Models\Discipline;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AbleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "schoolYear" => ["required", "numeric"],
            "employeeId" => ["required", "numeric"],
            "disciplineId" => ["required", "numeric"]
        ]);
    }

    public function index()
    {
        $able = DB::table('ables')->join("employees", "ables.employee_id", "=", "employees.employee_id")
        ->join("disciplines", "ables.discipline_id", "=", "disciplines.discipline_id")
        ->where('ables.deleted_at', null)
        ->select("ables.able_id", "ables.school_year", "ables.employee_id", "ables.discipline_id", "employees.sector_id", "disciplines.discipline_name", "disciplines.discipline_abbreviation")
        ->paginate(5);

        if(empty($able["data"] == false)){
            return response()->json([
                "error" => true,
                "message" => "Unathorized",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $able
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
        Employee::findOrFail($request->employeeId);
        Discipline::findOrFail($request->disciplineId);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        Able::create([
            "school_year" => $request->schoolYear,
            "employee_id" => $request->employeeId,
            "discipline_id" => $request->disciplineId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Able successfuly created"
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
        Able::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => Able::where('able_id', $id)
            ->join("employees", "ables.employee_id", "=", "employees.employee_id")
            ->join("disciplines", "ables.discipline_id", "=", "disciplines.discipline_id")
            ->select("ables.able_id", "ables.school_year", "ables.employee_id", "ables.discipline_id", "employees.sector_id", "disciplines.discipline_name", "disciplines.discipline_abbreviation")
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
    public function update(AbleUpdateRequest $request, $id)
    {
        $able = Able::findOrFail($id);

        $able->update([
            "school_year" => $request->schoolYear,
            "employee_id" => $request->employeeId,
            "discipline_id" => $request->disciplineId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Able successfully updated"
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
        $able = Able::findOrFail($id);

        $able->delete();

        return response()->json([
            "error" => false,
            "message" => "Able successfully deleted"
        ]);
    }
}
