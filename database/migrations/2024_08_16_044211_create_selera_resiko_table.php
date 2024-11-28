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
        Schema::create('selera_resiko', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori_resiko');
            $table->integer('resiko_minimum_negatif');
            $table->integer('resiko_minimum_positif');
            $table->timestamps(); // This creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selera_resiko');
    }
};
