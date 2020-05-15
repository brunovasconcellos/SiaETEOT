<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = "employee_id";

    protected $fillable = [
        "user_id", "sector_id"
    ];
}