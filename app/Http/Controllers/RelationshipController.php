<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use App\Models\Word;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RelationshipController extends Controller
{
    public function deleteWordFromSentence(Request $request, Word $word, Sentence $sentence){
        //dd($request);
        try 
        { 
            $sentence->words()->detach($word);

        } catch (QueryException $e){
            return $e->getMessage();
        }

        return redirect(request('pagination_location'));


    }

    public function addWordsToSentence(Sentence $sentence){

        try 
        { 
            $sentence->words()->attach(request('words'));

        } catch (QueryException $e){
            return $e->getMessage();
        }
        
        return redirect(request('pagination_location'));
    }

    public function addTooltipsToSentence(Request $request, Sentence $sentence){

       
        $map          = explode(',', request('map'));
        $clips_raw    = explode(',', request('clips'));
        $clips = [];
        for ($x=0;$x<count($clips_raw);)
            $clips[ $clips_raw[$x++]] = $clips_raw[$x++]; 

        //dd($clips);
        try {
            for ($i=0;$i<count($map);) 
            { 
                $word_id = $map[$i++];
                $tooltip = $map[$i++];
               
                //adding entry to pivot table
                $sentence
                ->words()//->attach($word_id,['tooltip'=>$tooltip]);
                ->sync([ $word_id => ['tooltip'=>$tooltip,
                                       'clip'  =>$clips[$word_id]] ], false);
            }
        } catch (QueryException $e){
            return $e->getMessage();
        }

        session(['message' => 'sentence updated successfully']);
        return redirect()->route('sentences.edit', $sentence->id);
    }
}
