<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teach extends Model
{

    use SoftDeletes;

    protected $primaryKey = "teach_id";

    protected $fillable = ["start_date", "end_date", "discipline_id", "employee_id"];

}