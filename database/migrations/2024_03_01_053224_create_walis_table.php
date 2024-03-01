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
        Schema::create('walis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->nullable();
            $table->string('wali_name')->nullable();
            $table->string('wali_degree')->nullable();
            $table->string('wali_job')->nullable();
            $table->string('wali_tel')->nullable();
            $table->string('wali_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walis');
    }
};
