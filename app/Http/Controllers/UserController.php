<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Locality;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator($request)
    {
        return Validator::make($request->all(), [

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

        ]);
    }


    public function index()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $error = $this->validator($request);

        if ($error->fails()) {

            return [
                "error" => true,
                "message" => $error->errors()->all(),
                "userId" => null
                ];

        }

        $localityCep = Locality::validateLocality($request);

        $contact = new Contact();

        $user = User::create([

            'name' => $request->name,
            "last_name" => $request->lastName,
            'email' => $request['email'],
            'password' => Hash::make($request->password),
            "date_of_birth" => $request->dateOfBirth,
            "gender" => $request->gender,
            "cell_phone" => $request->cellPhone,
            "identity_rg" => $request->identityRg,
            "identity_em_dt" => $request->identityEmDt,
            "identity_issuing_authority" => $request->identityAuthority,
            "cpf" => $request->cpf,
            "user_name" => $request->userName,
            "level" => $request->level,
            "num_residence" => $request->numResidence,
            "complement_residence" => $request->complementResidence,
            "cep_user" => $localityCep,

        ]);

        $contact::insertContact($request, $user->user_id);

        return [
            "error" => false,
            "message" => "User created successfully",
            "userId" => $user->user_id
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $error = $this->validator($request);

        if ($error->fails()) {

            return [
                "error" => true,
                "message" => $error->errors()->all()
            ];

        }

        $localityCep = Locality::validateLocality($request);

        $user = [
            "name" => $request->name,
            "last_name" => $request->lastName,
            "email" => $request->email,
            "password" => $request->password,
            "date_of_birth" => $request->dateOfBirth,
            "cell_phone" => $request->cellPhone,
            "identity_rg" => $request->identityRg,
            "identity_em_dt" => $request->identityEmDt,
            "identity_authority" => $request->identityAuthority,
            "cpf" => $request->cpf,
            "user_name" => $request->userName,
            "level" => $request->level,
            "num_residence" => $request->numResidence,
            "complement_residence" => $request->complementResidence,
            "cep" => $localityCep,

        ];

        User::findOrFail($id)->update($user);

        return [
            "error" => false,
            "userId" => $id
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (isset($user)){

            $contact = Contact::where("user_id", "=", $id)->delete();
         
            $user->delete();

            return [
                "error" => false
            ];

        }

        return [
            "error" => true
        ];

    }

}
