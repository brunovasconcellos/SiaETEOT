<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    protected $primaryKey = "responsible_id";

    protected $fillable = [
        "user_id"
    ];
}
