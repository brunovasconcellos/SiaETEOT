<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Locality extends Model
{

    protected $primaryKey = "cep";

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cep', "tp_public_place", "public_place", "neighborhood", "city", "federation_unit"
    ];

    static function insertLocality ($data) {
        if ($data) {

            $localityId = DB::table("localities")->insertGetId([
                "cep" => $data->cep,
                "tp_public_place" => $data->tpPublicPlace,
                "public_place" => $data->publicPlace,
                "neighborhood" => $data->neighborhood,
                "city" => $data->city,
                "federation_unit" => $data->federationUnit
            ]);


        }else {

            return false;

        }

        return $localityId;

    }

    static function insertLocalityExcel ($data) {

        if ($data) {

            $localityId = DB::table("localities")->insertGetId([
                "cep" => $data["cep"],
                "tp_public_place" => $data["tipo_logradouro"],
                "public_place" => $data["logradouro"],
                "neighborhood" => $data["bairro"],
                "city" => $data["cidade"],
                "federation_unit" => $data["unidade_federacao"]
            ]);


            return $localityId;
        }

        return false;
    }

    static function validateLocality ($data, $insertType = null) {

        $locality = Locality::where("cep", $data["cep"])->first('cep');

        if($locality && $locality->cep) {
            return $locality->cep;
        }

        $locality = ($insertType == "excel") ? Locality::insertLocalityExcel($data): Locality::insertLocality($data);

        return $locality;

    }

}
