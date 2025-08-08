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
        Schema::table('education_levels', function (Blueprint $table) {
            $table->string('phone_tu')->nullable();
            $table->string('phone_humas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('education_levels', function (Blueprint $table) {
            $table->dropColumn('phone_tu');
            $table->dropColumn('phone_humas');
        });
    }
};
