<?php

namespace App\Http\Controllers\Student;

use App\Student;
use App\User;
use App\Imports\StudentImport;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Student\StudentComplementController;

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

    public function validator (Request $request) {

        return  Validator::make($request->all(), [

            "fatherName" => ["required", "string", "max:255"],
            "matherName" => ["required", "string", "max:255"],
            "studentType" => ["required", "string", "max:255"],
            "actualSituation" => ["required", "string", "max:255"],

        ]);

    }

    public function downloadExcel() {

        $file = Storage::path('public\modelsExcel\student_model.xlsx');

        return response()->download($file);

    }

    public function index(Request $request)
    {
        
        $students = DB::table('students')
        ->select(
            "students.student_registration as id", "users.name", "users.last_name", "users.email",
            "users.gender", "students.student_type", "contacts.contact", "school_classes.school_class_name",
            "matriculateds.call_number", "matriculateds.school_year"
         )
        ->join("users", "students.user_id", "=", "users.user_id")
        ->join("contacts", "students.user_id", "=", "contacts.user_id")
        ->leftJoin("matriculateds", "students.student_registration", "matriculateds.student_registration")
        ->leftJoin("school_classes", "matriculateds.school_class_id", "school_classes.school_class_id")
        ->where("students.deleted_at", "=", null)
        ->get();

        if ($request->ajax()) {

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

    public function store(Request $request)
    {

        $error = $this->validator($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
                ], 400);

        }

        $studentComplementError = StudentComplementController::validator($request);

        if ($studentComplementError->fails()) {

            return response()->json([
                "error" => true,
                "message" => $studentComplementError->errors()->all()
            ]);

        }

        $user = new UserController();

        $userValidation = $user->validator($request);

        if ($userValidation->fails()) {

            return response()->json([
                "error" => true,
                "message" => $userValidation->errors()->all()
            ], 400);

        }

        $userId = $user->store($request);

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

        Student::create([
            "student_registration" => $studentRegistration,
            "father_name" => $request->fatherName,
            "mather_name" => $request->matherName,
            "student_type" => $request->studentType,
            "actual_situation" => $request->actualSituation,
            "user_id" => $userId["userId"]
        ]);

        $studentComplement = new StudentComplementController();

        $studentComplement->store($request, $studentRegistration);

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

        Student::findOrFail($id);

        $student = DB::table('students')
        ->select(
            "students.student_registration", "users.name", "users.last_name", "users.email",
            "users.gender", "users.date_of_birth", "users.identity_rg", "users.identity_em_dt",
            "users.identity_issuing_authority", "users.cpf", "students.student_type", "students.mather_name",
            "students.father_name", "students.actual_situation", "student_complements.ingress_type", "student_complements.ingress_form",
            "student_complements.vagacy_type", "student_complements.last_school",  "student_complements.ident_educacenso",  "student_complements.year_last_grade",
            "localities.cep", "localities.public_place", "localities.neighborhood", "users.num_residence",
            "users.complement_residence", "localities.cep", "localities.city", "localities.federation_unit",
            "contacts.type", "contacts.contact", "students.created_at"
         )
        ->join("users", "students.user_id", "=", "users.user_id")
        ->join("student_complements","students.student_registration", "=", "student_complements.student_registration")
        ->join("localities", "users.cep_user", "=", "localities.cep")
        ->join("contacts", "students.user_id", "=", "contacts.user_id")
        ->where("students.deleted_at", "=", null)
        ->where("students.student_registration", "=", $id)
        ->get();

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
    public function update(Request $request, $id)
    {
        
        $error = $this->validator($request);

        $student = Student::findOrFail($id);

        User::findOrFail($student->user_id);

        $user = new UserController();

        $userValidation = $user->validator($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        $studentComplementError = StudentComplementController::validator($request);

        if ($studentComplementError->fails()) {

            return response()->json([
                "error" => true,
                "message" => $studentComplementError->errors()->message()
            ]);

        }

        if ($userValidation->fails()) {

            return response()->json([
                "error" => true,
                "message" => $userValidation->errors()->message()
            ], 400);

        }

        $user->update($request, $student->user_id);

        $student->update([
            "father_name" => $request->fatherName,
            "mather_name" => $request->matherName,
            "student_type" => $request->studentType,
            "actual_situation" => $request->actualSituation,
        ]);

        $studentComplement = new StudentComplementController();

        $studentComplement->update($request, $id);

        return response()->json([
            "error" => false,
            "message" => "Student successfully updated."
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

        $student = Student::findOrFail($id);

        $studentComplement = new StudentComplementController();

        $studentComplement->destroy($id);

        $studentId = $student->user_id;

        $student->delete();

        $user = new UserController();

        $user->destroy($studentId);
        
        return response()->json([
            "error" => false,
            "message" => "Student successfully deleted."
        ], 200);

    }
    
}
