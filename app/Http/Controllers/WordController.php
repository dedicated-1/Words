<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditWordRequest;
use App\Http\Requests\StoreWordRequest;
use App\Http\Resources\WordResource;
use App\Models\Word;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        $words = Word::all();
        return view('words.index', compact('words'));
        */
        //$paginator = Word::query()->orderByDesc('created_at')->paginate(5);
        return Inertia::render('Words/Index', [
            'paginator'=> WordResource::collection(
                                Word::query()
                                ->orderByDesc('created_at')
                                ->paginate(10)),
            
        ]);

    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Words/Editor', [
            'task'=>'create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWordRequest $request)
    {
        
        $result = Word::create([
            'word'           => request('word'),
            'searchterm'     => request('searchtermterm'),
            'pronounciation' => request('pronounciation'),

            'language'       => request('language'),

            'hebrew'         => request('hebrew'),
            'english'        => request('english'),
            'japanese'       => request('japanese'),
            'spanish'        => request('spanish'),
            'greek'          => request('greek'),
            'german'         => request('german'),


            //'type'      => request('type'),
            //'extra'     => request('extra'),
        ]);

        session(['message' => 'word created successfully']);
        return $this->create();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        $word->update([
            'word'           => request('word'),
            'searchterm'     => request('searchtermterm'),
            'pronounciation' => request('pronounciation'),

            'language'       => request('language'),
            
            'hebrew'         => request('hebrew'),
            'english'        => request('english'),
            'japanese'       => request('japanese'),
            'spanish'        => request('spanish'),
            'greek'          => request('greek'),
            'german'         => request('german'),

        ]);


        return redirect(($request->session()->pull('pagination_location')));
    }







    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditWordRequest $request, Word $word)
    {
        //return to correct page after editing
        $request->session()->flash('pagination_location', request('pagination_location'));
    
        return Inertia::render('Words/Editor', [
            'word' => $word,
            'task' => 'edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Word $word)
    {
        try
        {
            $word->delete();
        } catch (QueryException $e){
            return $e->getMessage();
        }
        //dd(request('pagination_location'));
        session(['message' => 'word deleted successfully']);
        return redirect(request('pagination_location'));
        //to_route??
    }
}
