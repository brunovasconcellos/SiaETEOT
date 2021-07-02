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
                "discipline_name" => "Matemática",
                "discipline_abbreviation" => "Mat"
            ],
            [
                "discipline_name" => "História",
                "discipline_abbreviation" => "Hist"
            ],
            [
                "discipline_name" => "Língua Portuguesa",
                "discipline_abbreviation" => "Port"
            ],
            [
                "discipline_name" => "Filosofia",
                "discipline_abbreviation" => "Filo"
            ],
            [
                "discipline_name" => "Sociologia",
                "discipline_abbreviation" => "Socio"
            ],
            [
                "discipline_name" => "Modelagem de dados 1",
                "discipline_abbreviation" => "MD I"
            ],
            [
                "discipline_name" => "Modelagem de dados 2",
                "discipline_abbreviation" => "MD II"
            ],
            [
                "discipline_name" => "Geografia",
                "discipline_abbreviation" => "Geo"
            ],
            [
                "discipline_name" => "Química",
                "discipline_abbreviation" => "Quim"
            ],
            [
                "discipline_name" => "Física",
                "discipline_abbreviation" => "Fis"
            ],
            [
                "discipline_name" => "Modelagem de dados 2",
                "discipline_abbreviation" => "MD II"
            ],
            [
                "discipline_name" => "Inglês",
                "discipline_abbreviation" => "Ing"
            ],
            [
                "discipline_name" => "Empreendedorismo",
                "discipline_abbreviation" => "Emp"
            ],
            [
                "discipline_name" => "Educação Física",
                "discipline_abbreviation" => "ED. Física"
            ],
            [
                "discipline_name" => "Biologia",
                "discipline_abbreviation" => "Bio"
            ]
        ]);
    }
}
