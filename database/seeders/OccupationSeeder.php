<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Occupation::insert([
            [
                "occupation_name" => "Limpeza"
            ],
            [
                "occupation_name" => "Professor"
            ],
            [
                "occupation_name" => "Direção"
            ],
            [
                "occupation_name" => "Inspetor"
            ],
            [
                "occupation_name" => "Orientação"
            ],
            [
                "occupation_name" => "Supervisão"
            ]
        ]);
    }
}
