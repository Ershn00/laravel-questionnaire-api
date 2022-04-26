<?php

use App\Http\Controllers\Api\TestQuestionController;
use App\Http\Controllers\Api\TestQuestionChoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Test Questions
Route::get('test_questions', [TestQuestionController::class, 'index'])
    ->name('api.test_questions.index');

Route::post(
    'test_questions',
    [TestQuestionController::class, 'store']
)->name('api.test_questions.store');

Route::put(
    'test_questions/{question}',
    [TestQuestionController::class, 'update']
)->name('api.test_questions.update');

Route::delete(
    'test_questions',
    [TestQuestionController::class, 'destroy']
)->name('api.test_questions.destroy');


// Test Question Choices
Route::get('test_question_choices', [TestQuestionChoiceController::class, 'index'])
    ->name('api.test_question_choices.index');

Route::post(
    'test_question_choices',
    [TestQuestionChoiceController::class, 'store']
)->name('api.test_question_choices.store');

Route::put(
    'test_question_choices/{choice}',
    [TestQuestionChoiceController::class, 'update']
)->name('api.test_question_choices.update');

Route::delete(
    'test_question_choices',
    [TestQuestionChoiceController::class, 'destroy']
)->name('api.test_question_choices.destroy');
