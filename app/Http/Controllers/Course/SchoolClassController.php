<?php

namespace App\Http\Controllers\Course;

use App\Models\SchoolClass;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolClassRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $schoolClasses = DB::table("school_classes")
                ->select(
                    "school_classes.school_class_id as id",
                    "school_classes.school_class_name",
                    "school_classes.school_class_type",
                    "school_classes.school_year",
                    "school_classes.situation",
                    "school_classes.shift",
                    "courses.course_name"
                )
                ->join("courses", "school_classes.course_id", "=", "courses.course_id")
                ->where("school_classes.deleted_at", "=", null)
                ->get();

            return DataTables()->of($schoolClasses)->make(true);
        }

        $cursos = Course::all('course_id', 'course_name');

        return view("schoolclass", compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function select2Data()
    {

        $schoolClasses = DB::table("school_classes")
            ->select("school_classes.school_class_id", "school_classes.school_class_name")
            ->whereNull("school_classes.deleted_at")
            ->get();

        $schoolClassesFormated = [];

        foreach ($schoolClasses as $schoolClass) {

            $schoolClassesFormated[] = ["id" => $schoolClass->school_class_id, "text" => $schoolClass->school_class_name];
        }

        return response()->json($schoolClassesFormated);
    }

    public function store(SchoolClassRequest $request)
    {

        SchoolClass::create([
            "school_class_name" => $request->schoolClassName,
            "school_class_type" => $request->schoolClassType,
            "school_year" => $request->schoolYear,
            "situation" => $request->situation,
            "shift" => $request->shift,
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "modality" => $request->modality,
            "course_id" => $request->course,
        ]);

        return response()->json([
            "error" => false,
            "message" => "School class successfully created."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            $schoolClass = DB::table("matriculateds")
                ->join('students', 'students.student_registration', 'matriculateds.student_registration')
                ->join('users', 'students.user_id', 'users.user_id')
                ->where("matriculateds.school_class_id", "=", $id)
                ->where("matriculateds.deleted_at", "=", null)
                ->get();

            return DataTables()->of($schoolClass)->make(true);
        }


        $turmas = DB::table('school_classes')->where('school_class_id', $id)->get();
        return view("class", compact('turmas'));
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

        $schoolClass = SchoolClass::findOrFail($id);

        $schoolClass->update([
            "school_class_name" => $request->schoolClassName,
            "school_class_type" => $request->schoolClassType,
            "school_year" => $request->schoolYear,
            "situation" => $request->situation,
            "shift" => $request->shift,
            "start_date" => $request->startDate,
            "end_date" => $request->endDate,
            "modality" => $request->modality,
            "course_id" => $request->course
        ]);

        return response()->json([
            "error" => false,
            "message" => "School class successfully updated."
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
        $schoolClass = SchoolClass::findOrFail($id)->delete();

        return response()->json([
            "error" => false,
            "School Class successfully deleted."
        ]);
    }
}
