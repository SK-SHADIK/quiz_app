<?php

use App\Http\Controllers\QuizApp\CommonController;
use App\Http\Controllers\QuizApp\QuestionAnswerController;
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

Route::get('/logs', [CommonController::class, 'viewLogs']);

// -------------------------------- Question Crud --------------------------------

Route::get('/show-question-answer', [QuestionAnswerController::class, 'showQuestionAnswer'])->name('show.question.answer');
Route::get('/create-question-answer', [QuestionAnswerController::class, 'createQuestionAnswer'])->name('create.question.answer');
Route::post('/store-question-answer', [QuestionAnswerController::class, 'storeQuestionAnswer'])->name('store.question.answer');

