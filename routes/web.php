<?php

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

Route::get('/data/{idTemporada}', 'MatchesController@getDataFutebolBrasileiro');
Route::get('/partida/totalizar/{idTemporada}', 'MatchesController@totalizarDados');
Route::get('/posicoes-dinamicas', 'CampeonatoController@getPosicoesDinamicas');

Route::get('/campeonato/{idTemporada}', 'CampeonatoController@index');

Route::get('/', 'AppController@index')->name('app');


Auth::routes();
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/partidas', 'MatchesController@index')->name('admin.partidas');
//Route::get('/admin/times', 'TimeController@index')->name('admin.times');