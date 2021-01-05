<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolReportUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "grade_first_trimester" => ["required", "numeric"],
            "grade_first_recuperation" => ["required", "numeric"],
            "first_predicted_lesson" => ["required", "numeric"],
            "first_performed_lesson" => ["required", "numeric"],
            "grade_second_trimester" => ["required", "numeric"],
            "grade_second_recuperation" => ["required", "numeric"],
            "second_predicted_lesson" => ["required", "numeric"],
            "second_performed_lesson" => ["required", "numeric"],
            "grade_third_trimester" => ["required", "numeric"],
            "grade_third_recuperation" => ["required", "numeric"],
            "third_predicted_lesson" => ["required", "numeric"],
            "third_performed_lesson" => ["required", "numeric"],
            "situation_before_final_recup" => ["required", "string"],
            "grade_final_recuperation" => ["required", "numeric"],
            "situation_after_final_recup" => ["required", "string"],
        ];
    }
}
