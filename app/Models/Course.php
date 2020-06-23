<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use Notifiable;
    use SoftDeletes;


    protected $primaryKey = "course_id";

    protected $fillable = [
        'course_name', 'course_workload'
    ];

}
