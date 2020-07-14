<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolReport extends Model
{
    
    use SoftDeletes;

    protected $primaryKey = "school_report_id";

    protected $fillable = [
        "grade_first_trimester", "grade_first_recuperation", "first_predicted_lesson",
        "first_performed_lesson", "grade_second_trimester", "grade_second_recuperation", "second_predicted_lesson",
        "second_performed_lesson", "grade_third_trimester", "grade_third_recuperation", "third_predicted_lesson",
        "third_performed_lesson", "situation_before_final_recup", "grade_final_recuperation", "situation_after_final_recup"
    ];

}
