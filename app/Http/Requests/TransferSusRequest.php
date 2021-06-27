<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferSusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "processNumber" => ["required", "numeric"],
            "transferDate" => ["required", "date"],
            "transferType" => ["required"],
            "studentRegistration" => ["required", "numeric"],
            "suId" => ["required", "numeric"]
        ];
    }
}
