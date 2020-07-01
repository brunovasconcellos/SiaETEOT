<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    
    protected $primaryKey = "school_class_id";

    protected $fillable = [
        "school_class_name", "school_class_type", "school_year",
        "situation", "shift", "start_date", "end_date",
        "modality", "course_id"
    ];

}
