<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use App\Models\User;
use App\Imports\StudentImport;

use App\Http\Requests\StudentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function downloadExcel() {

        $file = Storage::path('public\modelsExcel\student_model.xlsx');

        return response()->download($file);

    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $students = DB::table('students')
                ->select(
                    "students.student_registration as id", "users.name", "users.last_name", "users.email",
                    "users.gender", "students.student_type", "users.cell_phone",
                    "matriculateds.call_number", "matriculateds.school_year"
                )
                ->selectRaw("GROUP_CONCAT( school_classes.school_class_name) as school_class")
                ->join("users", "students.user_id", "=", "users.user_id")
                ->leftJoin("matriculateds", "students.student_registration", "matriculateds.student_registration")
                ->leftJoin("school_classes", "matriculateds.school_class_id", "school_classes.school_class_id")
                ->whereNull("students.deleted_at")
                ->groupBy("students.student_registration")
                ->get();

            return DataTables()->of($students)->make(true);

        }

        return view("student");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function storeExcel (Request $request) {

        Excel::import(new StudentImport, $request->file("excel-file"));

        return response()->json([

            "response" => "Students successfully created."

        ]);

     }

    public function store(StudentRequest $request)
    {

        //generate student registration

        $fixedNumber = date("y");

        if ($request->half == 1) {

            $fixedNumber .= 10;

        }

        if ($request->half == 2) {

            $fixedNumber .= 20;

        }

        if ($request->modality == "integral") {

            $fixedNumber .= 14;

        }

        if ($request->modality == "subsequently") {

            $fixedNumber .= 15;

        }

        switch($request->course) {

            case "computing":
                $fixedNumber .= 44;
                break;

            case "health_management":
                $fixedNumber .= 39;
                break;

            case "administration":
                $fixedNumber .= 01;
                break;

            case "clinical_analysis":
                $fixedNumber .= 04;
                break;

            default:
                return response()->json([
                    "error" => true,
                    "message" => "Course not exist."

                ], 400);

        }

        $lastRegistration = DB::table("students")->select("student_registration")->orderByDesc("created_at")->first();

        $lastRegistration != null ? $registrationYear = Str::substr((string) $lastRegistration->student_registration, -12, 2) : $registrationYear = null;

        if ($registrationYear == date("y")) {

            $registrationNumber = Str::substr((string) $lastRegistration->student_registration , 8, 4) + 1;

            $sequentialNumber = str_pad($registrationNumber, 4, 0, STR_PAD_LEFT);

        }

        if ($registrationYear != date("y") || !$registrationYear) {

            $sequentialNumber = str_pad(1, 4, 0, STR_PAD_LEFT);

        }

        $studentRegistration = $fixedNumber.$sequentialNumber;

        //end generate student registration

        $user = User::create([

            "name" => $request->name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => $request->password,
            "date_of_birth" => $request->date_of_birth,
            "gender" => $request->gender,
            "cell_phone" => $request->cell_phone,
            "identity_rg" => $request->identity_rg,
            "identity_em_dt" => $request->identity_em_dt,
            "identity_issuing_authority" => $request->identity_authority,
            "cpf" => $request->cpf,
            "level" => $request->level,
            "num_residence" => $request->num_residence,
            "complement_residence" => $request->complement_residence,
            "cep_user" => $request->cep_user,

        ]);

        Student::create([

            "student_registration" => $studentRegistration,
            "father_name" => $request->father_name,
            "mather_name" => $request->mather_name,
            "student_type" => $request->student_type,
            "actual_situation" => $request->actual_situation,
            "user_id" => $user->user_id,

        ]);

        return response()->json([
            "error" => false,
            "message" => "Student is successfully created.",
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

        $student = Student::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => $student
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {

        $student = Student::findOrFail($id);

        $student->StudentUser()->update([

            "name" => $request->name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => $request->password,
            "date_of_birth" => $request->date_of_birth,
            "gender" => $request->gender,
            "cell_phone" => $request->cell_phone,
            "identity_rg" => $request->identity_rg,
            "identity_em_dt" => $request->identity_em_dt,
            "identity_issuing_authority" => $request->identity_authority,
            "cpf" => $request->cpf,
            "level" => $request->level,
            "num_residence" => $request->num_residence,
            "complement_residence" => $request->complement_residence,
            "cep_user" => $request->cep_user,

        ]);

        $student->update([

            "father_name" => $request->father_name,
            "mather_name" => $request->mather_name,
            "student_type" => $request->student_type,
            "actual_situation" => $request->actual_situation,

        ]);

        return response()->json([
            "error" => false,
            "message" => "Student successfully updated."
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

        $student = Student::findOrFail($id);

        $student->StudentComplement()->delete();

        $student->StudentUser()->delete();

        $student->delete();

        return response()->json([
            "error" => false,
            "message" => "Student successfully deleted."
        ]);

    }

}
