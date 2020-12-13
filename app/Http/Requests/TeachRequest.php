<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeachRequest extends FormRequest
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
            "startDate"     => ["required", "date", "size:10"],
            "endDate"       => ["required", "date", "size:10"],
            "disciplineId"  => ["required", "numeric"],
            "employeeId"    => ["required", "numeric"]
        ];
    }
}
