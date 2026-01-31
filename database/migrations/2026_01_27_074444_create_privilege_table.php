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
        Schema::create('Privilege', function (Blueprint $table) {
            $table->foreignId('IdRole')->constrained('Role', 'IdRole');
            $table->foreignId('IdMenu')->constrained('Menu', 'IdMenu');
            $table->primary(['IdRole', 'IdMenu']);
            $table->tinyInteger('Level');
            $table->timestamp('WaktuBuat')->nullable();
            $table->timestamp('WaktuUbahAkhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Privilege');
    }
};
