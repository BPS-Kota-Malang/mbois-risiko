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
        Schema::create('rencana_tindak_penanganan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('target_output');
            $table->date('target_waktu');
            $table->foreignId('id_data_pegawai')->constrained('data_pegawai')->onDelete('cascade');
            $table->foreignId('id_level_kemungkinan')->nullable()->constrained('level_kemungkinan')->onDelete('cascade');
            $table->foreignId('id_level_dampak')->nullable()->constrained('level_dampak')->onDelete('cascade');
            $table->foreignId('id_matriks_analisis_resiko')->nullable()->constrained('matriks_analisis_resiko')->onDelete('cascade');
            $table->foreignId('id_manajemen_resiko')->constrained('manajemen_resiko')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_tindak_penanganan');
    }
};