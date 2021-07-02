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
                "workload" => "1000",
                "type" => "2"
            ],
            [
                "position_name" => "Auxiliar de limpeza",
                "workload" => "2000",
                "type" => "1"
            ],
            [
                "position_name" => "Auxiliar administrativo RH",
                "workload" => "3000",
                "type" => "3"
            ],
            [
                "position_name" => "Diretor",
                "workload" => "3000",
                "type" => "3"
            ],
            [
                "position_name" => "Inspetor",
                "workload" => "3000",
                "type" => "4"
            ],
            [
                "position_name" => "Supervisor",
                "workload" => "3000",
                "type" => "6"
            ],
        ]);
    }
}
