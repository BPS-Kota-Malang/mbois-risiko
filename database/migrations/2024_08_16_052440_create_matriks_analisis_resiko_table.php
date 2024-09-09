<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
<<<<<<< HEAD
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
=======
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
>>>>>>> 6c8eec272c3ccd7d58e6f0a87881fc1a97b48577
    {
        Schema::dropIfExists('matriks_analisis_resiko');
    }
};
