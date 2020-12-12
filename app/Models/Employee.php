<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{

    use SoftDeletes;

    protected $primaryKey = "employee_id";

    protected $fillable = [
        "user_id", "sector_id"
    ];

    public function EmployeeUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function EmployeeOcupations()
    {
        return $this->hasMany(\App\Models\OccupationEmployee::class, 'employee_id');
    }

    public function EmployeeExerts()
    {
        return $this->belongsToMany(\App\Models\Position::class, 'exerts', 'position_id', 'employee_id');
    }
}
