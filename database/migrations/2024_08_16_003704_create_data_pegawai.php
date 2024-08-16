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
        Schema::create('data_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('jabatan');
            $table->string('pangkat');
            $table->string('golongan');
            $table->string('tim');
            $table->string('no_hp');
            $table->bigInteger('user_id'); // Menambahkan onDelete cascade
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawai');
    }
};
