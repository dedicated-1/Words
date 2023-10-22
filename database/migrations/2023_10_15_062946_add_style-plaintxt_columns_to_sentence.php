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
        Schema::table('sentences', function (Blueprint $table) {
            $table->text('hebrew_styled')->nullable();
            $table->text('greek_styled')->nullable();
            $table->text('english_styled')->nullable();
            $table->text('japanese_styled')->nullable();
            $table->text('spanish_styled')->nullable();
            $table->text('german_styled')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sentence', function (Blueprint $table) {
            
        });
    }
};
