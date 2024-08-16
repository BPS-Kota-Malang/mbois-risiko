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
        Schema::create('level_dampak', function (Blueprint $table) {
            $table->id();
            $table->string('level_dampak', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('deskripsi', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->timestamp('created_at')->nullable(true)->default(null);
            $table->timestamp('updated_at')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_dampak');
    }
};
