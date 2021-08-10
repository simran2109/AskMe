<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VotesController;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('questions.answers',AnswerController::class)->except(['index','show','create']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('questions',QuestionController::class);
Route::post('questions/{question}/vote/{vote}',[VotesController::class,'voteQuestion'])->name('questions.vote');

Route::post('questions/{question}/favorite',[FavoriteController::class,'store'])->name('questions.favorite');
Route::delete('questions/{question}/unfavorite',[FavoriteController::class,'destroy'])->name('questions.unfavorite');


Route::get('question/{slug}',[QuestionController::class,'show'])->name('questions.show');