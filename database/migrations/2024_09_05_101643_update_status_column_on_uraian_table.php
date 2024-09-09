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
        Schema::table('uraian', function (Blueprint $table) {
            $table->enum('status', ['Accepted', 'On Progress', 'Rejected'])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('uraian', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
        });
    }
};
