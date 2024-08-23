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
        Schema::create('resiko', function (Blueprint $table) {
            $table->id();
            $table->string('resiko', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('status')->nullable(); // Kolom status bisa kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resiko');
    }
};
