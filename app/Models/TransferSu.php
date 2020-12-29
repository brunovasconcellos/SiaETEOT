<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferSu extends Model
{
    use SoftDeletes;

    protected $primaryKey = "trans_id";

    protected $fillable = [
        "process_number", "transfer_date", "transfer_type", "student_registration", "su_id"
    ];
}
