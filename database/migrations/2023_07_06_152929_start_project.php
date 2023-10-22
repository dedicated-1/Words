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

        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word')->nullable();
            $table->string('searchterm')->nullable();
            $table->string('pronounciation')->nullable();
            $table->string('language')->default('hebrew'); //this is the language of the word

            $table->string('hebrew')->nullable();
            $table->string('english')->nullable();
            $table->string('japanese')->nullable();
            $table->string('spanish')->nullable();

            $table->string('type')->nullable(); //noun, verb, adjective, adverb
            $table->  text('extra')->nullable();
            $table->timestamps();
        });

        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->string('sentence')->nullable();
            $table->string('pronounciation')->nullable();
            $table->string('language')->default('hebrew'); //this is the language of the sentence

            $table->string('hebrew')->nullable();
            $table->string('english')->nullable();
            $table->string('japanese')->nullable();
            $table->string('spanish')->nullable();
            /**
             * Change all these to TEXT, string == varchar, bro
             */

            $table->string('type')->nullable();
            $table->  text('extra')->nullable();
            $table->timestamps();
        });
        
        //pivot
        Schema::create('sentence_word', function (Blueprint $table) {
            $table->unsignedBigInteger('word_id');
            $table->foreign('word_id')->references('id')->on('words');

            $table->unsignedBigInteger('sentence_id');
            $table->foreign('sentence_id')->references('id')->on('sentences');

            //tooltip
            //clip
            $table->unique(['word_id', 'sentence_id']);
    
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentence_word');
        Schema::dropIfExists('words');
        Schema::dropIfExists('sentences');
        
    }
};
