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
        Schema::create('jenis_resiko', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->string('kode', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('jenis_resiko', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->timestamps(); // This creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_resiko');
    }
};
