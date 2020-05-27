<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{

    use SoftDeletes;

    protected $primaryKey = "employee_id";

    protected $fillable = [
        "user_id", "sector_id"
    ];
}
