<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    protected $primaryKey = "content_id";

    protected $fillable = [
        "content_name", "description", "content_date", "content_schedule", "schedule_id"
    ];
}
