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
            'name' => 'PPDB',
            'price' => 150000,
        ]);

        TransactionType::create([
            'name' => 'Pembayaran SPP',
            'price' => 1000000,
        ]);

        TransactionType::create([
            'name' => 'Pembayaran Ujian Nasional',
            'price' => 500000,
        ]);
    }
}
