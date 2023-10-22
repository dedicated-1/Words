<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\CategoryEnum;


class Category extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'category' => CategoryEnum::class,
    // ];
    protected $table = 'category';

    protected $guarded = [];

    public function sentences(){
        return $this->belongsToMany(Sentence::class, 'sentence_category');
    }
}
