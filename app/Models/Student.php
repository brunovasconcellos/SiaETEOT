<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $primaryKey = "student_registration";

    protected $fillable = [
        "father_name", "mather_name", "student_type", "actual_situation",
        "user_id"
    ];

}
