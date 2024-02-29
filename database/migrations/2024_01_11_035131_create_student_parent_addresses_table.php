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
        Schema::create('student_parent_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_parent_id')->constrained('student_parents');
            $table->string('parent_province')->nullable();
            $table->string('parent_regency')->nullable();
            $table->string('parent_district')->nullable();
            $table->string('parent_village')->nullable();
            $table->text('address')->nullable();
            $table->text('parentStay')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parent_addresses');
    }
};
