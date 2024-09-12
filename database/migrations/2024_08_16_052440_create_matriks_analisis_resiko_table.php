<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('matriks_analisis_resiko')) {
            Schema::create('matriks_analisis_resiko', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('id_level_kemungkinan');
                $table->unsignedBigInteger('id_level_dampak');
                $table->string('besaran_resiko');
                $table->string('hasil_level_resiko');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('matriks_analisis_resiko');
    }
};