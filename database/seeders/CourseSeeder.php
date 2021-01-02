<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Course::insert([

            [
                "course_name" => "Informática",
                "course_workload" => 4000
            ],

            [
                "course_name" => "Analises Clínicas",
                "course_workload" => 4000
            ],
            
            [
                "course_name" => "Gerência em Saúde",
                "course_workload" => 4000
            ],
            
            [
                "course_name" => "Administração",
                "course_workload" => 4000
            ],

        ]);

    }
}
