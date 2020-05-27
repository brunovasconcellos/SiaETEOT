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
            "cellPhone" => ["required", "size:9"],
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
            "city" => ["required", "string", "max:255"],
            "neighborhood" => ["required", "string", "max:255"],
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
    public function store($data)
    {

        $error = $this->validator($data);

        if ($error->fails()) {

            return [
                "error" => true,
                "message" => $error->errors()->all()
                ];

        }

        $localityCep = Locality::validateLocality($data);

        $contact = new Contact();

        $user = User::create([

            'name' => $data->name,
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
            "num_residence" => $data["numResidence"],
            "complement_residence" => $data["complementResidence"],
            "cep_user" => $localityCep,

        ]);

        $contact::insertContact($data, $user->user_id);

        return $user->user_id;

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

        $user = User::findOrFail($id);

        if ($error->fails()) {

            return [
                "error" => true,
                "message" => $error->errors()->all()
            ];

        }elseif (!$user) {

            return [
                "error" => true,
                "message" => ["User not exist"]
            ];

        }

        $localityCep = Locality::validateLocality($request);

        $user->user_id = $id;
        $user->name = $request->name;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->date_of_birth = $request->dateOfBirth;
        $user->cell_phone = $request->cellPhone;
        $user->identity_rg = $request->identityRg;
        $user->identity_em_dt = $request->identityEmDt;
        $user->identity_issuing_authority = $request->identityAuthority;
        $user->user_name = $request->userName;
        $user->level = $request->level;
        $user->num_residence = $request->numResidence;
        $user->complement_residence = $request->complementResidence;
        $user->cep_user = $localityCep;

        $user->save();

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
