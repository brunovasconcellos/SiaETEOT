<?php

namespace App\Http\Controllers\Course;

use App\Models\Content;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(Request $request){
        return Validator::make($request->all(), [
            "contentName" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "contentDate" => ["required", "date"],
            "contentSchedule" => ["required", "date"],
            "scheduleId" => ["required", "numeric"]
        ]);
    }

    public function index()
    {
        $contents = DB::table('contents')->join('schedules', 'contents.schedule_id', '=', 'schedules.schedule_id')
        ->where('contents.deleted_at', null)
        ->select('contents.content_id', 'contents.content_name', 'contents.description', 'contents.content_date', 'contents.content_schedule', 'contents.schedule_id', 'schedules.week_day', 'schedules.start_date', 'schedules.end_date', 'schedules.amount_time', 'schedules.school_class_id', 'schedules.able_id')
        ->paginate(5);

        if(empty($contents["data"] == false)){
            return response()->json([
                "error" => false,
                "message" => "No registered contents",
                "response" => null
            ]);
        }

        return response()->json([
            "error" => false,
            "response" => $contents
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

        Content::create([
            "content_name" => $request->contentName,
            "description" => $request->description,
            "content_date" => $request->contentDate,
            "content_schedule" => $request->contentSchedule,
            "schedule_id" => $request->scheduleId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Content successfully created"
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

        Content::findOrFail($id);

        return response()->json([
            "error" => false,
            "response" => Content::where('content_id', $id)
            ->join('schedules', 'contents.schedule_id', '=', 'schedules.schedule_id')
            ->select('contents.content_id', 'contents.content_name', 'contents.description', 'contents.content_date', 'contents.content_schedule', 'contents.schedule_id', 'schedules.week_day', 'schedules.start_date', 'schedules.end_date', 'schedules.amount_time', 'schedules.school_class_id', 'schedules.able_id')
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
        $contents = Content::findOrFail($id);
        
        $error = $this->validator($request);

        if($error->fails()){
            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);
        }

        $contents->update([
            "content_name" => $request->contentName,
            "description" => $request->description,
            "content_date" => $request->contentDate,
            "content_schedule" => $request->contentSchedule,
            "schedule_id" => $request->scheduleId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Content successfully updated"
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

        $contents = Content::findOrFail($id);
        $contents->delete();

        return response()->json([
            "error" => false,
            "message" => "Content successfully deleted"
        ]);
    }
}
