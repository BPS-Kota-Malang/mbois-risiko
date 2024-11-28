<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriksAnalisisResikoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriks_analisis_resiko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_level_kemungkinan')->constrained('level_kemungkinan')->onDelete('cascade');
            $table->foreignId('id_level_dampak')->constrained('level_dampak')->onDelete('cascade');
            $table->string('besaran_resiko');
            $table->string('hasil_level_resiko');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriks_analisis_resiko');
    }
}
