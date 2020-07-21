<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisciplineSchoolClass extends Model
{
    
    use SoftDeletes;

    protected $primaryKey = "discipline_schoolClass_id";

    protected $fillable = ["school_class_id", "discipline_id"];

}
