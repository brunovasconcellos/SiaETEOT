<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{

    use SoftDeletes;
    
    protected $primaryKey = "school_class_id";

    protected $fillable = [
        "school_class_name", "school_class_type", "school_year",
        "situation", "shift", "start_date", "end_date",
        "modality", "course_id"
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'matriculateds', 'student_registration', 'school_class_id', 'student_registration');
    }

}
