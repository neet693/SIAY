<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@siay.com',
            'password' => bcrypt('admin1siay'),
            'role_id' => 1, //role admin
        ]);
        $user = User::create([
            'name' => 'Admin TK',
            'email' => 'admin.tk@siay.com',
            'password' => bcrypt('smartbersamayahya'),
            'role_id' => 1, //role admin
        ]);
        $user = User::create([
            'name' => 'Admin SD',
            'email' => 'admin.sd@siay.com',
            'password' => bcrypt('smartbersamayahya'),
            'role_id' => 1, //role admin
        ]);
        $user = User::create([
            'name' => 'Admin SMP',
            'email' => 'admin.smp@siay.com',
            'password' => bcrypt('smartbersamayahya'),
            'role_id' => 1, //role admin
        ]);
        $user = User::create([
            'name' => 'Admin SMA',
            'email' => 'admin.sma@siay.com',
            'password' => bcrypt('smartbersamayahya'),
            'role_id' => 1, //role admin
        ]);
    }
}
