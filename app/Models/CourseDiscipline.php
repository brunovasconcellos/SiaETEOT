<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDiscipline extends Model
{
    
    protected $primaryKey = "course_discipline_id";
    
    protected $fillable = ["course_id", "discipline_id"];

}
