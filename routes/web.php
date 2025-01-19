<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballScoreController;

use App\Http\Controllers\ScoreController;
Route::controller(ScoreController::class)->group(function(){
    Route::get('/score/update','show');
    Route::post('/score/update','update')->name('score.update');
});

Route::controller(FootballScoreController::class)->group(function(){
    Route::get('/update-score','updateScore');
    Route::get('/football','index'); 
});

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
