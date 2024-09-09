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
        Schema::create('level_resiko', function (Blueprint $table) {
            $table->id();
            $table->string('level_resiko', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('besaran_min', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('besaran_max', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('tindakan', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('ket_warna', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->timestamps(); // This creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_resiko');
    }
};
