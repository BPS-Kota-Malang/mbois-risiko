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
        Schema::create('matriks_analisis_resiko', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('id_level_kemungkinan')->unsigned()->nullable(false);
            $table->bigInteger('id_level_dampak')->unsigned()->nullable(false);
            $table->integer('besaran_resiko')->nullable(false);
            $table->bigInteger('id_level_resiko')->unsigned()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriks_analisis_resiko');
    }
};
