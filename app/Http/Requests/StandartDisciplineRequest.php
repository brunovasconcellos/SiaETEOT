<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StandartDisciplineRequest extends FormRequest
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
            "matriculation_date" => ["required", "date"],
            "school_year" => ["required", "string"],
            "situation"  => ["required", "string"],
            "call_number" => ["required", "numeric", "integer"],
            "student_registration" => ["required", "numeric", "integer"],
            "school_class_id" => ["required", "numeric", "integer"],
        ];
    }
}
