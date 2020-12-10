<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LesonStatus extends Model
{
    use SoftDeletes;

    protected $primaryKey = "leson_status_id";

    protected $fillable = [
        "status", "leson_date", "schedule_id"
    ];
}
