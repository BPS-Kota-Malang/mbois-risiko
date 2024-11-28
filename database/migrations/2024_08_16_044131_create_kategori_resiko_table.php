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
        Schema::create('kategori_resiko', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('definisi', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->timestamp('created_at')->nullable(true)->default(null);
            $table->timestamp('updated_at')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_resiko');
    }
};
