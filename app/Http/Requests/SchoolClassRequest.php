<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolClassRequest extends FormRequest
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
            "schoolClassName" => ["required", "max:255"],
            "schoolClassType" => ["required", "max:255"],
            "schoolYear" => ["required", "size:4"],
            "situation" => ["required", "max:255"],
            "shift" => ["required", "max:255"],
            "startDate" => ["required", "date"],
            "endDate" => ["required", "date"],
            "modality" => ["required", "max:255"],
            "course" => ["required", "max:255"]
        ];
    }
}
