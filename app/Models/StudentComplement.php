<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentComplement extends Model
{

    use SoftDeletes;
    
    protected $primaryKey = "student_registration";

    protected $fillable = ["student_registration", "ingress_type", "ingress_form", "last_school", "vagacy_type", "ident_educacenso", "year_last_grade"];

}
