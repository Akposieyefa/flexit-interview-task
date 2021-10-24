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

Route::group(['middleware' => 'api', 'prefix' => 'flexi-task'], function ($router) {

        Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
            Route::post('/create-account', [App\Http\Controllers\Api\UserController::class, 'createUser']);
            Route::post('/verify-account', [App\Http\Controllers\Api\EmailVerificationController::class, 'verify']);

        //authenticated routes
        Route::group(['middleware' => ['jwt.verify']], function() {

            Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
                Route::post('/refresh', [App\Http\Controllers\Api\AuthController::class, 'refresh']);
                Route::get('/user-profile', [App\Http\Controllers\Api\AuthController::class, 'userProfile']);
            Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index']);
                Route::get('/users/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
            
            //twitte routes
            Route::post('/twittes', [App\Http\Controllers\Api\TwitteController::class, 'store']);
                Route::post('/twittes-comment/{id}', [App\Http\Controllers\Api\TwitteController::class, 'comment']);
                Route::get('/twittes', [App\Http\Controllers\Api\TwitteController::class, 'index']);
                Route::get('/twittes/{id}', [App\Http\Controllers\Api\TwitteController::class, 'show']);
                Route::get('/twittes-like/{id}', [App\Http\Controllers\Api\TwitteController::class, 'likeTwitte']);
                Route::get('/twittes-unlike/{id}', [App\Http\Controllers\Api\TwitteController::class, 'unLikeTwitte']);
                Route::delete('/twittes/{id}', [App\Http\Controllers\Api\TwitteController::class, 'destroy']);

        });//jwt verified routes

});
