<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matriculated extends Model
{
    use SoftDeletes;

    protected $primaryKey = "matriculated_id";

    protected $fillable = [
        "matriculation_date", "school_year", "situation", "call_number",
        "student_registration", "school_class_id", "discipline_id"
    ];

}
