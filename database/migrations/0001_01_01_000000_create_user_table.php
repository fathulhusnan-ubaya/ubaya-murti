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
        Schema::create('User', function (Blueprint $table) {
            $table->id('IdUser');
            $table->string('Username');
            $table->string('Nama');
            $table->string('Email');
            $table->string('Password');
            $table->string('RememberToken')->nullable();
            $table->timestamp('WaktuBuat')->nullable();
            $table->timestamp('WaktuUbahAkhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('User');
    }
};
