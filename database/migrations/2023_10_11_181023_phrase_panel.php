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
        Schema::create('panels', function (Blueprint $table) {

            $table->id();
            
            $table->text('greek')->nullable()->default(null); // | for pronounciation
            $table->text('hebrew')->nullable()->default(null);
            $table->text('german')->nullable()->default(null);
            $table->text('english')->nullable()->default(null);
            $table->text('spanish')->nullable()->default(null);
            $table->text('japanese')->nullable()->default(null);
            
            $table->string('main')->nullable()->default('greek'); //this is the language of the sentence

            $table->string('type')->nullable();
            $table->text('extra')->nullable();
            $table->timestamps();
        });

        Schema::create('sentence_in_focus', function (Blueprint $table) {

            $table->id();
            
            $table->string('greek')->default(null); // | for pronounciation
            $table->string('hebrew')->default(null);
            $table->string('german')->default(null);
            $table->string('english')->default(null);
            $table->string('spanish')->default(null);
            $table->string('japanese')->default(null);
            
            $table->string('main')->default('greek'); //this is the language of the sentence

            $table->string('type')->nullable();
            $table->text('extra')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panels');
        Schema::dropIfExists('sentence_in_focus');
    }
};
