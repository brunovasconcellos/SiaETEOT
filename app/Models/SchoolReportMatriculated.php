<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolReportMatriculated extends Model
{
    
    use SoftDeletes;

    protected $primaryKey = "school_report_ratriculated_id";

    protected $fillable = ["school_report_id", "matriculated_id"];

}
