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
        Schema::create('UserRole', function (Blueprint $table) {
            $table->foreignId('IdUser')->constrained('User', 'IdUser');
            $table->foreignId('IdRole')->constrained('Role', 'IdRole');
            $table->primary(['IdUser', 'IdRole']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserRole');
    }
};
