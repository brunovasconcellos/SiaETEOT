<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentComplementRequest extends FormRequest
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

            "ingress_type" => ["required", "string", "max:255"],
            "ingress_form" => ["required", "string", "max:255"],
            "last_school" => ["required", "string", "max:255"],
            "vagacy_type" => ["required", "string", "max:255"],
            "ident_educacenso" => ["required", "max:11"],
            "year_last_grade" => ["required", "size:4"]

        ];
    }
}
