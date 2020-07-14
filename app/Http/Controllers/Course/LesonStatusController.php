<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\LesonStatus;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LesonStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "status" => ["required", "string", "max:255"],
            "lesonDate" => ["required", "date"],
            "scheduleId" => ["required", "numeric"]
        ]);
    }

    public function index()
    {
        $lesonStatus = DB::table('leson_statuses')
        ->join('schedules', 'leson_statuses.schedule_id', '=', 'schedules.schedule_id')
        ->where('leson_statuses.deleted_at', null)
        ->select('leson_statuses.leson_status_id', 'leson_statuses.status', 'leson_statuses.leson_date', 'leson_statuses.schedule_id','schedules.week_day', 'schedules.start_date', 'schedules.end_date', 'schedules.amount_time', 'schedules.school_class_id', 'schedules.able_id')
        ->paginate(5);

        if(empty($lesonStatus["data"] == false)){
            return response()->json([
                "error" => true,
                "message" => "No registered Leson Status",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $lesonStatus
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
        Schedule::findOrFail($request->scheduleId);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        LesonStatus::create([
            "status" => $request->status,
            "leson_date" => $request->lesonDate,
            "schedule_id" => $request->scheduleId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Leson Status successfully created"
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

        LesonStatus::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => LesonStatus::where('leson_status_id', $id)
            ->join('schedules', 'leson_statuses.schedule_id', '=', 'schedules.schedule_id')
            ->select('leson_statuses.leson_status_id', 'leson_statuses.status', 'leson_statuses.leson_date', 'leson_statuses.schedule_id','schedules.week_day', 'schedules.start_date', 'schedules.end_date', 'schedules.amount_time', 'schedules.school_class_id', 'schedules.able_id')
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
        Schedule::findOrFail($request->scheduleId);
        $lesonStatus = LesonStatus::findOrFail($id);
        
        $error = $this->validator($request);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $lesonStatus->update([
            "status" => $request->status,
            "leson_date" => $request->lesonDate,
            "schedule_id" => $request->scheduleId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Leson Status successfully updated"
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

        $lesonStatus = LesonStatus::findOrFail($id);
        $lesonStatus->delete();

        return response()->json([
            "error" => false,
            "message" => "Leson Status successfully deleted"
        ]);
    }
}
