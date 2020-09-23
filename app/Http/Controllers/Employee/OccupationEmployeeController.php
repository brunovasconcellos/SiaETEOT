<?php

namespace App\Http\Controllers\Employee;

use App\OccupationEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OccupationEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function validation(Request $request){

        return Validator::make($request->all(), [

            'startDate' => ['required', 'date'],
            'finalDate' => ['required', 'date'],
            'occupationId' => ['required', 'numeric']

            ]);

    }

    
    public function index()
    {
        
        $OccupationEmployee = DB::table('Occupation_Employees')
        ->select(
            "occupation_employees.occup_emp_id","occupations.occupation_name",
            "users.name","occupation_employees.start_date",
            "occupation_employees.final_date","employees.employee_id",
            "occupations.occupation_id",
            )
        ->join("employees", "occupation_employees.employee_id", "=", "employees.employee_id")
        ->join("occupations", "occupation_employees.occupation_id", "=", "occupations.occupation_id")
        ->join("users", "users.user_id", "=", "employees.user_id")
        ->where("occupation_employees.deleted_at", "=", null)
        ->get();


        return response()->json([
            "error" => false,
            "response" => $OccupationEmployee
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

        $error = $this->validation($request);


        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all(),
                "carbon" => Carbon::parse($request->startDate),
            ], 400);
        }

        OccupationEmployee::create([

            "start_date" => Carbon::minValue(),
            "final_date" => new Carbon($request->finalDate),
            "employee_id" => $employeeId,
            "occupation_id" => $request->occupationId
    
        ]);
    
        return response()->json([
            "error" => false,
            "message" => "OccupationEmployee created",
            "carbon" => Carbon::parse($request->startDate),
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
       
        OccupationEmployee::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => OccupationEmployee::where('occup_emp_id', $id)
            ->select(
                "occupation_employees.occup_emp_id","users.name","users.last_name",
                "occupations.occupation_name","sectors.sector_name",
                "occupation_employees.start_date",
                "occupation_employees.final_date","employees.employee_id",
                "occupations.occupation_id","sectors.sector_id"
                 
                 )
        ->join("employees", "occupation_employees.employee_id", "=", "employees.employee_id")
        ->join("occupations", "occupation_employees.occupation_id", "=", "occupations.occupation_id")
        ->join("users", "users.user_id", "=", "employees.user_id")
        ->join("sectors", "sectors.sector_id", "=", "employees.sector_id")
        ->where("occupation_employees.deleted_at", "=", null)
        ->where("occupation_employees.employee_id", "=", $id)
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
    public function update(Request $request, $id)
    {
        

        $OccupationEmployee = OccupationEmployee::findOrFail($id);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([

                "error" => true,
                "message" => $error->errors()->all()

            ], 400);

        }

        $OccupationEmployee->update([
           
            "start_date" => new DateTime($request->startDate),
            "final_date" => new DateTime($request->finalDate),
            "employee_id" => $request->employeeId,
            "occupation_id" => $request->occupationId

        ]);

        return response()->json([
            "error" => false,
            "message" => "OccupationEmployee updated."
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

         OccupationEmployee::findOrFail($id)->delete();

        return response()->json([
            "error" => true,
            "message" => "OccupationEmployee successfully deleted"
        ], 200);

    }
}
