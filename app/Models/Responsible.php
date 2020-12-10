<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsible extends Model
{

    use SoftDeletes;

    protected $primaryKey = "responsible_id";

    protected $fillable = [
        "user_id"
    ];
}
