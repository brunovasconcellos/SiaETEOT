<?php

namespace App\Http\Controllers\Course;

use App\Discipline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function validation(Request $request) {

        return Validator::make($request->all(), [
            
            "disciplineName" => ["required", "string", "max:255"],
            "disciplineAbbreviation" => ["required", "string", "max:255"],

        ]);

     }

    public function index(Request $request)
    {
        
        $disciplines = DB::table("disciplines")
        ->select("disciplines.discipline_id as id", "disciplines.discipline_name", "disciplines.discipline_abbreviation")
        ->where("disciplines.deleted_at", "=", null)
        ->get();

        if ($request->ajax())
        {

          return DataTables()->of($disciplines)->make(true);

        }

        return view('discipline');
        
    }

    public function select2Data() {

        $disciplines = DB::table("disciplines")
        ->select("disciplines.discipline_id", "disciplines.discipline_name")
        ->where("disciplines.deleted_at", "=", null)
        ->get();

        $disciplinesFormated = [];
        
        foreach($disciplines as $discipline) {

            $disciplinesFormated[] = ["id" => $discipline->discipline_id, "text" => $discipline->discipline_name];

        }

        return response()->json($disciplinesFormated);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        Discipline::create([
            "discipline_name" => $request->disciplineName,
            "discipline_abbreviation" => $request->disciplineAbbreviation,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline successfully created."
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

        Discipline::findOrFail($id);

        $discipline = DB::table("disciplines")
        ->select(
            "disciplines.discipline_id", "disciplines.discipline_name", "disciplines.discipline_abbreviation"
            )
        ->where("disciplines.discipline_id", "=", $id)
        ->where("disciplines.deleted_at", "=", null)
        ->get();

        return response()->json([
            "error" => false,
            "response" => $discipline
        ], 200);

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

        $discipline = Discipline::findOrFail($id);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

        }

        $discipline->update([
            "discipline_name" => $request->disciplineName,
            "discipline_abbreviation" => $request->disciplineAbbreviation,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline successfully updated."
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
        
        Discipline::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "Discipline successfully deleted."
        ], 200);
        
    }
}
