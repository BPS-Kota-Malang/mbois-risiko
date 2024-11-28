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
        Schema::create('kriteria_kemungkinan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori_resiko')->unsigned()->nullable(false);
            $table->bigInteger('id_level_kemungkinan')->unsigned()->nullable(false);
            $table->string('presentase_kemungkinan', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('jumlah_frekuensi', 255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->timestamps(); // This creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_kemungkinan');
    }
};
