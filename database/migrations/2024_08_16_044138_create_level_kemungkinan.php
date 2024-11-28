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
        Schema::create('level_kemungkinan', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->string('level_kemungkinan', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->timestamps(); // This creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_kemungkinan');
    }
};
