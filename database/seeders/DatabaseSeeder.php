<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(
            [
                RoleSeeder::class,
                AcademicYearSeeder::class,
                EducationLevelSeeder::class,
                BloodTypeSeeder::class,
                ResidenceStatusSeeder::class,
                ReligionSeeder::class,
                TransactionTypeSeeder::class,
                // SchoolInformationSeeder::class,
                StudentSeeder::class,
                // StudentParentSeeder::class,
                // StudentAddressSeeder::class,
                // StudentParentAddressSeeder::class,
                UserSeeder::class,
            ]
        );

        //admin account
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@siay.com',
            'password' => bcrypt('admin1siay'),
            'role_id' => 1, //role admin
        ]);

        //teacher account
        $user = User::create([
            'name' => 'guru',
            'email' => 'guru@siay.com',
            'password' => bcrypt('guru1siay'),
            'role_id' => 2, // role guru
        ]);
    }
}
