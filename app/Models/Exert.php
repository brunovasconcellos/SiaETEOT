<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exert extends Model
{
    use SoftDeletes;

    protected $primaryKey = "exerts_id";

    protected $fillable = [
        "registration", "employee_id", "position_id"
    ];
}
