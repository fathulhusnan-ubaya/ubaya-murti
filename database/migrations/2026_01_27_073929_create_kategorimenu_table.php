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
        Schema::create('KategoriMenu', function (Blueprint $table) {
            $table->id('IdKategoriMenu');
            $table->string('Nama');
            $table->timestamp('WaktuBuat')->nullable();
            $table->timestamp('WaktuUbahAkhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('KategoriMenu');
    }
};
