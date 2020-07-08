<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupation extends Model
{
    use SoftDeletes;

    protected $primaryKey = "occupation_id";

    protected $fillable = [
        "occupation_name"
    ];
}
