<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{

    use SoftDeletes;

    protected $primaryKey = "student_registration";

    protected $fillable = [
        "student_registration", "father_name", "mather_name", "student_type",
        "actual_situation", "user_id",
    ];

}
