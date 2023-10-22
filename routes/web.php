<?php

use App\Http\Controllers\ProfileController;
use App\Http\Resources\SentenceResource;
use App\Models\Sentence;
use App\Models\Word;
use App\Models\Category;
use App\Models\Panel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\WordController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\PanelController;
use Illuminate\Http\Resources\Json\JsonResource;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which    
| contains the "web" middleware group. Now create something great!     
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('words',     WordController::class);
    Route::resource('sentences', SentenceController::class);
    Route::resource('panels', PanelController::class);
    Route::resource('category', CategoryController::class);
    Route::post('order-category', [CategoryController::class, 'order'])->name('category.order');

    Route::post('search-words',               [SearchController::class,        'searchWords'])            ->name('search-words');
    Route::post('paginated-words-for-search', [SearchController::class,        'paginatedWordsForSearch'])->name('paginated-words-for-search');
    
    Route::delete('delete-word-from-sentence/{word}/{sentence}',  [RelationshipController::class,    'deleteWordFromSentence'])->name('delete-word-from-sentence');
    Route::post('add-words-to-sentence/{sentence}',               [RelationshipController::class,    'addWordsToSentence'])->name('add-words-to-sentence');
    Route::post('add-tooltips-to-sentence/{sentence}',            [RelationshipController::class,    'addTooltipsToSentence'])->name('add-tooltips-to-sentence');
    

});
require __DIR__.'/auth.php';

/**
 * php artisan make:model --resource --controller
 */

 Route::get('/',  function(){

    
    return Inertia::render('Welcome', [

        'paginator'=> SentenceResource::collection(
            Sentence::query()
            ->with('words')
            ->orderByDesc('created_at')
            ->paginate(5)),

        'category1'=>Category::query()
            ->with(['sentences' => fn($query)=>$query->orderBy('created_at', 'desc') ])
            ->orderBy('order')
            ->get(), //get() returns a collection
            //->reject( function(Category $c){ }),

            /**
             * How to get a count of sentences?
             */

        'panels' => Panel::get(),
    ]);

 })->name('welcome');
