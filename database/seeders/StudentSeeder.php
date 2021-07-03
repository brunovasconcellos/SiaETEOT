<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        Student::insert([
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Maria',
                'mather_name'                   => 'João',
                'student_type'                  => 8,
                'student_registration'          => 20010102312,
                'user_id'                       => 56
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Joana',
                'mather_name'                   => 'Marco',
                'student_type'                  => 2,
                'student_registration'          => 87643918246,
                'user_id'                       => 57
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Carla',
                'mather_name'                   => 'Tom',
                'student_type'                  => 1,
                'student_registration'          => 736248232,
                'user_id'                       => 58
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Cathia',
                'mather_name'                   => 'Carlos',
                'student_type'                  => 5,
                'student_registration'          => 2008374232,
                'user_id'                       => 59
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Jenifer',
                'mather_name'                   => 'Freitas',
                'student_type'                  => 11,
                'student_registration'          => 2001433312,
                'user_id'                       => 5
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'orena',
                'mather_name'                   => 'tiziu',
                'student_type'                  => 15,
                'student_registration'          => 2423102312,
                'user_id'                       => 60
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Paula',
                'mather_name'                   => 'Paulo',
                'student_type'                  => 8,
                'student_registration'          => 20110102312,
                'user_id'                       => 61
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'Bia',
                'mather_name'                   => 'Jão',
                'student_type'                  => 8,
                'student_registration'          => 21110102312,
                'user_id'                       => 62
            ]
        ]);
    }
}
