<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SchoolReport;
use App\Models\Matriculated;

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
            "school_reports.matriculated_id as id", "students.student_registration", "users.name", "users.last_name",
            "school_classes.school_class_name", "school_classes.school_class_type", "school_classes.school_year", "disciplines.discipline_name"
        )
        ->join("matriculateds", "school_reports.matriculated_id", "=", "matriculateds.matriculated_id")
        ->join("students", "matriculateds.student_registration", "=", "students.student_registration")
        ->join("users", "students.user_id", "=", "users.user_id")
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
        
       SchoolReport::findOrFail($id);
        
       $schoolReport = DB::table("school_reports")
        ->select(
            "school_reports.matriculated_id as id", "school_reports.grade_first_trimester", "school_reports.grade_first_recuperation", "school_reports.first_predicted_lesson",
            "school_reports.first_performed_lesson", "school_reports.grade_second_trimester", "school_reports.grade_second_recuperation", "school_reports.second_predicted_lesson",
            "school_reports.second_performed_lesson", "school_reports.grade_third_trimester", "school_reports.grade_third_recuperation", "school_reports.third_predicted_lesson",
            "school_reports.third_performed_lesson", "school_reports.situation_before_final_recup", "school_reports.grade_final_recuperation", "school_reports.situation_after_final_recup",
            "matriculateds.school_year as matriculated_school_year", "matriculateds.call_number", "users.name", "users.last_name",
            "students.student_registration", "disciplines.discipline_name", "school_classes.school_class_name", "school_classes.school_class_type",
            "school_classes.school_year as school_classes_school_year"
        )
    ->join("matriculateds", "school_reports.matriculated_id", "=", "matriculateds.matriculated_id")
    ->join("students", "matriculateds.student_registration", "=", "students.student_registration")
    ->join("users", "students.user_id", "=", "users.user_id")
    ->join("disciplines", "matriculateds.discipline_id", "=", "disciplines.discipline_id")
    ->join("school_classes", "matriculateds.school_class_id", "=", "school_classes.school_class_id")
    ->where("school_reports.matriculated_id", "=", $id)
    ->where("school_reports.deleted_at", "=", null)
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
