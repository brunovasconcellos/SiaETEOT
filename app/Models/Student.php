<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{

    use SoftDeletes;

    protected $primaryKey = "student_registration";

    protected $fillable = [
        "student_registration", "father_name", "mather_name", "student_type",
        "actual_situation", "user_id"
    ];

    public function StudentUser () 
    {

        $this->belongsTo(App\User::class, "user_id");

    }

    
    public function StudentComplement() 
    {

        $this->HasMany(App\Models\StudentComplement::class, "student_registration");

    }

}
