<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentUnit;
use App\TransferSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class TransferSusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "processNumber" => ["required", "numeric"], 
            "transferDate" => ["required", "date"], 
            "transferType" => ["required"], 
            "studentRegistration" => ["required", "numeric"],
            "suId" => ["required", "numeric"]
        ]);
    }

    public function index()
    {
        $transferSus = DB::table('transfer_sus')
        ->join("students", "transfer_sus.student_registration", "=", "students.student_registration")
        ->join("student_units", "transfer_sus.su_id", "=", "student_units.su_id")
        ->join('users', "students.user_id", "=", "users.user_id")
        ->where('transfer_sus.deleted_at', null)
        ->select('transfer_sus.trans_id', 'transfer_sus.process_number', 'transfer_sus.transfer_date', 'transfer_sus.transfer_type', 'transfer_sus.student_registration', 'transfer_sus.su_id', 'student_units.su_name', 'users.name', 'users.last_name')->get();

        if(!Auth::user() || Auth::user()->level <= 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);

        }else if(!$transferSus){
            return response()->json([
                "error" => false,
                "message" => "No transfer sus Unit registred.",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $transferSus
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
        Student::findOrFail($request->studentRegistration);
        StudentUnit::findOrFail($request->suId);


        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }
    
        TransferSu::create([
            "process_number" => $request->processNumber, 
            "transfer_date" => $request->transferDate, 
            "transfer_type" => $request->transferType, 
            "student_registration" => $request->studentRegistration, 
            "su_id" => $request->suId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Transfer Su sucess"
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
        if(!Auth::user() || Auth::user()->level <= 7){
            return response()->json([
                "error" => true,
                "message" => "Unauthorized"
            ], 401);
        }

        TransferSu::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => TransferSu::where('trans_id', $id)->join("students", "transfer_sus.student_registration", "=", "students.student_registration")->join("student_units", "transfer_sus.su_id", "=", "student_units.su_id")->join('users', "students.user_id", "=", "users.user_id")->where('transfer_sus.deleted_at', null)->select('transfer_sus.trans_id', 'transfer_sus.process_number', 'transfer_sus.transfer_date', 'transfer_sus.transfer_type', 'transfer_sus.student_registration', 'transfer_sus.su_id', 'student_units.su_name', 'users.name', 'users.last_name')->get()
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
        Student::findOrFail($request->studentRegistration);
        StudentUnit::findOrFail($request->suId);
        $transferSus = TransferSu::findOrFail($id);

        $error = $this->validator($request);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $transferSus->update([
            "process_number" => $request->processNumber, 
            "transfer_date" => $request->transferDate, 
            "transfer_type" => $request->transferType, 
            "student_registration" => $request->studentRegistration, 
            "su_id" => $request->suId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Transfer Sus successfully update."
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

        $transferSus = TransferSu::findOrFail($id);
        $transferSus->delete();

        return response()->json([
            "error" => false,
            "message" => "Student Unit successfully deleted."
        ], 200);
    }
}
