<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penyebab', function (Blueprint $table) {
            $table->enum('status', ['Accepted', 'On Progress', 'Rejected'])->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('penyebab', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
        });
    }
};
