<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionType::create([
            'name' => 'Biaya Pendidikan Toodler	',
            'price' => 4000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya pendidikan KB',
            'price' => 4000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan Toddler + KB',
            'price' => 6000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan TK A + TK B',
            'price' => 8500000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan TK B',
            'price' => 7000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan KB - TK B',
            'price' => 9500000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan Toddler + TK B',
            'price' => 11000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan SD',
            'price' => 13000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan SMP',
            'price' => 14000000,
        ]);
        TransactionType::create([
            'name' => 'Biaya Pendidikan SMA',
            'price' => 16000000,
        ]);
    }
}
