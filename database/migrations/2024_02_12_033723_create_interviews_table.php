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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->date('interview_date');
            // $table->time('start_time')->nullable();
            // $table->time('end_time')->nullable();
            $table->enum('method', ['online', 'offline'])->default('offline');
            $table->string('status')->default('Dijadwalkan');
            $table->foreignId('user_id')->constrained('users');
            $table->string('reason')->nullable();
            $table->text('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
