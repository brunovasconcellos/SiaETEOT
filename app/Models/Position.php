<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    protected $primaryKey = "position_id";

    protected $fillable = [
        "position_name", "workload", "type"
    ];
}
