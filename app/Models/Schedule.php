<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $primaryKey = "schedule_id";

    protected $fillable = [
        "week_day", "start_date", "end_date", "amount_time", "school_class_id", "able_id"
    ];
}
