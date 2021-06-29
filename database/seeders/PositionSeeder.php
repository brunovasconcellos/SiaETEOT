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
                "position_name" => "professor",
                "workload" => "1000",
                "type" => "1"
            ],
            [
                "position_name" => "limpeza",
                "workload" => "2000",
                "type" => "2"
            ],
            [
                "position_name" => "rh",
                "workload" => "3000",
                "type" => "3"
            ]
        ]);
    }
}
