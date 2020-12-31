<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use Carbon\Carbon;
class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolClass::insert([

            [
                "school_class_name" => "3151",
                "school_class_type" => "Integrada",
                "school_year" => 1,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 1
            ]

        ]);
    }
}
