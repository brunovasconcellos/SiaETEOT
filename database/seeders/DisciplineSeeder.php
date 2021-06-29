<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Discipline::insert([
            [
                "discipline_name" => "Matematica",
                "discipline_abbreviation" => "mat"
            ],
            [
                "discipline_name" => "historia",
                "discipline_abbreviation" => "hist"
            ],
            [
                "discipline_name" => "portugues",
                "discipline_abbreviation" => "port"
            ],
            [
                "discipline_name" => "filosofia",
                "discipline_abbreviation" => "filo"
            ]
        ]);
    }
}
