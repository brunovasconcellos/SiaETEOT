<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Position;
use App\Models\Responsible;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DisciplineSeeder::class,
            OccupationSeeder::class,
            PositionSeeder::class,
            LocalitySeeder::class,
            SectorSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            SchoolClassSeeder::class,
            StudentSeeder::class
            
        ]);
    }
}
