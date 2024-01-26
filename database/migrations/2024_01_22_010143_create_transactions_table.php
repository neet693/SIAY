<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('transaction_type_id')->constrained('transaction_types');
            // $table->string('snap_token')->nullable();
            // $table->boolean('is_success')->default(false);
            $table->string('payment_status', 100)->default('waiting');
            $table->string('midtrans_url')->nullable();
            $table->string('midtrans_booking_code')->nullable();
            // $table->decimal('price', 10, 2);
            $table->unique(['student_id', 'transaction_type_id']); //menambahkan tabel unique agar tidak terjadi double transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
