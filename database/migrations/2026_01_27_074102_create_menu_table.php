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
        Schema::create('Menu', function (Blueprint $table) {
            $table->id('IdMenu');
            $table->string('Judul');
            $table->string('RouteName');
            $table->json('RouteParams')->nullable();
            $table->integer('Urutan');
            $table->boolean('IsAktif');
            $table->string('Icon');
            $table->foreignId('IdKategoriMenu')->nullable()->constrained('KategoriMenu', 'IdKategoriMenu');
            $table->timestamp('WaktuBuat')->nullable();
            $table->timestamp('WaktuUbahAkhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menu');
    }
};
