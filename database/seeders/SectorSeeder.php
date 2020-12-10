<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Sector::insert([
            [
                "sector_name" => "Orientação Educacional"
            ],
            [
                "sector_name" => "Setor de Pessoal"
            ],
            [
                "sector_name" => "Inspetoria"
            ],
            [
                "sector_name" => "Supervisão"
            ],
            [
                "sector_name" => "Coordenacão"
            ],
            [
                "sector_name" => "Corpo Docente"
            ],
            [
                "sector_name" => "Secretaria"
            ],
            [
                "sector_name" => "Diretoria"
            ]
        ]);
    }
}
