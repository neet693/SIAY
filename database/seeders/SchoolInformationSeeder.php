<?php

namespace Database\Seeders;

use App\Models\SchoolInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolInformation::factory(10)->create();
    }
}
