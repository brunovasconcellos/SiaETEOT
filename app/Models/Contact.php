<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

    use SoftDeletes;

    static function insertContact ($data, $userId) {

        if ($data) {

            $contactId = DB::table("contacts")->insertGetId([

                "type" => $data["type"],
                "contact" => $data["contact"],
                "user_id" => $userId,

            ]);
        }else {

            return false;

        }

        return response()->json(["response" => "contact created"], 201);

    }

}
