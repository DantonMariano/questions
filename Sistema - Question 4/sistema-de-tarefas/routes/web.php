<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Console;

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

Route::group(['prefix'=>'user'], function(){
  Route::group(['middleware'=>['\App\Http\Middleware\isLogged']],function(){
    Route::get('/login', function(){
      return view('user/login');
    });
    Route::get('/register', function(){
      return view('user/register');
    });
  });
  Route::get('/sair', 'App\Http\Controllers\ApiController@userExit');
});

Route::group(['prefix' => 'tarefa', 'middleware'=>['\App\Http\Middleware\isUser']], function(){
  Route::get('/', function(){
    return view('tarefa/index');
  });
  Route::get('/criar', function(){
    return view('tarefa/criar');
  });
  Route::get('/atualizar', function(){});
  Route::get('/deletar', function(){});
});

Route::get('/', function(){
  return view('home/index');
});

/**
 * API
 */
Route::group(['prefix'=>'api/v1'], function(){
  Route::group(['prefix'=>'user', 'middleware'=>['\App\Http\Middleware\validateForm']], function(){
    Route::post('/login', 'App\Http\Controllers\ApiController@userLogin');
    Route::post('/register', 'App\Http\Controllers\ApiController@userRegister');
  });
  Route::group(['prefix' => 'tarefa', 'middleware'=>['\App\Http\Middleware\isUser']], function(){
    Route::get('/', 'App\Http\Controllers\ApiController@getTarefas');
    Route::post('/criar', 'App\Http\Controllers\ApiController@postTarefas');
    Route::post('/status', 'App\Http\Controllers\ApiController@statusTarefa');
    Route::put('/atualiza', 'App\Http\Controllers\ApiController@putTarefa');
    Route::delete('/deletar/{id}', 'App\Http\Controllers\ApiController@deleteTarefa');
  });
  
});