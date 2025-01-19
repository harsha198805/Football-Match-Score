<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballScoreController;

use App\Http\Controllers\ScoreController;

Route::get('/score/update', [ScoreController::class, 'show']);
Route::post('/score/update', [ScoreController::class, 'update']);


// Route::get('/update-score', [FootballScoreController::class, 'updateScore']);

Route::controller(FootballScoreController::class)->group(function(){
    Route::get('/update-score','updateScore');
    Route::get('/football','index');
    // Route::get('/products/create','create')->name('products.create');
    // Route::get('/products/show/{product}','show')->name('products.show');
    // Route::post('/products','store')->name('products.store');
    // Route::get('/products/edit/{product}','edit')->name('products.edit');
    // Route::put('/products/{product}','update')->name('products.update');
    // Route::delete('/products/{product}','destroy')->name('products.destroy');    
});


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/football', function () {
//     return view('football');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
