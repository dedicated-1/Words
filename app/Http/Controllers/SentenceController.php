<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use App\Models\Word;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = Sentence::query()
                     ->with('words')
                        ->orderByDesc('created_at')
                            ->paginate(5);

        return Inertia::render('Sentences/Index', [
            'paginator' => $paginator,
            //:only
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Sentences/Editor', [
            'task' => 'create',
            'category' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        
        //dd($category);
        DB::transaction(function () {

            $sentence = Sentence::create([
                'sentence'        => request('sentence'),
                'pronounciation'  => request('pronounciation'),
                'language'        => request('language'),

                'hebrew'          => request('hebrew'),
                'english'         => request('english'),
                'japanese'        => request('japanese'),
                'spanish'         => request('spanish'),
                'greek'           => request('greek'),
                'german'          => request('german'),

                'category'        => request('category'),
            ]);

            //dd($s);
            $sentence->category()->attach(request('category'));
        });

        

        session(['message' => 'sentence created successfully']);
        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sentence $sentence, Category $category)
    {

        try 
        {
            $sentence->update([

                'sentence'        => request('sentence'),
                'pronounciation'  => request('pronounciation'),
                'language'        => request('language'),
                
                'hebrew'          => request('hebrew'),
                'english'         => request('english'),
                'japanese'        => request('japanese'),
                'spanish'         => request('spanish'),
                'greek'           => request('greek'),
                'german'          => request('german'),

                'category'        => request('category'),
        
            ]);

            /**
             * detach current category
             * 
             * 
             * 
             * 
             */
            $sentence->category()->sync([Category::find(request('category'))->id]);

            /**
             * you need to hook up sentence and category HERE
             * 
             * 
             * 
             */
 
        } catch (\Exception $e) { return $e->getMessage(); }
        session(['message' => 'sentence updated successfully']);
        return redirect()->route('sentences.edit', $sentence->id);
    }
  
    // public function show(Sentence $sentence)
    // {
    // }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Sentence $sentence)
    {

        $request->session()->flash('pagination_location', request('pagination_location'));

        return Inertia::render('Sentences/Editor', [
            'sentence' => $sentence,
            'words'    => $sentence->words()->get(),
            'task'     => 'edit',
            'category' => Category::all(),
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentence $sentence)
    {
        $sentence->delete();
        session(['message' => 'sentence deleted']);
        return redirect(request('pagination_location'));

    }

    

}
