<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Locality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use App\Models\Employee;
use App\Models\Exert;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $employees = DB::table('employees')
                ->select("employees.employee_id as id", "exerts.registration","users.name",
                    "users.last_name", "users.email", "users.gender", "users.cell_phone as contact", "sectors.sector_name")
                ->selectRaw("GROUP_CONCAT(DISTINCT occupations.occupation_name) as occupation_names")
                ->selectRaw("GROUP_CONCAT(DISTINCT positions.position_name) as position_names")
                ->join("users", "employees.user_id", "=", "users.user_id")
                ->join("sectors", "employees.sector_id", "=", "sectors.sector_id")
                #->leftJoin("contacts", "employees.user_id", "=", "contacts.user_id")
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeRequest $request)
    {

        $localityCep = Locality::validateLocality($request);


        $user = User::create([
            "name"                          => $request->name,
            "last_name"                     => $request->last_name,
            "email"                         => $request->email,
            "password"                      => Hash::make($request->password),
            "date_of_birth"                 => $request->dateOfBirth,
            "gender"                        => $request->gender,
            "cell_phone"                    => $request->cellPhone,
            "identity_rg"                   => $request->identityRg,
            "identity_em_dt"                => $request->identityEmDt,
            "identity_issuing_authority"    => $request->identityAuthority,
            "cpf"                           => $request->cpf,
            "level"                         => $request->level,
            "num_residence"                 => $request->numResidence,
            "complement_residence"          => $request->complementResidence,
            "cep_user"                      => $localityCep,
        ]);

        $employee = Employee::create([
            "user_id"                       => $user->user_id,
            "sector_id"                     => $request->sectorId
        ]);

        Exert::create([
            'registration'                  => $request->registration,
            'employee_id'                   => $employee->employee_id,
            'position_id'                   => $request->position_id,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Employee successfully created.",
            "EmployeeId" => $employee->employee_id
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
        $employee = Employee::findOrFail($id);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployeeRequest $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        $localityCep = Locality::validateLocality($request);

        $employee->EmployeeUser()->update([
            "name"                          => $request->name,
            "last_name"                     => $request->last_name,
            "email"                         => $request->email,
            "password"                      => Hash::make($request->password),
            "date_of_birth"                 => $request->dateOfBirth,
            "gender"                        => $request->gender,
            "cell_phone"                    => $request->cellPhone,
            "identity_rg"                   => $request->identityRg,
            "identity_em_dt"                => $request->identityEmDt,
            "identity_issuing_authority"    => $request->identityAuthority,
            "cpf"                           => $request->cpf,
            "level"                         => $request->level,
            "num_residence"                 => $request->numResidence,
            "complement_residence"          => $request->complementResidence,
            "cep_user"                      => $localityCep,
        ]);

        $employee->update([
            "sector_id"                     => $request->sectorId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Employee successfully updated.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->EmployeeOcupations()->delete();

        $employee->EmployeeUser()->delete();

        $employee->delete();

        return response()->json([
            "error" => false,
            "message" => "Employee successfully deleted."
        ]);
    }
}
