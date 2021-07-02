<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Position::insert([
            [
                "position_name" => "Professor",
                "workload" => "40",
                "type" => "2"
            ],
            [
                "position_name" => "Auxiliar de limpeza",
                "workload" => "40",
                "type" => "1"
            ],
            [
                "position_name" => "Auxiliar administrativo RH",
                "workload" => "40",
                "type" => "3"
            ],
            [
                "position_name" => "Diretor",
                "workload" => "40",
                "type" => "3"
            ],
            [
                "position_name" => "Inspetor",
                "workload" => "40",
                "type" => "4"
            ],
            [
                "position_name" => "Supervisor",
                "workload" => "40",
                "type" => "6"
            ],
        ]);
    }
}
