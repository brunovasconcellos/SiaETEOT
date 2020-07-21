<?php

namespace App\Http\Controllers\Course;

use App\Able;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "weekDay" => ["required", "numeric"],
            "startDate" => ["required", "date"],
            "endDate" => ["required", "date"],
            "amountTime" => ["required", "numeric"],
            "schoolClassId" => ["required", "numeric"],
            "ableId" => ["required", "numeric"]
        ]);
    }

    public function index()
    {
        $schedules = DB::table('schedules')->join("school_classes", "schedules.school_class_id", "=", "school_classes.school_class_id")
        ->join("ables", "schedules.able_id", "=", "ables.able_id")
        ->where('schedules.deleted_at', null)
        ->select('schedules.schedule_id', 'schedules.week_day', 'schedules.start_date', 'schedules.end_date', 'schedules.amount_time', 'schedules.school_class_id', 'schedules.able_id', 'school_classes.school_class_name', 'school_classes.school_class_type', 'school_classes.school_year', 'school_classes.situation', 'school_classes.shift', 'school_classes.modality', 'school_classes.course_id', 'ables.employee_id', 'ables.discipline_id')
        ->paginate(5);

        if(empty($schedules["data"] == false)){
            return response()->json([
                "error" => true,
                "message" => "No registered Schedules",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $schedules
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
        SchoolClass::findOrFail($request->schoolClassId);
        Able::findOrFail($request->ableId);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        Schedule::create([
            "week_day" => $request->weekDay,
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "amount_time" => $request->amountTime,
            "school_class_id" => $request->schoolClassId,
            "able_id" => $request->ableId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Schedule successfuly created"
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
            ]);
        }

        Schedule::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => Schedule::where('schedule_id', $id)
            ->join("school_classes", "schedules.school_class_id", "=", "school_classes.school_class_id")
            ->join("ables", "schedules.able_id", "=", "ables.able_id")
            ->select('schedules.schedule_id', 'schedules.week_day', 'schedules.start_date', 'schedules.end_date', 'schedules.amount_time', 'schedules.school_class_id', 'schedules.able_id', 'school_classes.school_class_name', 'school_classes.school_class_type', 'school_classes.school_year', 'school_classes.situation', 'school_classes.shift', 'school_classes.modality', 'school_classes.course_id', 'ables.employee_id', 'ables.discipline_id')
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
        SchoolClass::findOrFail($request->schoolClassId);
        Able::findOrFail($request->ableId);
        $schedules = Schedule::findOrFail($id);

        $error = $this->validator($request);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $schedules->update([
            "week_day" => $request->weekDay,
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "amount_time" => $request->amountTime,
            "school_class_id" => $request->schoolClassId,
            "able_id" => $request->ableId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Schedule successfully update"
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
            ]);
        }

        $schedules = Schedule::findOrFail($id);
        $schedules->delete();

        return response()->json([
            "error" => false,
            "message" => "Schedule sccessfully deleted"
        ]);
    }
}
