<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYear::create(['academic_year' => '2024/2025']);
        AcademicYear::create(['academic_year' => '2025/2026']);
        AcademicYear::create(['academic_year' => '2026/2027']);
    }
}
