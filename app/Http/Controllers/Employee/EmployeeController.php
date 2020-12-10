<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee;
use App\Models\User;
use App\Models\Locality;
use App\Models\Exerts;
use App\Models\OccupationEmployee;
use App\Models\Occupation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Employee\ExertsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

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

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $employees = DB::table('employees')
                ->select(
                    "employees.employee_id as id", "exerts.registration","users.name", "users.last_name", "users.email",
                    "users.gender", "contacts.contact", "sectors.sector_name",
                )
                ->selectRaw("GROUP_CONCAT(DISTINCT occupations.occupation_name) as occupation_names,
                                            GROUP_CONCAT(DISTINCT positions.position_name) as position_names")
                ->join("users", "employees.user_id", "=", "users.user_id")
                ->join("contacts", "employees.user_id", "=", "contacts.user_id")
                ->join("sectors", "employees.sector_id", "=", "sectors.sector_id")
                ->leftJoin("exerts", "employees.employee_id", "=", "exerts.employee_id")
                ->leftJoin("positions", "exerts.position_id", "=", "positions.position_id")
                ->leftJoin("occupation_employees", "occupation_employees.employee_id", "=", "employees.employee_id")
                ->leftJoin("occupations", "occupations.occupation_id", "=", "occupation_employees.occupation_id")
                ->where("employees.deleted_at", "=", null)
                ->groupBy("users.user_id")
                ->get();

            return DataTables()->of($employees)->make(true);

        }


        return view("employee");

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

        $userValidation = $user->validator($request);

        $exerts = new ExertsController;

        $exertsValidation = $exerts->validation($request);

        if ($error->fails()) {

            return response()->json([

                "error" => true,
                "message" => $error->errors()->all()

            ], 400);

        }

        if ($userValidation->fails()) {

            return response()->json([

                "error" => true,
                "message" => $userValidation->errors()->all()

            ], 400);

        }

        if ($exertsValidation->fails()) {

            return response()->json([

            "error" => true,
            "message" => $exertsValidation->errors()->all()

            ], 400);

        }

        $userId = $user->store($request);

        $employee = Employee::create([

            "user_id" => $userId["userId"],
            "sector_id" => $request->sectorId

        ]);

        $exerts->store($request, $employee->employee_id);

        return response()->json([

            "error" => false,
            "message" => "Employee successfully created.",
            "employeeId" => $employee->employee_id

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

        Employee::findOrFail($id);

        $employee = DB::table("employees")
        ->select("employees.employee_id", "users.name", "users.last_name", "users.email",
            "users.gender", "users.date_of_birth", "users.identity_rg", "users.identity_em_dt",
            "users.identity_issuing_authority", "users.cpf","sectors.sector_name", "localities.cep",
            "localities.public_place", "localities.neighborhood", "users.num_residence","users.complement_residence",
            "localities.cep", "localities.city", "localities.federation_unit","contacts.type", "contacts.contact")
        ->selectRaw(
            "GROUP_CONCAT(DISTINCT exerts.registration) as registrations,
             GROUP_CONCAT(DISTINCT positions.position_name) as position_names,
             GROUP_CONCAT(DISTINCT positions.workload) as position_workloads,
             GROUP_CONCAT(DISTINCT positions.type) as position_types"
            )
        ->selectRaw(
            "GROUP_CONCAT(DISTINCT occupations.occupation_name) as occupation_names,
             GROUP_CONCAT(DISTINCT occupation_employees.start_date) as start_dates,
             GROUP_CONCAT(DISTINCT occupation_employees.final_date) as final_dates"
        )
        ->join("users", "employees.user_id", "=", "users.user_id")
        ->join("sectors", "employees.sector_id", "=", "sectors.sector_id")
        ->join("localities", "users.cep_user", "=", "localities.cep")
        ->join("contacts", "employees.user_id", "=", "contacts.user_id")
        ->join("exerts", "employees.employee_id", "=", "exerts.employee_id")
        ->join("positions", "exerts.position_id", "=", "positions.position_id")
        ->leftJoin("occupation_employees", "occupation_employees.employee_id", "=", "employees.employee_id")
        ->leftJoin("occupations", "occupations.occupation_id", "=", "occupation_employees.occupation_id")
        ->whereNull("employees.deleted_at")
        ->where("employees.employee_id", "=", $id)
        ->groupBy("users.user_id")
        ->get();

        return response()->json([
            "error" => false,
            "response" => $employee
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeId)
    {

        $employee = Employee::findOrFail($employeeId);

        $error = $this->validator($request);

        $user = new UserController();

        $userValidation = $user->validator($request);

        if ($error->fails()) {

            return response()->json([

                "error" => true,
                "message" => $error->errors()->all()

            ], 400);

        }

        if ($userValidation->fails()) {

            return response()->json([

                "error" => true,
                "message" => $userValidation->errors()->all()

            ], 400);

        }

        $userId = $user->update($request, $employee->user_id);

        $employee->update([
            "userId" => $userId["userId"],
            "sector_id" => $request->sectorId
        ]);

        return response()->json([

            "error" => false,
            "message" => "Employee successfully updated.",

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

        OccupationEmployee::where("employee_id", "=", $id)->delete();

        $employee->delete();

        $user->destroy($userId);

        return response()->json([
            "error" => false,
            "message" => "Employee successfully deleted."
        ], 200);

    }
}
