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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('school_information_id')->nullable()->constrained('school_information');
            $table->string('unique_code')->unique();
            $table->string('fullname');
            $table->string('nickname');
            $table->string('citizenship');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->foreignId('religion_id')->constrained('religions');
            $table->string('church_domicile');
            $table->integer('child_position');
            $table->integer('child_number');
            $table->foreignId('blood_type_id')->constrained('blood_types');
            $table->string('email')->unique();
            $table->foreignId('residence_status_id')->constrained('residence_statuses');
            $table->string('payment_method');
            $table->enum('status_penerimaan', ['Diterima', 'Ditolak', 'Menunggu Persetujuan'])->default('Menunggu Persetujuan');
            // $table->string('snap_token')->nullable();
            // $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
