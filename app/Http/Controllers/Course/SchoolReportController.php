<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolReport;

use App\Http\Requests\SchoolReportCreateRequest;
use App\Http\Requests\SchoolReportUpdateRequest;

class SchoolReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolReportCreateRequest $request)
    {
        
        SchoolReport::create([

            "matriculated_id" => $request->matriculated_id,
            "grade_first_trimester" => $request->grade_first_trimester,
            "grade_first_recuperation" => $request->grade_first_recuperation,
            "first_predicted_lesson" => $request->first_predicted_lesson,
            "first_performed_lesson" => $request->first_performed_lesson,
            "grade_second_trimester" => $request->grade_second_trimester,
            "grade_second_recuperation" => $request->grade_second_recuperation,
            "second_predicted_lesson" => $request->second_predicted_lesson,
            "second_performed_lesson" => $request->second_performed_lesson,
            "grade_third_trimester" => $request->grade_third_trimester,
            "grade_third_recuperation" => $request->grade_third_recuperation,
            "third_predicted_lesson" => $request->third_predicted_lesson,
            "third_performed_lesson" => $request->third_performed_lesson,
            "situation_before_final_recup" => $request->situation_before_final_recup,
            "grade_final_recuperation" => $request->grade_final_recuperation,
            "situation_after_final_recup" => $request->situation_after_final_recup

        ]);

        return response()->json([
            "error" => false,
            "response" => "School report successfully created."
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolReportUpdateRequest $request, $id)
    {

        $schoolReport = SchoolReport::findOrFail($id);

        $schoolReport->update([

            "grade_first_trimester" => $request->grade_first_trimester,
            "grade_first_recuperation" => $request->grade_first_recuperation,
            "first_predicted_lesson" => $request->first_predicted_lesson,
            "first_performed_lesson" => $request->first_performed_lesson,
            "grade_second_trimester" => $request->grade_second_trimester,
            "grade_second_recuperation" => $request->grade_second_recuperation,
            "second_predicted_lesson" => $request->second_predicted_lesson,
            "second_performed_lesson" => $request->second_performed_lesson,
            "grade_third_trimester" => $request->grade_third_trimester,
            "grade_third_recuperation" => $request->grade_third_recuperation,
            "third_predicted_lesson" => $request->third_predicted_lesson,
            "third_performed_lesson" => $request->third_performed_lesson,
            "situation_before_final_recup" => $request->situation_before_final_recup,
            "grade_final_recuperation" => $request->grade_final_recuperation,
            "situation_after_final_recup" => $request->situation_after_final_recup

        ]);

        return response()->json([
            "error" => false,
            "response" => "School report successfully updated."
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
        
        $schoolReport = SchoolReport::findOrFail($id);

        $schoolReport->delete();

        return response()->json([
            "error" => false,
            "response" => "School report successfully deleted."
        ]);

    }
}
