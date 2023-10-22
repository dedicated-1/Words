<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageEnumResource;
use App\Models\Category;
use App\Models\Sentence;
use Illuminate\Http\Request;
use App\Models\Panel;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Enum\Languages;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd('hi');
  

        return Inertia::render('Panels/Index', [
               'panels' => Panel::query()->orderBy('created_at')->get(),
            //->paginate(5),
            //:only
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 
            Inertia::render('Panels/Editor', [
            'task' => 'create',
            'category' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        $new_category_id = 0;
        if (request('new_category')){
            $new_category = Category::create( ['name' => request('new_category')] );
            $new_category_id = $new_category->id;
        } else if (request('category')){
            $new_category_id = request('category');
        }

        $sentences = $this->getSentences($request);

        for ($i = 0; $i < count($sentences['greek']); $i++) {

            //create
            $this_sentence = Sentence::create([
                'sentence'        => $sentences[ strtolower(request('main'))][$i],
                'pronounciation'  => '',
                'language'        => request('main'),

                'hebrew_styled'          => strip_tags($sentences['hebrew'][$i]),
                'english_styled'         => strip_tags($sentences['english'][$i]),
                'japanese_styled'        => strip_tags($sentences['japanese'][$i]),
                'spanish_styled'         => strip_tags($sentences['spanish'][$i]),
                'greek_styled'           => strip_tags($sentences['greek'][$i]),
                'german_styled'          => strip_tags($sentences['german'][$i]),

                'hebrew'                 => $sentences['hebrew'][$i],
                'english'                => $sentences['english'][$i],
                'japanese'               => $sentences['japanese'][$i],
                'spanish'                => $sentences['spanish'][$i],
                'greek'                  => $sentences['greek'][$i],
                'german'                 => $sentences['german'][$i],
                
            ]);

            //add category
            $this_sentence->category()->attach($new_category_id);
        }
                
        session(['message' => 'sentence created successsentencesy']);
        return $this->index();
    }

    public function getSentences(Request $request){


        $sentences = array();
        foreach (Languages::cases() as $lang){
            
            //array_push($split, strtolower($lang->name));
            $l = strtolower($lang->name);
            $sentences[$l] = array();

            $one = explode("</p>", request($l));
            foreach ($one as $key => $item){
                $one[$key] = $item . "</p>";
            }
            array_pop($one);
            $sentences[$l] = $one;
        }

        foreach ($sentences as $key => $sentence){
            $sentences[$key] = array_reverse($sentences[$key]);
        }

        return $sentences;
    }

    public function update(Request $request, Panel $panel)
    {

        session(['message' => 'sentence created']);
        $panel->category()->sync([Category::find(request('category'))->id]);
        return $this->index();
            
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Panel $panel)
    {
        return Inertia::render('Panels/Editor', [
            'panel' => $panel,
            'task' => 'edit',
            //->paginate(5),
            //:only
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panel $panel)
    {
        //
    }
}
