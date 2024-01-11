<?php

namespace Database\Seeders;

use App\Models\BloodType;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BloodType::create(['type_name' => 'A']);
        BloodType::create(['type_name' => 'B']);
        BloodType::create(['type_name' => 'AB']);
        BloodType::create(['type_name' => 'O']);
    }
}
