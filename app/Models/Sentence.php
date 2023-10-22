<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\CategoryEnum;

class Sentence extends Model
{
    use HasFactory;

    /**
     * $casts is for Enums
     */
    // protected $casts = [
    //     'category' => CategoryEnum::class,
    // ];


    protected $guarded = [];
    public function words(){
        return $this->belongsToMany(Word::class)->withPivot('tooltip', 'clip');
        //https://laravel.com/docs/10.x/eloquent-relationships#retrieving-intermediate-table-columns
    
    }

    public function category(){


        return $this->belongsToMany(Category::class, 'sentence_category');
    }









    public function related(){
        
    }
}
