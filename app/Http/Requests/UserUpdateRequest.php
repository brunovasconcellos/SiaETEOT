<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "dateOfBirth" => ["required", "date", "size:10"],
            "gender" => ["required", "string", "size:1"],
            "cellPhone" => ["required", "size:11"],
            "identityRg" => ["required", "size:9"],
            "identityEmDt" => ["required", "date", "size:10"],
            "identityAuthority" => ["required", "string", "min:4", "max:20"],
            "cpf" => ["required", "string", "size:11"],
            "userName" => ["required", "string", "min:2", "max:255"],
            "level" => ["required", "size:1"],
            "numResidence" => ["required", "string", "max:255"],
            "complementResidence" => ["required", "string", "max:255"],
            "cep" => ["required", "size:8"],
            "tpPublicPlace" => ["required", "string", "max:255"],
            "publicPlace" => ["required", "string", "max:255"],
            "neighborhood" => ["required", "string", "max:255"],
            "city" => ["required", "string", "max:255"],
            "federationUnit" => ["required", "string", "size:2"],
            "type" => ["required", "string", "max:255"],
            "contact" => ["required ", "string", "max:255"]
        ];
    }
}
