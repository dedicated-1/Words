<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function searchWords(Request $request){

        //dd($request);
        $words = Word::query()
             ->where('word', 'sounds like', "%{$request->search}%")
             ->orderByDesc('created_at')
             ->get();
 
        return response()->json($words,200);
     }
 
     public function paginatedWordsForSearch(Request $request){
         return Word::query()
             ->orderByDesc('created_at')
                 ->paginate(10);
     }
}
