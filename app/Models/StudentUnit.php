<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentUnit extends Model
{

    use SoftDeletes;

    protected $primaryKey = "su_id";

    protected $fillable = [
        "su_name", "su_phone"
    ];
}
