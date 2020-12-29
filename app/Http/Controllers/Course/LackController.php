<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lack;
use App\Models\Matriculated;
use App\ModelsLesonStatus;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation(Request $request) {

        return Validator::make($request->all(), [

            "lackType" => ["required", "string"],
            "matriculatedId" => ["required", "numeric", "integer"],
            "lesonStatusId" => ["required", "numeric", "integer"]

        ]);

    }

    public function index()
    {
        
        $lacks = DB::table("lacks")
        ->select(
            "lacks.lack_id", "lacks.lack_type", "matriculateds.matriculated_id", "matriculateds.matriculation_date",
            "leson_statuses.leson_status_id", "leson_statuses.status"
        )
        ->join('matriculateds', 'lacks.matriculated_id', "=", "matriculateds.matriculated_id")
        ->join("leson_statuses", "lacks.leson_status_id", "=", "leson_statuses.leson_status_id")
        ->where("lacks.deleted_at", "=", null)
        ->paginate(5);

        return response()->json([
            "error" => false,
            "response" => $lacks
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Matriculated::findOrFail($request->matriculatedId);

        LesonStatus::findOrFail($request->lesonStatusId);


        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        Lack::create([
            "lack_type" => $request->lackType,
            "matriculated_id" => $request->matriculatedId,
            "leson_status_id" => $request->lesonStatusId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Lack successfully created."
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        Lack::findOrFail($id);
        
        $lack = DB::table("lacks")
        ->select(
            "lacks.lack_id", "lacks.lack_type", "matriculateds.matriculated_id", "matriculateds.matriculation_date",
            "matriculateds.school_year", "matriculateds.situation", "matriculateds.call_number", "leson_statuses.leson_status_id",
            "leson_statuses.status", "leson_statuses.leson_date"
            )
        ->join('matriculateds', 'lacks.matriculated_id', "=", "matriculateds.matriculated_id")
        ->join("leson_statuses", "lacks.leson_status_id", "=", "leson_statuses.leson_status_id")
        ->where("lacks.lack_id", "=", $id)
        ->where("lacks.deleted_at", "=", null)
        ->paginate(5);

        return response()->json([
            "error" => false,
            "response" => $lack
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
        
        $lack = Lack::findOrFail($id);

        Matriculated::findOrFail($request->matriculatedId);

        LesonStatus::findOrFail($request->lesonStatusId);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ]);

        }

        $lack->update([
            "lack_type" => $request->lackType,
            "matriculated_id" => $request->matriculatedId,
            "leson_status_id" => $request->lesonStatusId
        ]);

        return response()->json([
            "error" => false,
            "message" => "Lack successfully updated."
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
        
        Lack::findOrFail($id)->delete();
        
        return response()->json([
            "error" => false,
            "message" => "Lack successfully deleted."
        ]);

    }
}
