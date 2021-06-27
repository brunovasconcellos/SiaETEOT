<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OcurrenceStudentRequest extends FormRequest
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
            "providence" => ["required", "string", "max:255"],
            "report" => ["required", "string", "max:255"],
            "details" => ["required", "string", "max:255"],
            "type" => ["required", "string", "max:255"],
            "factDate" => ["required", "date"],
            "fact" => ["required", "string", "max:255"],
            "ocurrenceId" => ["required", "numeric"],
            "employeeId" => ["required", "numeric"]
        ];
    }
}
