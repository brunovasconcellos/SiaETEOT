<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teach;
use App\Models\Discipline;
use App\Models\Employee;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TeachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation(Request $request) {

        return Validator::make($request->all(), [
            "startDate" => ["required", "date", "size:10"],
            "endDate" => ["required", "date", "size:10"],
            "disciplineId" => ["required", "numeric"],
            "employeeId" => ["required", "numeric"]
        ]);

     }
     
    public function index(Request $request)
    {
        
       $teaches = DB::table("teaches")
        ->select(
            "teaches.teach_id", "teaches.start_date", "teaches.end_date", "teaches.discipline_id",
            "disciplines.discipline_name", "disciplines.discipline_abbreviation", "teaches.employee_id", "employees.sector_id"
            )
        ->join("disciplines", "teaches.discipline_id", "=", "disciplines.discipline_id")
        ->join("employees", "teaches.employee_id", "=", "employees.employee_id")
        ->where("teaches.deleted_at", "=", null)
        ->get();

        if ($request->ajax()) {

            return DataTables()->of($teaches)->make(true);

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        Teach::create([
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "discipline_id" => $request->disciplineId,
            "employee_id" => $request->employeeId,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Teach successfully created."
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

        Teach::findOrFail($id);
        
        $teach = DB::table("teaches")
        ->select(
            "teaches.teach_id", "teaches.start_date", "teaches.end_date", "teaches.discipline_id",
            "disciplines.discipline_name", "disciplines.discipline_abbreviation", "teaches.employee_id", "employees.sector_id"
            )
        ->join("disciplines", "teaches.discipline_id", "=", "disciplines.discipline_id")
        ->join("employees", "teaches.employee_id", "=", "employees.employee_id")
        ->where("teaches.teach_id", "=", $id)
        ->get();

        return response()->json([
            "error" => false,
            "response" => $teach
        ], 200);

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

        $teach = Teach::findOrFail($id);
        
        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        $teach->update([
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "discipline_id" => $request->disciplineId,
            "employee_id" => $request->employeeId,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Teach successfully created."
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
        
        Teach::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Teach successfully deleted."
        ], 200);

    }
}
