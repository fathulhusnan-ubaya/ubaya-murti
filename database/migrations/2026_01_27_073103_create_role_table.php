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
        Schema::create('Role', function (Blueprint $table) {
            $table->id('IdRole');
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
        Schema::dropIfExists('Role');
    }
};
