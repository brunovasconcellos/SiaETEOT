<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Locality extends Model
{

    protected $primaryKey = "cep";

    static function insertLocality ($data) {

        if ($data) {

            $localityId = DB::table("localities")->insertGetId([
                "cep" => $data["cep"],
                "tp_public_place" => $data["tpPublicPlace"],
                "public_place" => $data["publicPlace"],
                "neighborhood" => $data["neighborhood"],
                "city" => $data["city"],
                "federation_unit" => $data["federationUnity"]
            ]);

        }else {

            return false;

        }

        return $localityId;

    }

}
