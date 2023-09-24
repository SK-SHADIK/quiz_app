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
Route::get('/view-question-answer/{id}', [QuestionAnswerController::class, 'viewQuestionAnswer'])->name('view.question.answer');
Route::get('/edit-question-answer/{id}', [QuestionAnswerController::class, 'editQuestionAnswer'])->name('edit.question.answer');
Route::post('/update-question-answer', [QuestionAnswerController::class, 'updateQuestionAnswer'])->name('update.question.answer');
Route::post('/delete-question-answer/{id}', [QuestionAnswerController::class, 'deleteQuestionAnswer'])->name('delete.question.answer');
// Route::post('/active-deactive-question-answer/{id}', [QuestionAnswerController::class, 'activeDeactiveQuestionAnswer'])->name('active.deactive.question.answer');

Route::get('/search-question-answer', [QuestionAnswerController::class, 'searchQuestionAnswer'])->name('search.question.answer');





