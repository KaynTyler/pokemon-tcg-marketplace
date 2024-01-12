<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PokemonTCGController;
use App\Http\Controllers\Auth\RegisterController;
;


Auth::routes(['verify']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::resource('/cards',PokemonTCGController::class);
    Route::get('/search',[PokemonTCGController::class,'search']);
    Route::post('/add-to-cart/{card}',[PokemonTCGController::class,'addToCart']);
    Route::get('/cart',[PokemonTCGController::class,'viewCart']);
    Route::put('/cards/{id}/activate',[PokemonTCGController::class,'activateCard']);
    Route::put('/cards/{id}/deactivate',[PokemonTCGController::class,'deactivateCard']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
