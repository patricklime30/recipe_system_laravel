<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user()->id;
    $my_recipe = Recipe::where('user_id', $user)->get();

    $all_recipe = Recipe::all();

    $favorite = Favorite::where('user_id', $user)->get();

    return view('dashboard', [
                                'my_recipe' => $my_recipe,
                                'favorite' => $favorite,
                                'all_recipe' => $all_recipe
                            ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('recipe', RecipeController::class);

    Route::resource('favorite', FavoriteController::class);
});

require __DIR__.'/auth.php';
