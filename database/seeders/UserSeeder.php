<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(40)->create();

        User::create([
            'name'                          => 'admin',
            'last_name'                     => 'admin',
            'email'                         => 'admin@admin.com',
            'password'                      => Hash::make('1234'),
            'date_of_birth'                 => Carbon::now(),
            'gender'                        => 'M',
            'cell_phone'                    => '1234567890',
            'identity_rg'                   => '1234567890',
            'identity_em_dt'                => Carbon::now(),
            'identity_issuing_authority'    => '1234',
            'cpf'                           => '1234567890',
            'cep_user'                      => '20010000',
            'level'                         => 10,
            'num_residence'                 => '100',
        ]);
    }
}
