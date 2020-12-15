<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "date_of_birth" => ["required", "date"],
            "gender" => ["required", "string", "size:1"],
            "cell_phone" => ["required", "size:11"],
            "identity_rg" => ["required", "size:9"],
            "identity_em_dt" => ["required", "date"],
            "identity_authority" => ["required", "string", "min:4", "max:20"],
            "cpf" => ["required", "string", "size:11"],
            "user_name" => ["required", "string", "min:2", "max:255"],
            "level" => ["required", "size:1"],
            "num_residence" => ["required", "string", "max:255"],
            "complement_Residence" => ["required", "string", "max:255"],
            "cep" => ["required", "size:8"],
            "father_name" => ["required", "string", "max:255"],
            "mather_name" => ["required", "string", "max:255"],
            "student_type" => ["required", "string", "max:255"],
            "actual_situation" => ["required", "string", "max:255"],

        ];
    }
}
