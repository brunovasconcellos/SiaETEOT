<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exerts extends Model
{
    use SoftDeletes;

    protected $primaryKey = "exerts_id";

    protected $fillable = [
        "registration", "employee_id", "position_id"
    ];
}
