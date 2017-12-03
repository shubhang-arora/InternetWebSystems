<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/question/topic/{topic}', 'QuestionController@loadTopic');
Route::post('/question/comment/store', 'QuestionController@storeComment');
Route::get('/question/{question}/comments', 'QuestionController@getComments');
Route::post('/question', 'QuestionController@storeQuestion');
Route::post('/question/{question}/answer', 'QuestionController@answerQuestion');
Route::get('/question/state/{state}', 'QuestionController@loadQuestionByCity');
Route::post('/question/{question}/upvote', 'QuestionController@upvote');
Route::post('/question/{question}/bookmark', 'QuestionController@bookmarkQuestion');
