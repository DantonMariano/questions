<?php

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

Route::group(['prefix' => 'user'], function () {
  Route::post('/login', '\App\Http\Controllers\UserController@login');
  Route::post('/register', '\App\Http\Controllers\UserController@register');
});
Route::group(['middleware' => ['\App\Http\Middleware\isUser']], function () {
  Route::group(['prefix' => 'clubes'], function () {
    Route::post('/criar', '\App\Http\Controllers\ClubeController@create');
    Route::post('/', '\App\Http\Controllers\ClubeController@read');
    Route::post('/excluir', '\App\Http\Controllers\ClubeController@delete');
  });
  Route::group(['prefix' => 'socios'], function () {
    Route::post('/criar', '\App\Http\Controllers\SocioController@create');
    Route::post('/', '\App\Http\Controllers\SocioController@read');
    Route::post('/excluir', '\App\Http\Controllers\SocioController@delete');
    Route::post('/associar', '\App\Http\Controllers\SocioController@associar');
  });
});
