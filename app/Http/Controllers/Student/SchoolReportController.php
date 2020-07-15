<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SchoolReport;
use App\Matriculated;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SchoolReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function validation(Request $request) {

        return Validator::make($request->all(), [

        "matriculatedId" => ["required", "numeric"],    
        "gradeFirstTrimester" => ["required", "numeric"],
        "gradeFirstRecuperation" => ["required", "numeric"],
        "firstPredictedLesson" => ["required", "numeric", "integer"],
        "firstPerformedLesson" => ["required", "numeric", "integer"],
        "gradeSecondTrimester" => ["required", "numeric"],
        "gradeSecondRecuperation" => ["required", "numeric"],
        "secondPredictedLesson" => ["required", "numeric", "integer"],
        "secondPerformedLesson" => ["required", "numeric", "integer"],
        "gradeThirdTrimester" => ["required", "numeric"],
        "gradeThirdRecuperation" => ["required", "numeric"],
        "thirdPredictedLesson" => ["required", "numeric", "integer"],
        "thirdPerformedLesson" => ["required", "numeric", "integer"],
        "situationBeforeFinalRecup" => ["required", "string"],
        "gradeFinalRecuperation" => ["required", "numeric"],
        "situationAfterFinalRecup" => ["required", "string"]

        ]);

     }

    public function index()
    {
        
        $schoolReports = DB::table("school_reports")
        ->select(
            "school_report_id", "students.student_registration", "students.name", "students.last_name", "school_classes.school_class_name",
            "school_classes.school_class_type", "school_classes.school_year", "disciplines.discipline_name"
            )
        ->join("matriculateds", "schoolreport.matriculated_id", "=", "matriculateds.matriculated_id")
        ->join("students", "matriculateds.student_registration", "=", "students.student_registration")
        ->join("disciplines", "matriculateds.discipline_id", "=", "disciplines.discipline_id")
        ->join("school_classes", "matriculateds.school_class_id", "=", "school_classes.school_class_id")
        ->where("school_reports.deleted_at", "=", null)
        ->paginate(5);

        return response()->json([
            "error" => false,
            "response" => $schoolReports
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

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
                ], 400);

        }


        SchoolReport::create([
            "matriculated_id" => $request->matriculatedId,
            "grade_first_trimester" => $request->gradeFirstTrimester,
            "grade_first_recuperation" => $request->gradeFirstRecuperation,
            "first_predicted_lesson" => $request->firstPredictedLesson,
            "first_performed_lesson" => $request->firstPerformedLesson,
            "grade_second_trimester" => $request->gradeSecondTrimester,
            "grade_second_recuperation" => $request->gradeSecondRecuperation,
            "second_predicted_lesson" => $request->secondPredictedLesson,
            "second_performed_lesson" => $request->secondPerformedLesson,
            "grade_third_trimester" => $request->gradeThirdTrimester,
            "grade_third_recuperation" => $request->gradeThirdRecuperation,
            "third_predicted_lesson" => $request->thirdPredictedLesson,
            "third_performed_lesson" => $request->thirdPerformedLesson,
            "situation_before_final_recup" => $request->situationBeforeFinalRecup,
            "grade_final_recuperation" => $request->gradeFinalRecuperation,
            "situation_after_final_recup" => $request->situationAfterFinalRecup
        ]);

        return response()->json([
            "error" => false,
            "message" => "School report successfully created."
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
        
        $schoolReport = SchoolReport::findOrFail($id)
        ->select(
            "school_report_id", "grade_first_trimester", "grade_first_recuperation", "first_predicted_lesson",
            "first_performed_lesson", "grade_second_trimester", "grade_second_recuperation", "second_predicted_lesson",
            "second_performed_lesson", "grade_third_trimester", "grade_third_recuperation", "third_predicted_lesson",
            "third_performed_lesson", "situation_before_final_recup", "grade_final_recuperation", "situation_after_final_recup",
            "matriculateds.school_year", "matriculateds.call_number", "students.student_name", "disciplines.discipline_name",
            "school_classes.school_class_name", "school_classes.school_class_type", "school_classes.school_year"
        )
    ->join("matriculateds", "schoolreport.matriculated_id", "=", "matriculateds.matriculated_id")
    ->join("students", "matriculateds.student_registration", "=", "students.student_registration")
    ->join("disciplines", "matriculateds.discipline_id", "=", "disciplines.discipline_id")
    ->join("school_classes", "matriculateds.school_class_id", "=", "school_classes.school_class_id")
    ->where("school_report_id", "=", $id)
    ->where("deleted_at", "=", null)
    ->get();

    return response()->json([
        "error" => false,
        "response" => $schoolReport
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

        $schoolReport = SchoolReport::findOrFail($id);

        Matriculated::findOrFail($request->matriculatedId);

        $error = $this->validation($request);

        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->message()
            ], 400);

        }

        $schoolReport->update([
            "matriculated_id" => $request->matriculatedId,
            "grade_first_trimester" => $request->gradeFirstTrimester,
            "grade_first_recuperation" => $request->gradeFirstRecuperation,
            "first_predicted_lesson" => $request->firstPredictedLesson,
            "first_performed_lesson" => $request->firstPerformedLesson,
            "grade_second_trimester" => $request->gradeSecondTrimester,
            "grade_second_recuperation" => $request->gradeSecondRecuperation,
            "second_predicted_lesson" => $request->secondPredictedLesson,
            "second_performed_lesson" => $request->secondPerformedLesson,
            "grade_third_trimester" => $request->gradeThirdTrimester,
            "grade_third_recuperation" => $request->gradeThirdRecuperation,
            "third_predicted_lesson" => $request->thirdPredictedLesson,
            "third_performed_lesson" => $request->thirdPerformedLesson,
            "situation_before_final_recup" => $request->situationBeforeFinalRecup,
            "grade_final_recuperation" => $request->gradeFinalRecuperation,
            "situation_after_final_recup" => $request->situationAfterFinalRecup
        ]);

        return response()->json([
            "error" => false,
            "message" => "School report successfully updated."
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
        
        SchoolReport::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Shcool report successfully deleted."
        ], 200);

    }
}
