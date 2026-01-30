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
        Schema::create('RolePrivilege', function (Blueprint $table) {
            $table->foreignId('IdRole')->constrained('Role', 'IdRole');
            $table->foreignId('IdMenu')->constrained('Menu', 'IdMenu');
            $table->primary(['IdRole', 'IdMenu']);
            $table->timestamp('WaktuBuat')->nullable();
            $table->timestamp('WaktuUbahAkhir')->nullable();
            $table->tinyInteger('Level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RolePrivilege');
    }
};
