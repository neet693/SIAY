<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Religion::create(['religion_name' => 'Kristen']);
        Religion::create(['religion_name' => 'Katolik']);
        Religion::create(['religion_name' => 'Islam']);
        Religion::create(['religion_name' => 'Hindu']);
        Religion::create(['religion_name' => 'Buddha']);
        Religion::create(['religion_name' => 'Konghucu']);
    }
}
