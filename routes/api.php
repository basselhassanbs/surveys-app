<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/surveys', [\App\Http\Controllers\SurveyController::class,'index']);
Route::post('/surveys', [\App\Http\Controllers\SurveyController::class, 'store']);
Route::get('/surveys/{survey}', [\App\Http\Controllers\SurveyController::class,'show']);
Route::post('/surveys/{survey}/questions', [\App\Http\Controllers\QuestionController::class, 'store']);
Route::post('/surveys/take', [\App\Http\Controllers\SurveyController::class, 'take']);
Route::get('/answers/{survey_id}/{question_id}/{value}', [\App\Http\Controllers\SurveyController::class,
	'answers']);