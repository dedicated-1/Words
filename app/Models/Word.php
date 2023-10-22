<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;


    // protected $casts = [
    //     'status' => StatusEnum::class,
    // ];


    protected $guarded = [];

    public function sentences(){
        return $this->belongsToMany(Sentence::class);
    }

    public function synonyms(){
        
    }

    public function antonyms(){
        
    }

    public function related(){
        
    }


}
