<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\OccupationRequest;
use App\Models\Occupation;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $occupation = Occupation::get();

        return response()->json([
            "error"             => false,
            "message"           => $occupation
        ]);
    }

    public function select2Data()
    {
        $occupations = Occupation::get();

        $occupationsFormated = [];

        foreach ($occupations as $occupation) {

            $occupationsFormated[] = ["id" => $occupation->occupation_id, "text" => $occupation->occupation_name];

        }

        return response()->json($occupationsFormated);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OccupationRequest $request)
    {
        Occupation::create([
            "occupation_name"   => $request->occupationName
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "Occupation Unit is successfully created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $occupation = Occupation::findOrFail($id);

        return response()->json([
            "error"             => false,
            "message"          => $occupation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OccupationRequest $request, $id)
    {
        $occupation = Occupation::findOrFail($id);

        $occupation->update([
            "occupation_name"   => $request->occupationName
        ]);

        return response()->json([
            "error"             => false,
            "message"           => "Occupation successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $occupation = Occupation::findOrFail($id);

        $occupation->delete();

        return response()->json([
            "error"             => false,
            "message"           => "Occupation successfully deleted"
        ]);
    }
}
