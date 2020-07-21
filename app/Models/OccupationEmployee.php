<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OccupationEmployee extends Model
{    
        use SoftDeletes;
    
        protected $primaryKey = "occup_emp_id";
    
        protected $fillable = [
         "start_date", "final_date", "employee_id", "occupation_id" 
        ];
    
}