<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            "sectorId"                  => ["required", "numeric"],
            'name'                      => ['required', 'string', 'max:255'],
            'last_name'                 => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'string', 'email', 'max:255'],
            'password'                  => ['required', 'string', 'min:8', 'confirmed'],
            "dateOfBirth"               => ["required", "date"],
            "gender"                    => ["required", "string", "size:1"],
            "cellPhone"                 => ["required", "size:11"],
            "identityRg"                => ["required", "size:9"],
            "identityEmDt"              => ["required", "date"],
            "identityAuthority"         => ["required", "string", "min:4", "max:20"],
            "cpf"                       => ["required", "string", "size:11"],
            "userName"                  => ["required", "string", "min:2", "max:255"],
            "level"                     => ["required", "size:1"],
            "numResidence"              => ["required", "string", "max:255"],
            "complementResidence"       => ["required", "string", "max:255"],
            "cep"                       => ["required", "size:8"],
            "registration"              => ["required"],
            "position_id"               => ["required"],
        ];
    }
}
