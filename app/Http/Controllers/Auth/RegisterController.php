<?php

namespace App\Http\Controllers\Auth;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        $user = new User;

        $locality = new Locality();

        $localityId = $locality->insertLocality($data);

        if ($localityId) {


            return User::create([
                'name' => $data['name'],
                "last_name" => $data["last_name"],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                "date_of_birth" => $data["date_of_birth"],
                "gender" => $data["gender"],
                "cell_phone" => $data["cell_phone"],
                "identity_rg" => $data["identity_rg"],
                "identity_em_dt" => $data["identity_em_dt"],
                "identity_issuing_authority" => $data["identity_issuing_authority"],
                "cpf" => $data["cpf"],
                "user_name" => $data["user_name"],
                "cep_user" => $localityId,
            ]);


        }else {

            return response("Error", 500);

        }
    }
}
