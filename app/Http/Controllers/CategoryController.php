<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Category/Index', [  
              'cats' => Category::query()->orderBy('order')->get(),
               //:only
        ]);
    }

    public function order(){

        //dd(request('cats'));
        $array = request('cats');
        try {
            foreach ($array as $key => $val) {
                Category::where('id', $val)->update(['order' => $key]);
            }

        } catch (\Exception $e) {
            dd($e);
        }

        return to_route('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
