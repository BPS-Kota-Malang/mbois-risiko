<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManajemenResikoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manajemen_resiko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tim_project')->constrained('tim_project')->onDelete('cascade');
            $table->foreignId('id_proses_bisnis')->constrained('proses_bisnis')->onDelete('cascade');
            $table->foreignId('id_resiko')->constrained('resiko')->onDelete('cascade');
            $table->foreignId('id_jenis_resiko')->nullable()->constrained('jenis_resiko')->onDelete('cascade');
            $table->foreignId('id_sumber_resiko')->nullable()->constrained('sumber_resiko')->onDelete('cascade');
            $table->foreignId('id_kategori_resiko')->nullable()->constrained('kategori_resiko')->onDelete('cascade');
            $table->foreignId('id_area_dampak')->nullable()->constrained('area_dampak')->onDelete('cascade');
            $table->foreignId('id_level_kemungkinan')->nullable()->constrained('level_kemungkinan')->onDelete('cascade');
            $table->foreignId('id_level_dampak')->nullable()->constrained('level_dampak')->onDelete('cascade');
            $table->foreignId('id_matriks_analisis_resiko')->nullable()->constrained('matriks_analisis_resiko')->onDelete('cascade');
            $table->enum('efektivitas', ['Efektif', 'Tidak Efektif'])->nullable();
            $table->json('id_penyebab')->nullable();
            $table->json('id_dampak')->nullable();
            $table->json('id_uraian')->nullable();
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
        Schema::dropIfExists('manajemen_resiko');
    }
}
