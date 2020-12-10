<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

    use SoftDeletes;

    static function insertContact ($data, $userId, $insertType = null) {

        if ($data && $insertType == "excel") {

            $contactId = DB::table("contacts")->insertGetId([

                "type" => $data["tipo"],
                "contact" => $data["contato"],
                "user_id" => $userId,

            ]);
        }else {

            $contactId = DB::table("contacts")->insertGetId([

                "type" => $data["type"],
                "contact" => $data["contact"],
                "user_id" => $userId,

            ]);

        }

        return response()->json(["response" => "contact created"], 201);

    }

}
