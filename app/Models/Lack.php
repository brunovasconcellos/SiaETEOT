<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lack extends Model
{
    use SoftDeletes;

    protected $primaryKey = "lack_id";

    protected $fillable = [
        "lack_type", "matriculated_id", "leson_status_id"
    ];

}
