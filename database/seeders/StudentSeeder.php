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
                'father_name'                   => 'maria',
                'mather_name'                   => 'joão',
                'student_type'                  => 8,
                'student_registration'          => 20010102312,
                'user_id'                       => 1
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'joana',
                'mather_name'                   => 'marco',
                'student_type'                  => 2,
                'student_registration'          => 87643918246,
                'user_id'                       => 2
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'carla',
                'mather_name'                   => 'tom',
                'student_type'                  => 1,
                'student_registration'          => 736248232,
                'user_id'                       => 3
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'cathia',
                'mather_name'                   => 'carlos',
                'student_type'                  => 5,
                'student_registration'          => 2008374232,
                'user_id'                       => 4
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'jenifer',
                'mather_name'                   => 'freitas',
                'student_type'                  => 11,
                'student_registration'          => 2001433312,
                'user_id'                       => 5
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'lorena',
                'mather_name'                   => 'tiziu',
                'student_type'                  => 15,
                'student_registration'          => 2423102312,
                'user_id'                       => 6
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'paula',
                'mather_name'                   => 'paulo',
                'student_type'                  => 8,
                'student_registration'          => 20110102312,
                'user_id'                       => 1
            ],
            [
                'actual_situation'              => 'ativo',
                'father_name'                   => 'bia',
                'mather_name'                   => 'jão',
                'student_type'                  => 8,
                'student_registration'          => 21110102312,
                'user_id'                       => 9
            ]
        ]);
    }
}
