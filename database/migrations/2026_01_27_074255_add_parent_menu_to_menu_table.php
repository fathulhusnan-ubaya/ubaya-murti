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
        Schema::table('Menu', function (Blueprint $table) {
            $table->foreignId('IdMenuParent')->after('IdKategoriMenu')->nullable()->constrained('Menu', 'IdMenu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Menu', function (Blueprint $table) {
            $table->dropForeign(['IdMenuParent']);
            $table->dropColumn('IdMenuParent');
        });
    }
};
