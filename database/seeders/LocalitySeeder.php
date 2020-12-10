<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Seeder;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locality::create([
            'cep'                   => '20010000',
            'tp_public_place'       => 'Rua',
            'public_place'          => 'Primeiro de Março',
            'neighborhood'          => 'Centro',
            'city'                  => 'Rio de Janeiro',
            'federation_unit'       => 'RJ'
        ]);
    }
}
