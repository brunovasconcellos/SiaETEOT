<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discipline extends Model
{

    use SoftDeletes;
    
    protected $primaryKey = "discipline_id";

    protected $fillable = ["discipline_name", "discipline_abbreviation", "course_id"];

}
