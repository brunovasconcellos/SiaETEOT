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
            // info
            [
                "school_class_name" => "1151",
                "school_class_type" => "Integrada",
                "school_year" => 1,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 1
            ],
            [
                "school_class_name" => "2151",
                "school_class_type" => "Integrada",
                "school_year" => 2,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 1
            ],
            [
                "school_class_name" => "3151",
                "school_class_type" => "Integrada",
                "school_year" => 3,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 1
            ],
            // analises
            [
                "school_class_name" => "1231",
                "school_class_type" => "Integrada",
                "school_year" => 1,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 2
            ],
            [
                "school_class_name" => "2131",
                "school_class_type" => "Integrada",
                "school_year" => 2,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 2
            ],
            [
                "school_class_name" => "3231",
                "school_class_type" => "Integrada",
                "school_year" => 3,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 2
            ],
            //adm
            [
                "school_class_name" => "1201",
                "school_class_type" => "Integrada",
                "school_year" => 1,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 4
            ],
            [
                "school_class_name" => "2101",
                "school_class_type" => "Integrada",
                "school_year" => 2,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 4
            ],
            [
                "school_class_name" => "3101",
                "school_class_type" => "Integrada",
                "school_year" => 3,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 4
            ],
            // gerencia
            [
                "school_class_name" => "1241",
                "school_class_type" => "Integrada",
                "school_year" => 1,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 3
            ],
            [
                "school_class_name" => "2141",
                "school_class_type" => "Integrada",
                "school_year" => 2,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 3
            ],
            [
                "school_class_name" => "3241",
                "school_class_type" => "Integrada",
                "school_year" => 3,
                "situation" => "Ativa", 
                "shift" => "Diurno", 
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now(),
                "modality" => "Técnico", 
                "course_id" => 3
            ],
        ]);
    }
}
