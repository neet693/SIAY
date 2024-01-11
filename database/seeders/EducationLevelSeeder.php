<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EducationLevel::create(['level_name' => 'TK']);
        EducationLevel::create(['level_name' => 'SD']);
        EducationLevel::create(['level_name' => 'SMP']);
        EducationLevel::create(['level_name' => 'SMA']);
    }
}
