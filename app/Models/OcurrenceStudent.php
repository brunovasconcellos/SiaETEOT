<?php

namespace App\Models;
use App\Http\Requests\TransferSusRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OcurrenceStudent extends Model
{
    use SoftDeletes;

    protected $primaryKey = "employee_id";

    protected $fillable = [
        "providence", "report", "details", "type", "fact_date", "fact", "ocurrence_id"
    ];
}
