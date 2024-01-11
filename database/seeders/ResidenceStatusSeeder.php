<?php

namespace Database\Seeders;

use App\Models\ResidenceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResidenceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResidenceStatus::create(['status_name' => 'Bersama Orang Tua']);
        ResidenceStatus::create(['status_name' => 'Bersama Saudara']);
        ResidenceStatus::create(['status_name' => 'Bersama Asrama']);
        ResidenceStatus::create(['status_name' => 'Bersama Kost']);
    }
}
