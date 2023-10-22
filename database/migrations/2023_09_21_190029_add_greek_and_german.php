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
        Schema::table('words', function (Blueprint $table) {
            $table->string('greek')->default(null);
            $table->string('german')->default(null);
        });
        Schema::table('sentences', function (Blueprint $table) {
            $table->string('greek')->default(null);
            $table->string('german')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn('greek');
            $table->dropColumn('german');
        });
        Schema::table('sentences', function (Blueprint $table) {
            $table->dropColumn('greek');
            $table->dropColumn('german');
        });
    }
};
