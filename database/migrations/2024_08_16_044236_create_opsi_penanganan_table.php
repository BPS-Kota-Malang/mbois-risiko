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
        Schema::create('opsi_penanganan', function (Blueprint $table) {
            $table->id();
            $table->string('opsi_penanganan', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('deskisi', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->bigInteger('id_jenis_resiko')->nullable(false);
            $table->timestamp('created_at')->nullable(true)->default(null);
            $table->timestamp('updated_at')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opsi_penanganan');
    }
};
