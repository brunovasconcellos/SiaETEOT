<?php

namespace App\Http\Controllers\Course;

use App\Models\Discipline;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisciplineRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Imports\DisciplineImport;
use Maatwebsite\Excel\Facades\Excel;


class DisciplineController extends Controller
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

            $disciplines = DB::table("disciplines")
            ->select("disciplines.discipline_id as id", "disciplines.discipline_name", "disciplines.discipline_abbreviation")
            ->where("disciplines.deleted_at", "=", null)
            ->get();

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
    public function store(DisciplineRequest $request)
    {

        Discipline::create([
            "discipline_name" => $request->disciplineName,
            "discipline_abbreviation" => $request->disciplineAbbreviation,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline successfully created."
        ], 201);

    }

    public function Import (DisciplineRequest $request)
    {
    
        Excel::import(new DisciplineImport, $request->file("excel-file"));

        return response()->json([

            "error" => false,
            "message" => "Disciplines successfully created."

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
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DisciplineRequest $request, $id)
    {

        $discipline = Discipline::findOrFail($id);

        $discipline->update([
            "discipline_name" => $request->disciplineName,
            "discipline_abbreviation" => $request->disciplineAbbreviation,
        ]);

        return response()->json([
            "error" => false,
            "message" => "Discipline successfully updated."
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
        
        Discipline::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "Discipline successfully deleted."
        ]);
        
    }
}
