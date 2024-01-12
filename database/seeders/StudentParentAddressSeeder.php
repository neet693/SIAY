<?php

namespace Database\Seeders;

use App\Models\StudentParent;
use App\Models\StudentParentAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentParentAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentParentAddress::factory(10)->create();
    }
}
