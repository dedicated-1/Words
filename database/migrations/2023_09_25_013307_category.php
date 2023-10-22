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
        //pivot
        Schema::create('sentence_category', function (Blueprint $table) {
            $table->foreignId('sentence_id');//->constrained();
            $table->foreignId('category_id');//->constrained();
            $table->unique(['sentence_id', 'category_id']);
    
        });

        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentence_category');
    }
};
