<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Able extends Model
{
    use SoftDeletes;

    protected $primaryKey = "able_id";

    protected $fillable = [
        "school_year", "employee_id", "discipline_id"
    ];

    public function Employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
