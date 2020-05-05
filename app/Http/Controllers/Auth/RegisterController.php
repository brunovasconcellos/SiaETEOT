<?php

namespace App\Http\Controllers\Auth;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Locality;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "dateOfBirth" => ["required", "date", "size:10"],
            "gender" => ["required", "string", "size:1"],
            "cellPhone" => ["required", "size:9"],
            "identityRg" => ["required", "size:9"],
            "identityEmDt" => ["required", "date", "size:10"],
            "identityAuthority" => ["required", "string", "min:4", "max:20"],
            "cpf" => ["required", "string", "size:11"],
            "userName" => ["required", "string", "min:2", "max:255"],
            "level" => ["required", "size:1"],
            "cep" => ["required", "size:8"],
            "tpPublicPlace" => ["required", "string", "max:255"],
            "publicPlace" => ["required", "string", "max:255"],
            "neighborhood" => ["required", "string", "max:255"],
            "city" => ["required", "string", "max:255"],
            "neighborhood" => ["required", "string", "max:255"],
            "type" => ["required", "string", "max:255"],
            "contact" => ["required", "string", "max:255"]

        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $contact = new Contact();

        $localityCep = $this->validateLocality($data);

            if ($data) {

               $user = User::create([
                    'name' => $data['name'],
                    "last_name" => $data["lastName"],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    "date_of_birth" => $data["dateOfBirth"],
                    "gender" => $data["gender"],
                    "cell_phone" => $data["cellPhone"],
                    "identity_rg" => $data["identityRg"],
                    "identity_em_dt" => $data["identityEmDt"],
                    "identity_issuing_authority" => $data["identityAuthority"],
                    "cpf" => $data["cpf"],
                    "user_name" => $data["userName"],
                    "level" => $data["level"],
                    "cep_user" => $localityCep,
                ]);
            }

            $contact::insertContact($data, $user->user_id);

            return $user;

    }

    public function validateLocality ($data) {

        $locality = Locality::where("cep", "=", $data["cep"])->get();

        if (!isset($locality[0]->cep)) {

            $locality = Locality::insertLocality($data);

            return $locality;

        }else {

            return $locality[0]->cep;

        }

    }

}
