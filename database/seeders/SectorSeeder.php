<?php

namespace Database\Seeders;

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

        DB::table("sectors")->insert([ "sector_name" => "Orientacao Educacional"]);
        DB::table("sectors")->insert([ "sector_name" => "Setor de Pessoal"]);
        DB::table("sectors")->insert([ "sector_name" => "Inspetoria"]);
        DB::table("sectors")->insert([ "sector_name" => "Supervisao"]);
        DB::table("sectors")->insert([ "sector_name" => "Coordenacao"]);
        DB::table("sectors")->insert([ "sector_name" => "Corpo Docente"]);
        DB::table("sectors")->insert([ "sector_name" => "Secretaria"]);
        DB::table("sectors")->insert([ "sector_name" => "Diretoria"]);

    }
}
